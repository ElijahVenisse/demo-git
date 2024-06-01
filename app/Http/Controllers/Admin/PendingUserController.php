<?php
// app/Http/Controllers/Admin/PendingUserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendingUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PendingUserController extends Controller
{
    public function index()
    {
        $pendingUsers = PendingUser::all();
        return view('admin.pending_users.index', compact('pendingUsers'));
    }

    public function approve($id)
    {
        $pendingUser = PendingUser::findOrFail($id);
        $user = User::create([
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

    // public function reject($id)
    // {
    //     $pendingUser = PendingUser::findOrFail($id);
    //     $pendingUser->delete();
    //     return redirect()->route('admin.pending_users.index')->with('success', 'User rejected successfully');
    // }

    public function destroyPending($id)
    {
        $pendingUser = PendingUser::findOrFail($id);
        $pendingUser->delete();
    
        return redirect()->route('users.index', ['#pending-users'])->with('success', 'Pending user rejected successfully');
    }
    
}
