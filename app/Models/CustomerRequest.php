<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Concat;

class CustomerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'contact_id',
        'customer_portal_id',
        'request_type',
        'company_printer_id',
        'status',
    ];

    public function details(){
        return $this->hasMany(CustomerRequestDetail::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function customer_portal(){
        return $this->belongsTo(CustomerPortal::class);
    }

    public function contact(){
        return $this->belongsTo(Contact::class);
    }

    public function company_printer(){
        return $this->belongsTo(CompanyPrinter::class);
    }

    public function comments(){
        return $this->hasMany(CustomerRequestComments::class);
    }

    public function last_sent($request_type_id)
    {
        
    }
}
