<?php
// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\PendingUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // protected $redirectTo = '/login';


    use RegistersUsers;

    protected $redirectTo = '/wait-for-approval';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pending_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'student_id' => ['required', 'string', 'max:255', 'unique:pending_users'],
            'department' => ['required', 'string', 'max:255'],
            'year_level' => ['required', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        PendingUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'student_id' => $data['student_id'],
            'department' => $data['department'],
            'year_level' => $data['year_level'],
            'section' => $data['section'],
        ]);
    
        return redirect('/wait-for-approval')->with('message', 'Registration successful. Please wait for admin approval.');
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect($this->redirectPath())->with('status', 'Wait for the approval');
    }

    public function redirectPath()
    {
        // return '/login';
        return '/wait-for-approval';
    }
    protected function registered(Request $request, $user)
    {
        return redirect($this->redirectPath())->with('message', 'Registration successful. Please wait for approval.');
    }
}
