<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Query Builder – Student Data</title>
  <style>
    body {
      font-family: "Inter", Arial, sans-serif;
      background: #f4f6fb;
      margin: 0;
      padding: 40px;
    }

    .container {
      max-width: 1100px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 25px;
      color: #2d2d2d;
      font-weight: 600;
    }

    .search-box {
      text-align: right;
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 10px 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      width: 280px;
      transition: 0.3s;
    }

    input[type="text"]:focus {
      outline: none;
      border-color: #4f46e5;
      box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 14px 16px;
      border-bottom: 1px solid #eee;
      vertical-align: top;
    }

    th {
      background: #4f46e5;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 0.03em;
      font-size: 13px;
    }

    tr:hover {
      background: #f9f9ff;
    }

    .marks-list {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .marks-list li {
      background: #eef2ff;
      color: #4f46e5;
      padding: 6px 10px;
      margin: 4px 0;
      display: inline-block;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    .no-data {
      text-align: center;
      color: #777;
      padding: 20px;
    }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      th {
        display: none;
      }
      td {
        padding: 12px;
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
      }
      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
        color: #4f46e5;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Student Data</h1>

    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Search by name or email..." />
    </div>

    <table id="studentTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Student Name</th>
          <th>Email</th>
          <th>Marks</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($students as $student)
        <tr>
          <td data-label="#">{{ $student->id }}</td>
          <td data-label="Student Name">{{ $student->name }}</td>
          <td data-label="Email">{{ $student->email }}</td>
          <td data-label="Marks">
            @if ($student->results->isNotEmpty())
              <ul class="marks-list">
                @foreach ($student->results as $result)
                  <li>{{ $result->marks }}</li>
                @endforeach
              </ul>
            @else
              <span style="color: #888;">N/A</span>
            @endif
          </td>
          <td data-label="Phone">{{ $student->phone }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="no-data">No student data available</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <script>
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll("#studentTable tbody tr");

    searchInput.addEventListener("keyup", function() {
      const query = this.value.toLowerCase();
      tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? "" : "none";
      });
    });
  </script>
</body>
</html>
