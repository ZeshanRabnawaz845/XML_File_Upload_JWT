<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation_User extends Model
{
    use HasFactory;

    protected $table = 'designation_user';
    public $timestamps = true;

    protected $fillable = [

        'user_id',
        'manager_id',
    ];

}
