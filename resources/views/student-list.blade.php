<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f0f4f8);
            margin: 0;
            padding: 20px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            background: linear-gradient(90deg, #6366f1, #4f46e5);
            color: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        .page-header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .add-student-btn {
            background: white;
            color: #4f46e5;
            padding: 12px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .add-student-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: #4f46e5;
        }

        .students-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .student-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .student-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #e0e7ff;
        }

        .student-card h3 {
            margin: 10px 0;
            font-size: 1.3rem;
            color: #1e293b;
            font-weight: 600;
        }

        .student-card p {
            margin: 5px 0;
            color: #64748b;
            font-size: 0.95rem;
        }

        .marks-badge {
            display: inline-block;
            background: #e0e7ff;
            color: #4f46e5;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            margin: 2px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .actions a, .actions button {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .view-btn {
            background: #3b82f6;
            color: white;
        }

        .view-btn:hover {
            background: #2563eb;
            color: white;
        }

        .edit-btn {
            background: #f59e0b;
            color: white;
        }

        .edit-btn:hover {
            background: #d97706;
            color: white;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .delete-btn:hover {
            background: #dc2626;
        }

        .loading {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
            color: #64748b;
        }

        .no-students {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .no-students h3 {
            color: #64748b;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .students-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Students Management</h1>
            <a href="{{ route('add.student') }}" class="add-student-btn">+ Add New Student</a>
        </div>

        <div id="loadingMessage" class="loading">Loading students...</div>
        <div id="studentsContainer" class="students-grid" style="display: none;"></div>
        <div id="noStudentsMessage" class="no-students" style="display: none;">
            <h3>No students found</h3>
            <p>Start by adding your first student!</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            loadStudents();

            function loadStudents() {
                $.ajax({
                    url: "{{ route('students.list') }}",
                    type: "GET",
                    success: function(response) {
                        $('#loadingMessage').hide();

                        if (response.success && response.students.length > 0) {
                            $('#studentsContainer').show();
                            displayStudents(response.students);
                        } else {
                            $('#noStudentsMessage').show();
                        }
                    },
                    error: function(xhr) {
                        $('#loadingMessage').html('<p class="text-danger">Error loading students. Please refresh the page.</p>');
                    }
                });
            }

            function displayStudents(students) {
                let html = '';

                students.forEach(function(student) {
                    let imageSrc = student.image
                        ? "{{ asset('storage/') }}/" + student.image
                        : 'https://via.placeholder.com/80';

                    let marksHtml = '';
                    if (student.results && student.results.length > 0) {
                        student.results.forEach(function(result) {
                            marksHtml += `<span class="marks-badge">${result.marks}</span>`;
                        });
                    } else {
                        marksHtml = '<span class="marks-badge">No marks</span>';
                    }

                    html += `
                        <div class="student-card">
                            <img src="${imageSrc}" alt="${student.name}">
                            <h3>${student.name}</h3>
                            <p><strong>Email:</strong> ${student.email}</p>
                            <p><strong>Phone:</strong> ${student.phone || 'N/A'}</p>
                            <p><strong>Marks:</strong></p>
                            <div>${marksHtml}</div>
                            <div class="actions">
                                <a href="/student/${student.id}" class="view-btn">View</a>
                                <a href="/edit-student/${student.id}" class="edit-btn">Edit</a>
                                <button onclick="deleteStudent(${student.id})" class="delete-btn">Delete</button>
                            </div>
                        </div>
                    `;
                });

                $('#studentsContainer').html(html);
            }

            // Delete student function
            window.deleteStudent = function(id) {
                if (confirm('Are you sure you want to delete this student?')) {
                    $.ajax({
                        url: `/students/${id}`,
                        type: "POST",
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Student deleted successfully!');
                            loadStudents(); // Reload the list
                        },
                        error: function(xhr) {
                            alert('Error deleting student. Please try again.');
                        }
                    });
                }
            };
        });
    </script>
</body>
</html>

