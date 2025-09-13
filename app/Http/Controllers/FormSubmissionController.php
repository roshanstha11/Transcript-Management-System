<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        // Validation
        $request->validate([
            'programme_name'      => 'required',
            'transcript_number'   => 'required|unique:form_submissions,transcript_number',
            'registration_number' => 'required|unique:form_submissions,registration_number',
            'school_name'         => 'required',
            'student_name'        => 'required',
            'nationality'         => 'required',
            'gender'              => 'required',
            'result_type'         => 'required',
            'result'              => 'required',
        ], [
            'transcript_number.unique'   => 'The transcript number is already taken.',
            'registration_number.unique' => 'The registration number is already taken.',
        ]);

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
    
        return redirect()->route('index')->with('success', 'New record created');
    }

    public function create()
    {
        return view('formSubmissions.create');
    }

    public function editForm($id)
    {
        $form = FormSubmission::findOrFail($id);
        return view('formSubmissions.edit', compact('form'));
    }

    public function updateForm(Request $request, $id) 
    {

        $form = FormSubmission::findOrFail($id);
        // Validation
        $request->validate([
        'programme_name'      => 'required',
        'transcript_number'   => [
            'required',
            Rule::unique('form_submissions', 'transcript_number')->ignore($form->id)
        ],
        'registration_number' => [
            'required',
            Rule::unique('form_submissions', 'registration_number')->ignore($form->id)
        ],
        'school_name'         => 'required',
        'student_name'        => 'required',
        'nationality'         => 'required',
        'gender'              => 'required',
        'result_type'         => 'required',
        'result'              => 'required',
        ]);

        $form->update($request->all());

        return redirect()->route('index')->with('success', 'Record updated successfully.');

    }

    public function destroy( FormSubmission $form)
    {
        // Find the student by ID
        // $formSubmissions = FormSubmission::findOrFail($id);

        // Delete it
        $form->delete();

        // Redirect back with a success message
        return redirect()->route('index')->with('success', 'Record deleted successfully.');
    }

    public function checkTranscript(Request $request)
    {
        $query = FormSubmission::where('transcript_number', $request->transcript_number);
        if ($request->id) $query->where('id', '!=', $request->id);
        $exists = $query->exists();
        return response()->json(['exists' => $exists]);

    }

    public function checkRegistration(Request $request)
    {
        $query = FormSubmission::where('registration_number', $request->registration_number);
        if ($request->id) $query->where('id', '!=', $request->id);
        $exists = $query->exists();
        return response()->json(['exists' => $exists]);

    }


}
