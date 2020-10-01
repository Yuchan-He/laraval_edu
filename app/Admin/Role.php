<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //make the model to control DB
    protected $table = 'role';
    // stop the timestamps
    public $timestamps = false;

    public function assignAuth($data){
    // get the auth_ids data,change the array to string by [,]
    $post['auth_ids'] = implode(',',$data['auth_id']);
    //get the auth_ac data from table auth
    $tmp = \App\Admin\Auth::where('pid','!=','0') 
    		-> whereIn('id',$data['auth_id'])
    		-> get();

    // combine the column[controller] and column[action]
    $ac = '';
    foreach($tmp as $key => $value){
    $ac = $ac.$value -> controller.'@'.$value -> action.',';
    }
	// trim the last [,] in the end   
    $post['auth_ac'] = strtolower(rtrim($ac,','));
    // write into the table role 
    return self::where('id',$data['id']) -> update($post);
    }

}
