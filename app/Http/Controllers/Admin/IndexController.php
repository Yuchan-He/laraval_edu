<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
    * admin manage page --content part
    * @param null 
    @ @return view Admin.index.index
    */
    public function index(){
    	return view('admin.index.index');
    }

    /**
    * admin manage page --content part
    * @param null 
    @ @return view Admin.index.welcome
    */
    public function welcome(){
    	return view('admin.index.welcome');
    }

}
