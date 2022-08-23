<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch_User extends Model
{
    use HasFactory;

    protected $table = 'branch_user';
    public $timestamps = true;

    protected $fillable = [

        'branch_id',
        'user_id',
    ];

}
