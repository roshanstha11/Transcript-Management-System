<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    
    public function transcript()
    {
        return $this->hasOne(Transcript::class, 'form_submission_id');
    }


    protected $fillable = [
        'programme_name',
        'registration_number',
        'school_name',
        'student_name',
        'nationality',
        'gender',
        'result_type',
        'result',
        'remarks',
    ];


}

