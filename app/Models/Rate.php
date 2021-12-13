<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Rate extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'rate',
        'start_at',
        'end_at'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
