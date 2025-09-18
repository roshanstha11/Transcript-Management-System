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
        'transcript_number',
        'issued_date',
    ];

}
