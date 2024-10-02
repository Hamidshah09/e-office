<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class usersController extends Controller
{
    public function login(Request $request){
        $credential = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::attempt($credential)){
            return view('dashboard');
        }
    }
    public function index(){
        $users = User::join('roles','roles.id', '=', 'role_id')
                        ->get(['users.id', 'users.name', 'users.email', 'users.status', 'roles.role']);
        $roles = roles::all();
        return view('login.usergrid', compact('users', 'roles'));
    }

    public function create(){
        $roles = roles::all();
        return view('login.createuser', compact('roles'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|confirmed',
            'status'=>'required|in:"Active","Deactive"',
            'role_id'=>'required|numeric',
        ]);
        User::create($data);
        return redirect()->route('users.index')->with('status', 'New User Created Successfully');

    }
    public function edit(string $id){
        $user = User::findorfail($id);
        $roles = roles::all();
        return view('login.edituser', compact('roles', 'user'));
    }
    public function update(Request $request, string $id){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'status'=>'required|in:"Active","Deactive"',
            'role_id'=>'required|numeric',
        ]);
        if ($request->password){
            $request->validate([
                'password'=>'confirmed|max:255',
            ]);
            User::where('id', '=', $id)
                ->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>$request->password,
                    'status'=>$request->status,
                    'role_id'=>$request->role_id,
                ]);
        }else{
            User::where('id', '=', $id)
                ->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'status'=>$request->status,
                    'role_id'=>$request->role_id,
                ]);
        }
        
        return redirect()->route('users.index')->with('status', 'User Updated Successfully');
    }
}
