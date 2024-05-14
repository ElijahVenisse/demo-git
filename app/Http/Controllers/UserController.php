<?php



namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
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
        
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6',
        ]);

        if ($request->has('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        $user->update($validatedData);
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
