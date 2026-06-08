<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyProfile;
use App\Models\Application;
use App\Models\Favorite;

class InternshipOffer extends Model
{
    protected $fillable = [
        'company_profile_id' ,
        'title' ,
        'description' ,
        'duration' ,
        'location' ,
        'required_skills' ,
        'deadline' ,
        'status'        
    ];

    public function companyProfile(){
        return $this->belongsTo(CompanyProfile::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
}
