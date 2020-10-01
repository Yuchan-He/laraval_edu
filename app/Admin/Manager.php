<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
//add auth’s trait
use Illuminate\Auth\Authenticatable;

class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //make the model to control DB
    protected $table = 'manager';
    //use trait
    use Authenticatable;
    // relate to the Table role--one to one
    public function role(){
    	return $this ->  hasOne('App\Admin\Role','id','role_id');
    }
}
