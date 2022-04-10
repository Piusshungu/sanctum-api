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
}