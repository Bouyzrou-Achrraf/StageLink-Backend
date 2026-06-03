<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'user_id' ,
        'sector' ,
        'city' ,
        'website ',
        'description' ,
        'logo'
    ];

    public function user (){
        return $this->belongsTo(user::class);
    }

    public function internshipOffers(){
        return $this->hasMany(InternshipeOffer::class);
    }
}
