<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PublicController extends Controller
{
    /**
    * admin login page
    * @param null
    * @return view public/login
    */
    public function login(){
    	return view('admin.public.login');
    }

	/**
    * verity admin login page
    * @param Request $request
    * @return view public/login
    */
    public function check(Request $request){
    	//　validate the data
    	$this -> validate($request,[
    		'username' => 'required|min:2|max:20',
    		'password' => 'required|min:6',
    		'captcha'  => 'required|size:5|captcha'
    	]);

        //verity the idenity
        $data = $request -> only(['username','password']);
        //can login in when the status is 2
        $data['status'] = '2'; 
        $result = Auth::guard('admin') -> attempt($data,$request -> get('online'));
        if($result){
            return redirect('/admin/index/index');
        }else{
            return redirect('/admin/public/login') -> withErrors(['loginError' => 'username or password is wrong']);
        }
    }

    /**
    * logout admin page
    * @param null
    * @return view public/logout
    */
    public function logout(){
        Auth::guard('admin') -> logout();
        return redirect('/admin/public/login');
    }


}
