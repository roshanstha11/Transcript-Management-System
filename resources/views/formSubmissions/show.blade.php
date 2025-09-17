@extends('layouts.app')
@section('title', 'Transcript Records')
@section('content')
<div class='table-header-container' >
    {{-- Right Side Text --}}
    <h2 style="color: #0d6efd">Transcript Records</h2>
    {{-- Left Side Buttons --}}
    <!-- Button to trigger the modal -->
    @auth
    @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
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
        @endif
        @endauth
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
        @foreach($formSubmissions as $form)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $form->programme_name }}</td>
            <td>{{ $form->transcript_number }}</td>
            <td>{{ $form->registration_number }}</td>
            <td>{{ $form->student_name }}</td>
            <td>{{ $form->result }}</td>
            <td>
                @auth
                @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
                <!-- Edit Button -->
                <a href="{{ route('edit-form',$form->id) }}" class="btn btn-warning btn-sm">Edit</a>
                
                <!-- Delete Button -->
                <form action="{{ route('delete-form',$form->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">
                        Delete
                    </button>
                </form>
                @endif
                @endauth
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection