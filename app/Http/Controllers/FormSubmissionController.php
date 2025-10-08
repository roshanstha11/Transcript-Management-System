<?php

namespace App\Http\Controllers;


use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\FormSubmission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Transcript;

class FormSubmissionController extends Controller
{
    
    // Display all the data from the database

    public function index()
    {
        $formSubmissions = FormSubmission::all();
        return view('formSubmissions.show', compact('formSubmissions'));
    }

    public function viewAllRecord()
    {
        $formSubmissions = FormSubmission::all();
        return view('formSubmissions.viewAllRecord', compact('formSubmissions'));
    }


    // Creates the data entered in the form to the database

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'programme_name'      => 'required',
            'transcript_number'   => 'required|unique:transcript,transcript_number',
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

        // ✅ Log activity here
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created new record with ID ' . $formSubmission->id,
        ]);
    
        return redirect()->route('index')->with('success', 'New record created');
    }

    public function createForm()
    {
        return view('formSubmissions.createForm');
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
            Rule::unique('transcript', 'transcript_number')->ignore($form->transcript->id)
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

        // ✅ Log activity here
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Updated record with ID ' . $form->id,
        ]);

        return redirect()->route('view-all-record')->with('success', 'Record updated successfully.');

    }

    public function destroy( $id )
    {
        // Find the student by ID
        $form = FormSubmission::findOrFail($id);

        // Delete it
        $form->delete();

        // ✅ Log activity here
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted record with ID ' . $form->id,
        ]);

        // Redirect back with a success message
        return redirect()->route('view-all-record')->with('success', 'Record deleted successfully.');
    }

    public function checkTranscript(Request $request)
    {
        $query = Transcript::where('transcript_number', $request->transcript_number);
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

    // Generate Transcript Number and save to transcripts table
    public function generateTranscript(FormSubmission $form)
    {
        
        $transcriptNumber = str_pad($form->id, 6, '1000', STR_PAD_LEFT);
        
        $form->transcript()->create([
            'transcript_number' => $transcriptNumber,
            'issued_date' => now(),
        ]);

        // ✅ Log activity here
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Generated transcript for record ID ' . $form->transcript->id,
        ]);

        return redirect()->back()->with('success', 'Transcript number generated: ' . $transcriptNumber);
    }

    public function filter(Request $request)
    {
        $date = $request->date;

        $query = Transcript::query();

        if ($date) {
            $query->whereDate('updated_date', $date);
        }

        return response()->json($query->orderBy('id', 'desc')->get());
    }

}
