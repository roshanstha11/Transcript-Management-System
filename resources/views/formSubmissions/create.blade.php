@extends('layouts.app')
@section('title', 'Create New Record')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="form-title">Transcript Entry Form</h2>
                    <form name="index" id = "index" method="POST" action="{{ route('submit-form') }}">
                        @csrf
                        <div class="row">
                            <!-- Program -->
                            <div class="col-md-6 mb-3">
                                <label for="program" class="form-label">Program</label>
                                <select class="form-select" id="program" name="programme_name" required>
                                    <option value="">Select Program</option>
                                    <option value="BSc" {{ old('programme_name') == 'BSc' ? 'selected' : '' }}>BSc</option>
                                    <option value="BA" {{ old('programme_name') == 'BA' ? 'selected' : '' }}>BA</option>
                                    <option value="BBA" {{ old('programme_name') == 'BBA' ? 'selected' : '' }}>BBA</option>
                                </select>
                            </div>

                            <!-- Transcript No -->
                            <div class="col-md-6 mb-3">
                                <label for="transcript_no" class="form-label">Transcript No</label>
                                <input type="number" class="form-control" id="transcript_number" name="transcript_number" value="{{ old('transcript_number')}}" required>
                                <span id="transcript-error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Registration No -->
                            <div class="col-md-6 mb-3">
                                <label for="registration_no" class="form-label">Registration No</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ old('registration_number')}}" required>
                                <span id="registration-error" class="text-danger"></span>
                            </div>

                            <!-- School/College -->
                            <div class="col-md-6 mb-3">
                                <label for="school" class="form-label">School/College</label>
                                <select class="form-select" id="school" name="school_name" required>
                                    <option value="">Select School/College</option>
                                    <option value="Tribhuvan University" {{ old('school_name') == 'Tribhuvan University' ? 'selected' : '' }}>Tribhuvan University</option>
                                    <option value="Kathmandu University" {{ old('school_name') == 'Kathmandu University' ? 'selected' : '' }}>Kathmandu University</option>
                                    <option value="Pokhara University" {{ old('school_name') == 'Pokhara University' ? 'selected' : '' }}>Pokhara University</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Name of the Student -->
                            <div class="col-md-6 mb-3">
                                <label for="student_name" class="form-label">Name of the Student</label>
                                <input type="text" class="form-control" id="student_name" name="student_name" value="{{ old('student_name') }}" required>
                            </div>

                            <!-- Nationality -->
                            <div class="col-md-6 mb-3">
                                <label for="nationality" class="form-label">Nationality</label>
                                <select class="form-select" id="nationality" name="nationality" required>
                                    <option value="">Select Nationality</option>
                                    <option value="Nepali" {{ old('nationality') == 'Nepali' ? 'selected' : '' }}>Nepali</option>
                                    <option value="Indian" {{ old('nationality') == 'Indian' ? 'selected' : '' }}>Indian</option>
                                    <option value="Other" {{ old('nationality') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Gender -->
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <!-- CGPA / Percentage -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Result Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="result_type" id="cgpa" value="cgpa" {{ old('result_type') == 'cgpa' ? 'checked' : '' }} checked>
                                    <label class="form-check-label" for="cgpa">CGPA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="result_type" id="percentage" value="percentage" {{ old('result_type') == 'percentage' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="percentage">Percentage</label>
                                </div>
                                <input type="number" class="form-control mt-2" step="0.01" name="result" value="{{ old('result') }}" placeholder="Enter CGPA or Percentage" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Remarks -->
                            <div class="col-md-6 mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <input type="text" class="form-control" id="remarks" value="{{ old('remarks') }}" name="remarks">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- jQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Custom JS for validation --}}
    <script>
        $(document).ready(function() {
        let transcriptValid = true;
        let registrationValid = true;

        // Transcript number check
        $('#transcript_number').on('input', function() {
            let transcript = $(this).val();
            if(transcript.length > 0){
                $.post("{{ route('check.transcript') }}", 
                    { transcript_number: transcript, _token: '{{ csrf_token() }}' }, 
                    function(data){
                        if(data.exists){
                            $('#transcript-error').text('Transcript number is already taken.');
                            transcriptValid = false;
                        } else {
                            $('#transcript-error').text('');
                            transcriptValid = true;
                        }
                    }
                );
            } else {
                $('#transcript-error').text('');
                transcriptValid = true;
            }
        });

        // Registration number check
        $('#registration_number').on('input', function() {
            let regNo = $(this).val();
            if(regNo.length > 0){
                $.post("{{ route('check.registration') }}", 
                    { registration_number: regNo, _token: '{{ csrf_token() }}' }, 
                    function(data){
                        if(data.exists){
                            $('#registration-error').text('Registration number is already taken.');
                            registrationValid = false;
                        } else {
                            $('#registration-error').text('');
                            registrationValid = true;
                        }
                    }
                );
            } else {
                $('#registration-error').text('');
                registrationValid = true;
            }
        });
        
        $('form').on('submit', function(e) {
            if(!transcriptValid || !registrationValid){
                e.preventDefault(); // stop form submission
                alert('Please fix the errors before submitting the form.');
            }
        });

    });

    </script>
@endsection


