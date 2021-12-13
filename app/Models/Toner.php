<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toner extends Model
{
    use HasFactory;
    protected $fillable = [
        'part_number',
        'name',
        'duty_cycle',
        'cost',
        'printer_id'
    ];
}
