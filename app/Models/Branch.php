<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branch';
    public $timestamps = true;

    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    
    protected $fillable = [

        'branch_name',
        'branch_code',
        'pool_id',

    ];
}
