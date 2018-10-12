<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;

class UserController extends Controller
{
    public function index(){
    	if(Auth::guard('users')->check()){
    		return view('index');
    	}        
    	return redirect()->route('login');
    }

    public function AuthenticateUser(Request $request){
    	$this->validate($request, [            
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');
        $credentials = [
        'email' => $email, 
        'password' => $password,
        ];        


        if(!User::whereemail($email)->count()){
            return back()->with('error', 'Email not registered');
        }
        if (Auth::guard('users')->attempt($credentials, $remember)){        	
            return redirect()->route('dashboard');
        }else{
            return back()->with([
                'error' => 'Password Salah',
                'email' => $email,
            ]);
        }
    }

    public function login(){
    	return view('login');
    }

    public function logout(){
    	Auth::guard('users')->logout();
        return redirect('/');
    }
}
