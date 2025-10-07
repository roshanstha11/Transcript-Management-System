@extends('layouts.app')

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
        width: 500px;
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
                        <h1>User Management</h1>
                    </div>
                </div>
                <!-- Top Actions -->
                <div class="table-actions">
                    {{-- Search Box --}}
                    <div class="col-12 col-md">
                        <div class="input-group search-box">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-secondary"></i>
                        </span>
                        <input id="searchInput" type="text" class="form-control border-start-0" placeholder="Search...">
                        </div>
                    </div>
                    <div>
                        {{-- Add New Record Button --}}
                        <a href="{{ route('users.create') }}" class="btn btn-primary me-2"><i class="bi bi-person-fill-add"></i> Register New User</a>
                    </div>
                </div>
    
                <!-- Table -->
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registered Date</th>
                            @auth
                            @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
                            <th>Actions</th>
                            @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach($users as $user)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_date)->format('Y-M-d') }}</td>
                            <td>
                                @auth
                                @if((Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin'))
                                <!-- Edit Button -->
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-info" title="Edit Record"><i class="bi bi-pencil"></i></a>
                                <!-- Delete Button -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
</script>
@endsection
