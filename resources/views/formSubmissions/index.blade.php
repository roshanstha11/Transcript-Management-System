@extends('layouts.app')
@section('title', 'Transcript Records')
@section('content')
<div class='table-header-container' >
    {{-- Right Side Text --}}
    <h2 style="color: #0d6efd">Transcript Records</h2>
    {{-- Left Side Buttons --}}
    <!-- Button to trigger the modal -->
    <div class="table-header-buttons">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
            Import Records
        </button>
        <!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Records</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('import-record') }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Choose CSV or XLSX file</label>
                                <input class="form-control" type="file" id="file" name="file" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <a href="{{ route('export-record') }}" class="btn btn-primary">Export Records</a>
        <!-- Add New Data Button -->
        <a href="/create-form" class="btn btn-primary">+ Add New</a>
    </div>
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