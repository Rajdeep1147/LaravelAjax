<!-- resources/views/student/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->name }} - Student Details</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== Base Styles ===== */
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f0f4f8);
            margin: 0;
            padding: 0;
            color: #1e293b;
        }

        .container {
            max-width: 900px;
            margin: 60px auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: translateY(-5px);
        }

        /* ===== Header ===== */
        .header {
            background: linear-gradient(90deg, #6366f1, #4f46e5);
            color: #fff;
            padding: 30px 40px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.7);
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .header h2 {
            font-size: 2.2rem;
            margin: 0;
            font-weight: 700;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        /* ===== Content ===== */
        .content {
            padding: 30px 40px;
        }

        .info-group {
            margin-bottom: 25px;
        }

        .info-group p {
            margin: 8px 0;
            font-size: 16px;
        }
        .info-group p strong {
            color: #4f46e5;
        }

        /* ===== Marks ===== */
        .marks-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 0;
            list-style: none;
        }

        .marks-list li {
            background: #e0e7ff;
            color: #4f46e5;
            padding: 8px 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, background 0.3s ease;
        }
        .marks-list li:hover {
            background: #c7d2fe;
            transform: translateY(-2px);
        }

        /* ===== Action Buttons ===== */
        .actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .actions a, .actions form button {
            padding: 12px 20px;
            border-radius: 12px;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .back-btn { background: #3b82f6; }
        .back-btn:hover { background: #2563eb; }

        .edit-btn { background: #f59e0b; }
        .edit-btn:hover { background: #d97706; }

        .delete-btn { background: #ef4444; }
        .delete-btn:hover { background: #dc2626; }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                padding: 25px;
            }
            .header img {
                width: 100px;
                height: 100px;
            }
            .header h2 {
                font-size: 1.8rem;
            }
            .content {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ $student->image ? asset('storage/'.$student->image) : 'https://via.placeholder.com/120' }}" alt="{{ $student->name }}">
            <h2>{{ $student->name }}</h2>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="info-group">
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Phone:</strong> {{ $student->phone ?? 'N/A' }}</p>
            </div>

            <div class="info-group">
                <p><strong>Marks:</strong></p>
                @if($student->results && $student->results->count() > 0)
                    <ul class="marks-list">
                        @foreach($student->results as $result)
                            <li>{{ $result->marks }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>N/A</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="actions">
                <a href="{{ route('get-student') }}" class="back-btn">Back to List</a>
                <a href="{{ route('edit.student', $student->id) }}" class="edit-btn">Edit</a>
                <form action="{{ route('delete.student', $student->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
