<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Emadadly\LaravelUuid\Uuids;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public $incrementing = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        $this->hasMany(Order::class);
    }

    public function setPhoneNumberAttribute($phone_number)
    {
      
        if(substr($phone_number,0,1) === "0" || substr($phone_number,0,1) === "+"){

            $phone_number = substr($phone_number,1);
 
            $this->attributes['phone_number'] =  "+255". $phone_number;
              
        }
        
        if (substr($phone_number,0,3) === "255") {

            $this->attributes['phone_number'] = "+". $phone_number;

         }
    }

}
