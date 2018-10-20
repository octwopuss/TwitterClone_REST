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
    		return view('scripts.main');
    	}        
    	return redirect()->route('login');
    }

    public function AuthenticateUser(Request $request){
    	$this->validate($request, [            
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->input('remember');
        $credentials = [
        'username' => $username, 
        'password' => $password,
        ];        


        if(!User::whereusername($username)->count()){
            return back()->with('error', 'username tidak terdaftar');
        }
        if (Auth::guard('users')->attempt($credentials, $remember)){        	
            return redirect()->route('dashboard');
        }else{
            return back()->with([
                'error' => 'Password Salah',
                'username' => $username,
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

    public function showFriend($username){    
        $user = User::where('username', $username)->first();
        return view('scripts.profile', compact('user'));
    }
}
