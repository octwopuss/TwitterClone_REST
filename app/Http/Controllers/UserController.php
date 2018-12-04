<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use App\Relationship;
use App\Tags;

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
        $myId = Auth::guard('users')->user()->id;
        $targetId = User::where('username', $username)->first()->id;
        $swap = [$myId, $targetId];                
        $relationship = Relationship::where('user_id_one', $swap[0])
                                    ->where('user_id_two', $swap[1])
                                    ->where('status', 1)
                                    ->first();        
        $user = User::where('username', $username)->first();
        return view('scripts.friendProfile', compact('user', 'relationship'));
    }

    public function postsByTags($tags){
        $tag = $tags;        
        return view('scripts.tagsSearch', compact('tag'));
    }

    //FITUR UNTUK MENGGANTI BIOGRAFI DAN PROFILE PICTURE DARI USER
    //TAMBAH JUGA FITUR UNTUK MENGHITUNG FOLLOWER DARI FOLLOWS DARI USER
    //BUAT BLADE TEMPLATE UNTUK MENGGANTI PROFILE USER
    //APAKAH DATA HARUS DITAMPILKAN DENGAN RESTFUL WAY???
    public function bio(){
        return view('bio');
    }

    public function searchFriend(Request $request){
        $result = $request->q;
        // dd($result);
        return view('frontend.friendSearchResult', compact('result'));
    }
}
