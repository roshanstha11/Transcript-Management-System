<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Transcripts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .transcript-table {
            width: 60%;
            margin: 40px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            border-radius: 12px;
            overflow: hidden;
        }
        .transcript-table th, .transcript-table td {
            padding: 16px 20px;
            text-align: left;
        }
        .transcript-table th {
            background: #3f51b5;
            color: #fff;
            font-size: 1.1em;
            letter-spacing: 1px;
        }
        .transcript-table tr:nth-child(even) {
            background: #f0f2fa;
        }
        .transcript-table tr:hover {
            background: #e3e7fa;
            transition: background 0.2s;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/kulogo.png') }}" alt="KU Logo" height="80">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h2 style="text-align:center; color:#3f51b5;">Student Transcripts</h2>
    <table class="transcript-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Transcript Number</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($students as $student) --}}
            <tr>
                <td></td>
                <td></td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</body>
</html>
