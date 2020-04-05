<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAdmin extends Model
{
    protected $table = 'company_admins';
    protected $fillable = ['company_id', 'name', 'email', 'contact_number', 'status'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
