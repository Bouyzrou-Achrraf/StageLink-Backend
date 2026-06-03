<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable =[
        'user_id' ,
        'phone' ,
        'city' ,
        'field_od_study' ,
        'education_level' ,
        'skills' ,
        'cv' ,
        'bio'
    ];

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function applications(){
        return $this->hasMany(Application::calss);
    }

    public function favorites(){
        return $this->hasMany(Favorite::clas);
    }
}
