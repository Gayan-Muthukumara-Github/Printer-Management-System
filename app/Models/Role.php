<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'company_id'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($role) {
             $role->permissions()->delete();
        });
    }
}
