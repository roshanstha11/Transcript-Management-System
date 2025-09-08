@extends('layouts.app')
@section('title', 'Transcript Records')
@section('content')
<div class='table-header-container' >
    <h2>Transcript Records</h2>
    <!-- Add New Data Button -->
    <a href="/create-form" class="btn btn-primary">+ Add New</a>
</div>

<table class="transcript-table">
    <thead>
        <tr>
            <th>S No</th>
            <th>Programme</th>
            <th>Transcript No</th>
            <th>Regd. No</th>
            <th>Student Name</th>
            <th>CGPA</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($formSubmissions as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->programme_name }}</td>
            <td>{{ $data->transcript_number }}</td>
            <td>{{ $data->registration_number }}</td>
            <td>{{ $data->student_name }}</td>
            <td>{{ $data->result }}</td>
            <td>
                <!-- Edit Button -->
                <a href="/edit-form/{{$data->id}}" class="btn btn-warning btn-sm">Edit</a>
                
                <!-- Delete Button -->
                <form action="/delete-form/{{$data->id}}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection