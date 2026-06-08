<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InternshipOffer;

class CompanyProfile extends Model
{
    protected $fillable = [
        'user_id' ,
        'sector' ,
        'city' ,
        'website',
        'description' ,
        'logo'
    ];

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function internshipOffers(){
        return $this->hasMany(InternshipOffer::class);
    }
}
