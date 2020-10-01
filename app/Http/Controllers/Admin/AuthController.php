<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use App\Admin\Auth;
use DB;

class AuthController extends Controller
{
    /**
    * admin manager auth page
    * @param null
    * @return view manager/auth
    */
    public function index(){
        // get the data form table
        $data = DB::table('auth as t1') 
                -> select('t1.*','t2.auth_name as parent_name')
                -> leftJoin('auth as t2','t1.pid','=','t2.id')
                -> get();
       
    	return view('admin.auth.index',compact('data'));
    }

    /**
    * add auth in admin manager auth page
    * @param 
    * @return view manager/auth
    */
    public function add(){
    	if(Input::method() == 'POST'){
    		// insert data to table by post
    		$data = Input::except('_token');
    		$result = Auth::insert($data);
    		// if success to insert ,return 1 to Response in chrome
    		return $result ? '1':'0';
    	}else{
    		// check the PID is 0
    		$parents = Auth::where('pid','=','0') -> get();
    		//show the view
    		return view('admin.auth.add',compact('parents'));
    	}
    }    

}
