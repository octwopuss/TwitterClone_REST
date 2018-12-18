<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use App\Relationship;
use App\Tags;
use App\UserDetail;
use Hash;

class UserController extends Controller
{
    public function index(){
    	if(Auth::guard('users')->check()){
    		return view('scripts.main');
    	}        
    	return redirect()->route('login');
    }

    public function register(){
        return view('register');
    }

    public function storeRegister(Request $request){
        $this->validate($request, [      
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'repassword' => 'required',
        ]);

        if($request->password != $request->repassword){
            return redirect()->route('register')->withInput($request->except('password'))->with('error', 'Password tidak sama!');
        }
        
        $user = new User();        

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $userdetail = new UserDetail();
        $userdetail->user_id = $user->id;
        $userdetail->biograph = "Halo :)";
        $userdetail->profilepic = "placeholder/person.png";
        $userdetail->save();

        return redirect()->route('login')->with('info','Berhasil mendaftar, silahkan login!');
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

    public function editProfile($id){
        return view('frontend.profile', compact('id'));
    }

    public function storeProfile(Request $req, $id){
        $validation = $req->validate([
            'profilepic' => 'image|max:2048',
        ]);  

        $user = UserDetail::where('user_id', $id)->first();


        if($req->hasFile('profilepic')){            
            $fileName = $req->file('profilepic')->store('users_pic', 'public');                
            $user->profilepic = $fileName;
        }   

        $user->biograph = $req->bio;

        $user->save();

        return redirect()->route('showFriend', $user->user->username)->with('msg', 'Berhasil mengeupdate profil');
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


    public function bio(){
        return view('scripts.bio');
    }

    public function searchFriend(Request $request){
        $result = User::where('name','LIKE' , $request->q.'%')->get();
        return view('frontend.friendSearchResult', compact('result'));
    }
}