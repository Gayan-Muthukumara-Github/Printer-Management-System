<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contract;
use App\Models\Rate;
use App\Models\User;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'address', 'city', 'country', 'logo', 'phone', 'fax', 'mobile'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($company) {
             $company->contracts()->delete();
             $company->rates()->delete();
             $company->users()->delete();
        });
    }


    public function deletable()
    {
        if($this->contracts->count() > 0){
            return false;
        }else{
            return true;
        }
    }


}
