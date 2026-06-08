<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'student_profile_id' ,
        'internship_offer_id' ,
        'status'
    ];

    public function studentProfile(){
        return $this->belongsTo(StudentProfile::class);
    }

    public function internshipOffer(){
        return $this->belongsTo(InternshipOffer::class);

    }
}
