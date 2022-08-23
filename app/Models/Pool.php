<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;

    protected $table = 'pool';
    public $timestamps = true;

    protected $fillable = [
        'pool_name',
    ];

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
}
