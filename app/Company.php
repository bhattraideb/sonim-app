<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'email', 'address', 'contact_number', 'status'];

    public function admins()
    {
        return $this->hasMany(CompanyAdmin::class, 'id', 'company_id');
    }

    public static function boot() {
        parent::boot();
        static::deleted(function($company) {
            $company->admins()->delete();
        });
    }
}
