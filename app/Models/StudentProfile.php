<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Application;
use App\Models\Favorites;

class StudentProfile extends Model
{
    protected $fillable =[
        'user_id' ,
        'phone' ,
        'city' ,
        'field_of_study' ,
        'education_level' ,
        'skills' ,
        'cv' ,
        'bio'
    ];

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
}
