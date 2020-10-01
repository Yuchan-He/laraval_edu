<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    // connect to table
    protected $table = 'auth';
    // stop the timestamps
    public $timestamps = false;
}
