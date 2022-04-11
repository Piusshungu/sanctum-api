<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Shop extends Model
{
    use HasFactory;
    
    use Uuids;

    protected $guarded = ['id'];

    public $incrementing = false;

    protected $rules = [
        
        'email' => 'sometimes|required|email|unique:users',
        
    ];

    public function scopeFilter($query, array $filters)
    {
        if(isset($filters['search'])){

            $query->where('shop_name', 'like', '%'. request('search'). '%')

            ->orWhere('location', 'like', '%'. request('search'). '%')

            ->orWhere('email', 'like', '%'. request('search'). '%')

            ->orWhere('phone_number', 'like', '%'. request('search'). '%');
        }
    }

    public function setPasswordAttribute($password){
        
        $this->attributes['password'] = bcrypt($password);
    }

    public function setPhoneNumberAttribute($phone_number)
    {
       
        if(substr($phone_number,0,1) === "0" || substr($phone_number,0,1) === "+"){

            $phone_number = substr($phone_number,1);
 
            $this->attributes['phone_number'] = "+255". $phone_number;
            
        }
        
        if (substr($phone_number,0,3) === "255") {

            $this->attributes['phone_number'] = "+". $phone_number;

         }
        
    }
}
