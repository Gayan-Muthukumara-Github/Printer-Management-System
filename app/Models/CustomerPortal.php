<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPortal extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id',
    'key'];


    public function contact()
    {
        return $this->belongsTo(Contact::class, 'customer_id');
    }
}
