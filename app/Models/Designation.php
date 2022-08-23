<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $table = 'designation';
    public $timestamps = true;
    
    public function user()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'designation_name',
    ];


}
