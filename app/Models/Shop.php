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

    public function scopeFilter($query, array $filters)
    {
        if(isset($filters['search'])){

            $query->where('shop_name', 'like', '%'. request('search'). '%')

            ->orWhere('location', 'like', '%'. request('search'). '%')

            ->orWhere('email', 'like', '%'. request('search'). '%')

            ->orWhere('phone_number', 'like', '%'. request('search'). '%');
        }
    }
}
