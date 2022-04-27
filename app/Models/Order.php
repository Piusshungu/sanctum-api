<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Order extends Model
{
    use HasFactory;

    use Uuids;

    protected $guarded = ['id'];

    public $incrementing = false;

    public function users()
    {
        $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if(isset($filters['search'])){

            $query->where('user_id', 'like', '%'. request('search'). '%')

            ->orWhere('created_at', 'like', '%'. request('search'). '%')

            ->orWhere('product_id', 'like', '%'. request('search'). '%')

            ->orWhere('phone_number', 'like', '%'. request('search'). '%');
        }
    }
}
