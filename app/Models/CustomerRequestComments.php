<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequestComments extends Model
{
    use HasFactory;
    protected $fillable = ['customer_request_id',
        'comment'
    ];

    public function customer_request(){
        return $this->belongsTo(CustomerRequest::class);
    }

}
