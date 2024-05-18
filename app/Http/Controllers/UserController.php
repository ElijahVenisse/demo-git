<?php



namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        // return view('users.index', compact('users'));

        //nice
        // $users = User::all(); // Fetches all users
        // return view('admin.users.index', compact('users'));

        
// Fetch only regular users
$users = User::where('is_admin', false)->get();
// Fetch only admin users
$admins = User::where('is_admin', true)->get();

return view('users.index', compact('users', 'admins'));
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
        ]);
    
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        //session()->flash('success', 'Student added successfully!');

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        // Generate QR Code
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(200)->generate($user->name);
    
        // Convert QR Code output to a data URI
        $qrCodeDataUri = "data:image/png;base64," . base64_encode($qrCode);
    
        // Pass the QR code data URI and user to the view
        return view('users.show', compact('user', 'qrCodeDataUri'));
    }
    
    
    

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate all incoming data
        $validatedData = $request->validate([
            'name'       => 'required|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'sometimes|nullable|min:6',
            'student_id' => 'required|string|max:255|unique:users,student_id,' . $user->id,
            'department' => 'required|string|max:255',
            'year_level' => 'required|string|max:255',
        ]);
    
        // Check if a new password was provided
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            // If not, remove the password key from the array so it doesn't overwrite the existing password with null
            unset($validatedData['password']);
        }
    
        // Update the user with validated data
        $user->update($validatedData);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
    

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
    
    
}
