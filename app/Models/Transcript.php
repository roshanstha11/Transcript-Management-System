<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    //
    protected $table = 'transcript';

    public function formSubmission()
    {
        return $this->belongsTo(FormSubmission::class, 'form_submission_id');
    }
    protected $fillable = [
        'form_submission_id',
        'transcript_number',
        'issued_date',
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
