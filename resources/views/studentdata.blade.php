<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Records</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- jQuery for AJAX -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    body {
      font-family: 'Inter', Arial, sans-serif;
      background: linear-gradient(135deg, #eef2ff, #f8fafc);
      margin: 0;
      padding: 0;
      color: #1e293b;
    }

    .container {
      max-width: 1200px;
      margin: 50px auto;
      background: #fff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }

    h1 {
      text-align: center;
      font-size: 2rem;
      font-weight: 700;
      color: #1e3a8a;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
    }

    thead {
      background: #4f46e5;
      color: #fff;
    }

    th {
      text-transform: uppercase;
      font-weight: 600;
      padding: 14px;
      font-size: 14px;
      text-align: left;
    }

    td {
      background: #fff;
      padding: 14px 16px;
      font-size: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      transition: background 0.3s ease;
      vertical-align: middle;
    }

    tr:hover td {
      background: #f9fafc;
    }

    td:first-child {
      color: #4338ca;
      font-weight: 600;
    }

    .student-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
      vertical-align: middle;
      border: 2px solid #e0e7ff;
    }

    .marks-list {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      padding: 0;
      margin: 0;
      list-style: none;
    }

    .marks-list li {
      background: #eef2ff;
      color: #4338ca;
      padding: 6px 10px;
      border-radius: 6px;
      font-weight: 500;
      font-size: 13px;
    }

    .action-btn {
      padding: 7px 12px;
      border: none;
      border-radius: 8px;
      color: #fff;
      cursor: pointer;
      font-size: 13px;
      font-weight: 500;
      transition: all 0.3s ease;
      margin-right: 6px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .view-btn { background: #3b82f6; }
    .edit-btn { background: #f59e0b; }
    .delete-btn { background: #ef4444; }

    .view-btn:hover { background: #2563eb; }
    .edit-btn:hover { background: #d97706; }
    .delete-btn:hover { background: #dc2626; }

    #loader {
      text-align: center;
      padding: 25px;
      font-weight: 600;
      color: #4f46e5;
      font-size: 16px;
      display: none;
    }

    .no-data {
      text-align: center;
      padding: 20px;
      color: #64748b;
      font-style: italic;
    }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr { display: block; width: 100%; }
      th { display: none; }
      td {
        padding: 14px;
        border: none;
        position: relative;
      }
      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        top: 12px;
        font-weight: 600;
        color: #4338ca;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>🎓 Student Records</h1>

    <div id="loader">Loading students...</div>

    <table id="studentTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Student</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Marks</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script>
    $(document).ready(function () {
      $('#loader').show();

      $.ajax({
        url: "{{ route('students.list') }}", // Your route returning JSON
        type: "GET",
        dataType: "json",
        success: function (response) {
          $('#loader').hide();
          let students = response.students || [];

          if (students.length === 0) {
            $('#studentTable tbody').html(`
              <tr><td colspan="6" class="no-data">No student data found.</td></tr>
            `);
            return;
          }

          let rows = '';
          $.each(students, function (index, student) {
            let imagePath = student.image ? '/storage/' + student.image : 'https://via.placeholder.com/45';
            let marksHtml = student.results && student.results.length > 0
              ? '<ul class="marks-list">' + student.results.map(r => `<li>${r.marks}</li>`).join('') + '</ul>'
              : 'N/A';

            rows += `
              <tr>
                <td>${index + 1}</td>
                <td>
                  <img src="${imagePath}" alt="avatar" class="student-avatar">
                  ${student.name}
                </td>
                <td>${student.email}</td>
                <td>${student.phone ?? 'N/A'}</td>
                <td>${marksHtml}</td>
                <td>
                  <a href="/student/${id}"><button class="action-btn view-btn">View</button></a>
                  <a href="/students/${student.id}/edit"><button class="action-btn edit-btn">Edit</button></a>
                  <button class="action-btn delete-btn" onclick="deleteStudent(${student.id})">Delete</button>
                </td>
              </tr>
            `;
          });

          $('#studentTable tbody').html(rows);
        },
        error: function () {
          $('#loader').hide();
          $('#studentTable tbody').html(`
            <tr><td colspan="6" class="no-data">Failed to load data.</td></tr>
          `);
        }
      });
    });

    function deleteStudent(id) {
      if(confirm('Are you sure you want to delete this student?')) {
        // Add AJAX delete request here
        alert('Student ' + id + ' deleted (implement your AJAX call here)');
      }
    }
  </script>
</body>
</html>
