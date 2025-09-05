<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{

    public function store(Request $request)
    {

        $formSubmission = new FormSubmission();
        $formSubmission->programme_name = $request->input('programme_name');
        $formSubmission->transcript_number = $request->input('transcript_number');
        $formSubmission->registration_number = $request->input('registration_number');
        $formSubmission->school_name = $request->input('school_name');
        $formSubmission->student_name = $request->input('student_name');
        $formSubmission->nationality = $request->input('nationality');
        $formSubmission->gender = $request->input('gender');
        $formSubmission->result_type = $request->input('result_type');
        $formSubmission->result = $request->input('result');
        $formSubmission->remarks = $request->input('remarks');
        $formSubmission->save();
    
        return redirect('/')->with('success', 'Form submitted successfully!');
    }

}
