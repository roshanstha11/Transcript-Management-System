<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{

    // Display all the data from the database

    public function index()
    {
        $formSubmissions = FormSubmission::all();
        return view('formSubmissions.index', compact('formSubmissions'));
    }


    // Creates the data entered in the form to the database

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
    
        return redirect('/')->with('success', 'New record created successfully!');
    }

    public function create()
    {
        return view('formSubmissions.create');
    }

    public function editForm(FormSubmission $form)
    {
        return view('formSubmissions.edit',['form' => $form]);

    }

    public function updateForm( FormSubmission $form, Request $request) 
    {
        // Use the existing model instance '$form' that Laravel provides.
        // Do NOT create a new one with 'new FormSubmission()'.

        $form->programme_name = $request->input('programme_name');
        $form->transcript_number = $request->input('transcript_number');
        $form->registration_number = $request->input('registration_number');
        $form->school_name = $request->input('school_name');
        $form->student_name = $request->input('student_name');
        $form->nationality = $request->input('nationality');
        $form->gender = $request->input('gender');
        $form->result_type = $request->input('result_type');
        $form->result = $request->input('result');
        $form->remarks = $request->input('remarks');
        
        // Save the changes to the existing model.
        $form->save();
        
        return redirect('/')->with('success', 'Form updated successfully!');
    }

    public function destroy( FormSubmission $form)
    {
        // Find the student by ID
        // $formSubmissions = FormSubmission::findOrFail($id);

        // Delete it
        $form->delete();

        // Redirect back with a success message
        return redirect('/')->with('success', 'Record deleted successfully.');
    }

}
