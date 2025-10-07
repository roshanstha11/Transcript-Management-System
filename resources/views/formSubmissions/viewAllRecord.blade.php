@extends('layouts.app')
@section('title', 'Transcript Records')
@section('styles')
<style>
    body {
        background: #f8f9fa;
    }
    .table-container {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      padding: 20px;
    }
    .table thead {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
    }
    h1 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #211bce;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(37, 117, 252, 0.05);
    }
    .table-actions {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
    }
    .search-box {
        width: 300px;
    }
    </style>
@endsection
@section('content')
<div class="content">
    <div class="p-4">
        <div class="container">
            <div class="table-container">
                <!-- Top Actions -->
                <div class="d-flex align-items-center">
                    <div>
                        <h1>Transcript Records</h1>
                    </div>
                </div>
                <!-- Top Actions -->
                <div class="table-actions">
                    <div class="row mb-3 align-items-center">
                        {{-- Search Box --}}
                        <div class="col-12 col-md-6 mb-2 mb-md-0">
                            <div class="input-group search-box">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-secondary"></i>
                                </span>
                                <input id="searchInput" type="text" class="form-control border-start-0" placeholder="Search...">
                            </div>
                        </div>

                        {{-- Date Filter --}}
                        <div class="col-6 col-md-4 mb-2 mb-md-0">
                            <input type="date" id="filter_date" class="form-control">
                        </div>

                        {{-- Filter Button --}}
                        <div class="col-6 col-md-2 text-md-start">
                            <button id="filterBtn" class="btn btn-primary w-100">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>
                    </div>
                    {{-- Import Export Button --}}
                    <div>
                        @auth
                        @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
                        <!-- Button to trigger the Import Modal -->
                        <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="bi bi-download"></i> Import
                        </button>
                        <!-- Import Modal -->
                        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importModalLabel"><i class="bi bi-download"></i> Import File</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('import-record') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Choose CSV or XLSX file</label>
                                                <input class="form-control" type="file" id="file" name="file" accept=".csv, .xlsx" required>
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
                        <!-- End of the Import Modal -->
                        <a href="{{ route('export-record') }}" class="btn btn-success me-2"><i class="bi bi-upload"></i> Export</a>
                        @endif
                        @endauth
                        {{-- Add New Record Button --}}
                        <a href="{{ route('create-form') }}" class="btn btn-primary me-2"><i class="bi bi-plus-circle"></i> Add New</a>
                    </div>
                </div>
    
                <!-- Table -->
                <table class="table table-hover align-middle">
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
                    <tbody id="tableBody">
                        @foreach($formSubmissions as $form)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            {{-- <td>{{ $loop->iteration }}</td> --}}
                            <td>{{ $form->programme_name }}</td>
                            <td>@if (!$form->transcript)
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
                                @if((Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin') && !empty($form->transcript->transcript_number))
                                <!-- Edit Button -->
                                <a href="{{ route('edit-form',$form->id) }}" class="btn btn-sm btn-outline-info" title="Edit Record"><i class="bi bi-pencil"></i></a>
                                <!-- Delete Button -->
                                <form action="{{ route('delete-form',$form->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Record" onclick="return confirm('Are you sure you want to delete this student?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                                @endauth
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
// Simple search filter
document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableBody tr");
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
});

    $(document).ready(function() {
    // Load all records on page load
    fetchTranscripts();

    // Filter by date when button clicked
    $('#filterBtn').click(function() {
        let date = $('#filter_date').val();
        fetchTranscripts(date);
    });

    // AJAX function
    function fetchTranscripts(date = '') {
        $.ajax({
            url: "{{ route('transcript.filter') }}",
            type: "GET",
            data: { date: date },
            success: function(response) {
                $('#transcriptData').html('');
                if (response.length > 0) {
                    $.each(response, function(index, item) {
                        $('#transcriptData').append(`
                            <tr>
                                <td>${item.id}</td>
                                <td>${item.transcript_number}</td>
                                <td>${item.student_name}</td>
                                <td>${item.updated_date}</td>
                            </tr>
                        `);
                    });
                } else {
                    $('#transcriptData').html('<tr><td colspan="4" class="text-center">No records found</td></tr>');
                }
            }
        });
    }
});
</script>
@endsection






