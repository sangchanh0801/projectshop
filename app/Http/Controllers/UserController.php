<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\SaveUser;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
    public function allUser(){
        $users = User::paginate(4);
        return view('admin.user.all_users', compact('users'));
    }
    public function addUser(){
        $roles = role::get();
        return view('admin.user.add_users', compact('roles'));
    }
    public function saveUser(Request $request){
        $newUser = new CreateNewUser();
        $user = $newUser->create($request->only(['name', 'email', 'password', 'password_confirmation']));
        // $user = User::create($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);
        return redirect()->route('alluser')->with('mess', 'Tạo người dùng thành công');
    }
    public function editUser($id){
        $users =User::findOrFail($id);
        $roles = role::get();
        $rolesuser = $users->roles;
        return view('admin.user.edit_users', compact('users', 'roles', 'rolesuser'));
    }
    public function updateUser(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);
        return redirect()->route('alluser');
    }
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('mess', 'Xóa người dùng thành công');
    }















}
