<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Member;
use DB;
use Input;

class MemberController extends Controller
{
    /**
    * member page
    * @param null
    * @return view 
    */
    public function index(){
    	// get the data from table member
    	$data = Member::get();
    	return view('admin.member.index',compact('data'));
    }

    /**
    * add member page
    * @param input data
    * @return write to DB 
    */
    public function add(){
        // judge whether the request is post
        if(Input::method() == 'POST'){

            //
        }
           // get the country data
            $country = DB::table('area') -> where('pid','0') -> get();
            return view('admin.member.add',compact('country'));
    }

    /**
    * ajax四级联动获取下属地址
    * @param null
    * @return view 
    */
    public function getAreaById(){
        // get the country id
        $id = input::get('id');
        #dd($id);
        $data = DB::table('area') -> where('pid',$id) -> get();
        return response() -> json($data);
    }

    /**
    * play the video
    * @param video_id 
    * @return video_addr
    */
    public function playVideo(){
        // get the video id
        $id = Input::get('id');
        // get the video address
        $addr = Member::where('id',$id) -> value('video');
        // play the video according to the address
        return "<video src='$addr' width=50% controls='controls'>Your browers not support this play</video>";

    }

}
