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
}
