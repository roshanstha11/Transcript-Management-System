@extends('layouts.app')
@section('title', 'Edit Record')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="form-title">Transcript Entry Form</h2>
                    <form name="index" id = "index" method="POST" action="/edit-form/{{$form->id}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Program -->
                            <div class="col-md-6 mb-3">
                                <label for="program" class="form-label">Program</label>
                                <select class="form-select" id="program" name="programme_name" value="{{$form->programme_name}}" required>
                                    <option value="">Select Program</option>
                                    <option value="BSc" {{ $form->programme_name == 'BSc' ? 'selected' : '' }}>BSc</option>
                                    <option value="BA" {{ $form->programme_name == 'BA' ? 'selected' : '' }}>BA</option>
                                    <option value="BBA" {{ $form->programme_name == 'BBA' ? 'selected' : '' }}>BBA</option>
                                </select>
                            </div>

                            <!-- Transcript No -->
                            <div class="col-md-6 mb-3">
                                <label for="transcript_no" class="form-label">Transcript No</label>
                                <input type="number" class="form-control" id="transcript_number" name="transcript_number" value="{{$form->transcript_number}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Registration No -->
                            <div class="col-md-6 mb-3">
                                <label for="registration_no" class="form-label">Registration No</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{$form->registration_number}}" required>
                            </div>

                            <!-- School/College -->
                            <div class="col-md-6 mb-3">
                                <label for="school" class="form-label">School/College</label>
                                <select class="form-select" id="school" name="school_name" required>
                                    <option value="">Select School/College</option>
                                    <option value="Tribhuvan University" {{ $form->school_name == 'Tribhuvan University' ? 'selected' : '' }}>Tribhuvan University</option>
                                    <option value="Kathmandu University" {{ $form->school_name == 'Kathmandu University' ? 'selected' : '' }}>Kathmandu University</option>
                                    <option value="Pokhara University" {{ $form->school_name == 'Pokhara University' ? 'selected' : '' }}>Pokhara University</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Name of the Student -->
                            <div class="col-md-6 mb-3">
                                <label for="student_name" class="form-label">Name of the Student</label>
                                <input type="text" value="{{$form->student_name}}" class="form-control" id="student_name" name="student_name" required>
                            </div>

                            <!-- Nationality -->
                            <div class="col-md-6 mb-3">
                                <label for="nationality" class="form-label">Nationality</label>
                                <select class="form-select" id="nationality"  name="nationality" required>
                                    <option value="">Select Nationality</option>
                                    <option value="Nepali" {{ $form->nationality == 'Nepali' ? 'selected' : '' }}>Nepali</option>
                                    <option value="Indian" {{ $form->nationality == 'Indian' ? 'selected' : '' }}>Indian</option>
                                    <option value="Other" {{ $form->nationality == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Gender -->
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ $form->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $form->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $form->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <!-- CGPA / Percentage -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Result Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="result_type" id="cgpa" value="cgpa" {{ old('result_type', $form->result_type) == 'cgpa' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cgpa">CGPA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="result_type" id="percentage"  value="percentage" {{ old('result_type', $form->result_type) == 'percentage' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="percentage">Percentage</label>
                                </div>
                                <input type="number" class="form-control mt-2" step="0.01" name="result" value="{{ old('result', $form->result) }}" placeholder="Enter CGPA or Percentage" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Remarks -->
                            <div class="col-md-6 mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <input type="text" class="form-control" id="remarks" value="{{$form->remarks}}" name="remarks">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 