@extends('layouts.app')
@section('title', 'Transcript Records')
@section('content')
<div class='table-header-container' >
    {{-- Right Side Text --}}
    <h2 style="color: #0d6efd">Transcript Records</h2>
    {{-- Left Side Buttons --}}
    <!-- Button to trigger the modal -->
    <div class="table-header-buttons">
        @auth
        @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
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
<div class="container" style="max-width: 60%;">
    <input type="text" class="form-control" id="searchInput" placeholder="Type to search...">
</div>


<table class="transcript-table" id="transcriptTable" style="margin-top: 0%">
    <thead>
        <tr>
            <th>S No</th>
            <th>Programme</th>
            <th>Transcript No</th>
            <th>Regd. No</th>
            <th>Student Name</th>
            <th>CGPA</th>
            <th>Issued Date</th>
            @auth
            @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
            <th>Actions</th>
            @endif
            @endauth
        
        </tr>
    </thead>
    <tbody>
        @foreach($formSubmissions as $form)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $form->programme_name }}</td>
            <td>
                @if (!$form->transcript)
                    @if (Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
                        <form method="POST" action="{{ route('generate.transcript', $form->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Generate Transcript</button>
                        </form>
                    @else
                    <span>Transcript number not generated</span>
                    @endif
                @else
                <span>{{ $form->transcript->transcript_number }}</span>
                @endif
            </td>
            <td>{{ $form->registration_number }}</td>
            <td>{{ $form->student_name }}</td>
            <td>{{ $form->result }}</td>
            @if ($form->transcript)
            <td>{{ \Carbon\Carbon::parse($form->transcript->updated_date)->format('Y-M-d') }}</td>
            @else
            <td>Transcript number not generated</td>
            @endif
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
@section('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#transcriptTable tbody tr');

    rows.forEach(row => {

        const programme = row.cells[1].textContent.toLowerCase();
        const transcript = row.cells[2].textContent.toLowerCase();
        const regNo = row.cells[3].textContent.toLowerCase();
        const name = row.cells[4].textContent.toLowerCase();

        const match = name.includes(searchValue) || regNo.includes(searchValue) || transcript.includes(searchValue) || programme.includes(searchValue);

        row.style.display = match ? '' : 'none';

    });
});
</script>
@endsection