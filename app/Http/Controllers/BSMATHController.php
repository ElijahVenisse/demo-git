<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mpdf\Mpdf;
use Validator;

class BSMATHController extends Controller
{
    public function index()
    {
        $users = User::where('department', 'BSMATH')->orderBy('created_at', 'desc')->get();

        foreach ($users as $user) {
            $qrCode = QrCode::format('png')->size(100)->generate($user->name);
            $user->qr_code = "data:image/png;base64," . base64_encode($qrCode);
        }

        // Get unique departments and year levels from the users
        $departments = User::select('department')->distinct()->pluck('department');
        $yearLevels = User::select('year_level')->distinct()->pluck('year_level');

        return view('admin.bsmath', compact('users', 'departments', 'yearLevels'));
    }

    public function create()
    {
        return view('admin.create_bsmath');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'student_id' => 'required|string|max:255|unique:users,student_id',
            'year_level' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        // Set department to BSMATH
        $validatedData['department'] = 'BSMATH';
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('admin.bsmath')->with('success', 'BSMATH student added successfully');
    }



    public function generateReport()
    {
        $users = User::where('department', 'BSMATH')->orderBy('created_at', 'desc')->get();

        $html = view('admin.bsmath_report', compact('users'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('bsmath_students_report.pdf', 'D');
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
