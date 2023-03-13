<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $hidden = [
        'name_ar',
        'name_en',
        'terms_ar',
        'terms_en',
        'privacy_ar',
        'privacy_en',
        'about_ar',
        'about_en',
        'contacts_ar',
        'contacts_en',
    ];

    protected $appends = ['name','terms','privacy','about','contacts'];

    public function getPrivacyAttribute()
    {
        if (Lang() == "ar") {
            return $this->privacy_ar;
        }
        return $this->privacy_en;
    }

    public function getTermsAttribute()
    {
        if (Lang() == "ar") {
            return $this->terms_ar;
        }
        return $this->terms_en;
    }

    public function getNameAttribute()
    {
        if (Lang() == "ar") {
            return $this->name_ar;
        }
        return $this->name_en;
    }

    public function getAboutAttribute()
    {
        if (Lang() == "ar") {
            return $this->about_ar;
        }
        return $this->about_en;
    }

    public function getContactsAttribute()
    {
        if (Lang() == "ar") {
            return $this->contacts_ar;
        }
        return $this->contacts_en;
    }
}
