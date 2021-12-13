<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequestDetail extends Model
{
    use HasFactory;
    protected $fillable = ['customer_request_id',
    'request_type_id',
    'status',];

    public function customer_request(){
        return $this->belongsTo(CustomerRequest::class);
    }

    public function toner()
    {
        return $this->belongsTo(Toner::class, 'request_type_id');
    }

}
