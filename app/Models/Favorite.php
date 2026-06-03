<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'student_profile_id' ,
        'internship_offer_id' ,
    ] ;

    public function studentProfile(){
        return $this->belongsTo(StudentProfile::class);
    }

    public function internshipOffer(){
        return $this->belongsTo(InternshipOffer::class);
    }
}
