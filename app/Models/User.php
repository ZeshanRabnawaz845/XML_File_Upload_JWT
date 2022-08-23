<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = true;

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'code',
        'mobile',
        'password',
        'designation_id',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
   
    
}