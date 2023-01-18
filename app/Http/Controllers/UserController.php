<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index_login(){
        return view('auth.login');
    }

    public function index_register(){
        return view('auth.register');
    }

    public function login(Request $request){
        $cred = $request->validate([
            'email' =>  'required|email',
            'password' => 'required|min:8|max:20'
        ]);

        if(!Auth::attempt($cred)){
            return redirect()->back()->with('danger','Login Failed.');
        }else{
            return redirect()->route('index_home');
        }
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:20',
            'confirm' => 'required|same:password',
            'terms' => 'required'
        ],[
            'name.required' => 'The name field must be filled',
            'email.required' => 'The email field must be filled',
            'email.email' => 'Invalid email format.',
            'password.required' => 'The password field must be filled',
            'confirm.required' => 'The confirm password field must be filled',
            'confirm.same' => 'Password Mismatch',
            'terms.required' => 'You Must Agree to the Terms and Conditions'
        ]);

        $newUser = new User();
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password = Hash::make($request->input('password'));
        $newUser->role = 'Member';
        $newUser->created_at = now();
        $newUser->save();

        return redirect()->route('index_login')->with('success', 'User Registered Successfully!');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('index_login');
    }
}
