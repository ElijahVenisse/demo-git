<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PendingUser;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

// app/Http/Controllers/UserController.php

 
    // public function index()
    // {
    //     $users = User::where('is_admin', false)->orderBy('created_at', 'desc')->get();
    //     $admins = User::where('is_admin', true)->orderBy('created_at', 'desc')->get();
    //     $pendingUsers = PendingUser::orderBy('created_at', 'desc')->get();

    //     return view('users.index', compact('users', 'admins', 'pendingUsers'));
    // }

    // UserController.php

public function index()
{
    $users = User::where('is_admin', false)->orderBy('created_at', 'desc')->get();
    $admins = User::where('is_admin', true)->orderBy('created_at', 'desc')->get();
    $pendingUsers = PendingUser::orderBy('created_at', 'desc')->get();

    foreach ($users as $user) {
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(100)->generate($user->name);
        $user->qr_code = "data:image/png;base64," . base64_encode($qrCode);
    }



      // Get unique departments and year levels from the users
      $departments = User::select('department')->distinct()->pluck('department');
      $yearLevels = User::select('year_level')->distinct()->pluck('year_level');

      return view('users.index', compact('users', 'admins', 'pendingUsers', 'departments', 'yearLevels'));
  
    //return view('users.index', compact('users', 'admins', 'pendingUsers'));
}


    public function approve($id)
    {
        $pendingUser = PendingUser::findOrFail($id);
        User::create([
            'name' => $pendingUser->name,
            'email' => $pendingUser->email,
            'password' => $pendingUser->password,
            'student_id' => $pendingUser->student_id,
            'department' => $pendingUser->department,
            'year_level' => $pendingUser->year_level,
            'section' => $pendingUser->section,
        ]);
        $pendingUser->delete();

        return redirect()->route('admin.pending_users.index')->with('success', 'User approved successfully');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'student_id' => 'required|string|max:255|unique:users,student_id',
            'department' => 'required|string|max:255',
            'year_level' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);


        $request->session()->increment('new_user_count', 1);
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(200)->generate($user->name);
        $qrCodeDataUri = "data:image/png;base64," . base64_encode($qrCode);

        return view('users.show', compact('user', 'qrCodeDataUri'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'       => 'required|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'sometimes|nullable|min:6',
            'student_id' => 'required|string|max:255|unique:users,student_id,' . $user->id,
            'department' => 'required|string|max:255',
            'year_level' => 'required|string|max:255',
            'section'    => 'required|string|max:255',
        ]);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function pendingIndex()
    {
        $pendingUsers = PendingUser::orderBy('created_at', 'desc')->get();
        return view('admin.pending_users.index', compact('pendingUsers'));
    }

  // app/Http/Controllers/UserController.php

public function destroyPending($id)
{
    $pendingUser = PendingUser::findOrFail($id);
    $pendingUser->delete();

    return redirect()->route('admin.pending_users.index')->with('success', 'Pending user rejected successfully');
}


public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt',
    ]);

    $path = $request->file('csv_file')->getRealPath();
    $data = array_map('str_getcsv', file($path));

    if (count($data) == 0) {
        return redirect()->back()->with('error', 'CSV file is empty.');
    }

    // Handle BOM character in header
    $header = array_shift($data);
    $header[0] = preg_replace('/\x{FEFF}/u', '', $header[0]);

    if ($header === null) {
        return redirect()->back()->with('error', 'CSV header is missing.');
    }

    // Log the header and data
    \Log::info('CSV Header: ' . json_encode($header));
    \Log::info('CSV Data: ' . json_encode($data));

    $csv_data = array_map(function ($row) use ($header) {
        return array_combine($header, $row);
    }, $data);

    // Log processed CSV data
    \Log::info('Processed CSV Data: ' . json_encode($csv_data));

    foreach ($csv_data as $row) {
        $validator = Validator::make($row, [
            'name'       => 'required|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6',
            'student_id' => 'required|string|max:255|unique:users,student_id',
            'department' => 'required|string|max:255',
            'year_level' => 'required|string|max:255',
            'section'    => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            // Log validation errors
            \Log::error('Validation failed for row: ' . json_encode($row) . '. Errors: ' . json_encode($validator->errors()));
            continue;
        }

        // Log the user data being created
        \Log::info('Creating user with data: ' . json_encode($row));

        User::create([
            'name'       => $row['name'],
            'email'      => $row['email'],
            'password'   => bcrypt($row['password']),
            'student_id' => $row['student_id'],
            'department' => $row['department'],
            'year_level' => $row['year_level'],
            'section'    => $row['section'],
        ]);
    }

    return redirect()->back()->with('success', 'Users imported successfully.');
}







}
