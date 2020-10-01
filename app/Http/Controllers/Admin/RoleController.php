<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Role;
use App\Admin\Auth;
use Input;

class RoleController extends Controller
{
    /**
    * role index
    * @param null
    * @return view
    */
    public function index(){
    	$data = Role::get();
    	return view('admin.role.index',compact('data'));
    }

    /**
    * role assign page
    * @param null
    * @return view
    */
    public function assign(){
        // request type
        if(Input::method() == 'POST'){
        // write into DB
        $data = Input::only(['id','auth_id']);
        // instant the class to use the function in there
        $role = new Role();
        return $role -> assignAuth($data);

        }else{
        // judge the authority
        $top = Auth::where('pid','0') -> get();
        $cat = Auth::where('pid','!=','0') -> get();
        // get auth_id in the table role
        $ids_obj = Role::where('id',Input::get('id')) -> value('auth_ids');
        $ids =  explode(',',$ids_obj);
        // send the data to view
    	return view('admin.role.assign',compact('top','cat','ids'));
        }
    }
}
