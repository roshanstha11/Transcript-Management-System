@extends('layouts.app')
@section('title', 'Create New Record')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="form-title">Transcript Entry Form</h2>
                    <form name="index" id = "index" method="POST" action="{{ url('submit-form') }}">
                        @csrf
                        <div class="row">
                            <!-- Program -->
                            <div class="col-md-6 mb-3">
                                <label for="program" class="form-label">Program</label>
                                <select class="form-select" id="program" name="programme_name" required>
                                    <option value="">Select Program</option>
                                    <option value="BSc">BSc</option>
                                    <option value="BA">BA</option>
                                    <option value="BBA">BBA</option>
                                </select>
                            </div>

                            <!-- Transcript No -->
                            <div class="col-md-6 mb-3">
                                <label for="transcript_no" class="form-label">Transcript No</label>
                                <input type="number" class="form-control" id="transcript_number" name="transcript_number" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Registration No -->
                            <div class="col-md-6 mb-3">
                                <label for="registration_no" class="form-label">Registration No</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number" required>
                            </div>

                            <!-- School/College -->
                            <div class="col-md-6 mb-3">
                                <label for="school" class="form-label">School/College</label>
                                <select class="form-select" id="school" name="school_name" required>
                                    <option value="">Select School/College</option>
                                    <option value="Tribhuvan University">Tribhuvan University</option>
                                    <option value="Kathmandu University">Kathmandu University</option>
                                    <option value="Pokhara University">Pokhara University</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Name of the Student -->
                            <div class="col-md-6 mb-3">
                                <label for="student_name" class="form-label">Name of the Student</label>
                                <input type="text" class="form-control" id="student_name" name="student_name" required>
                            </div>

                            <!-- Nationality -->
                            <div class="col-md-6 mb-3">
                                <label for="nationality" class="form-label">Nationality</label>
                                <select class="form-select" id="nationality" name="nationality" required>
                                    <option value="">Select Nationality</option>
                                    <option value="Nepali">Nepali</option>
                                    <option value="Indian">Indian</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Gender -->
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- CGPA / Percentage -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Result Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="result_type" id="cgpa" value="CGPA" checked>
                                    <label class="form-check-label" for="cgpa">CGPA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="result_type" id="percentage" value="percentage">
                                    <label class="form-check-label" for="percentage">Percentage</label>
                                </div>
                                <input type="number" class="form-control mt-2" step="0.01" name="result" placeholder="Enter CGPA or Percentage" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Remarks -->
                            <div class="col-md-6 mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <input type="text" class="form-control" id="remarks" name="remarks">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


