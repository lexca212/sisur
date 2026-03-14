<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }


    public function create()
    {
        $role_select = ["direktur", "tu", "kabag", "kasubag", "pj"];

        return view('users.create', compact('role_select'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'role'=>'required|in:direktur,tu,kabag,kasubag,pj'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>$request->role
        ]);

        return redirect()->route('users.index')
        ->with('success','User berhasil dibuat');
    }


    public function edit($id)
    {
        $context = [
            'user' => User::findOrFail($id),
            'role_select' => ["direktur", "tu", "kabag", "kasubag", "pj"]
        ];

        return view('users.edit', $context);
    }


    public function update(Request $request,$id)
    {

        $user = User::findOrFail($id);

        $request->validate([
            'name'=>'required',
            'email'=>"required|email|unique:users,email,$id",
            'role'=>'required|in:direktur,tu,kabag,kasubag,pj'
        ]);

        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role
        ];

        if($request->password){
            $data['password']=$request->password;
        }

        $user->update($data);

        return redirect()->route('users.index')
        ->with('success','User berhasil diupdate');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')
        ->with('success','User berhasil dihapus');
    }
}
