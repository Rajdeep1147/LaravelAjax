<style>
  body {
    font-family: "Inter", Arial, sans-serif;
    background: #f4f6fb;
    padding: 40px;
  }

  .container {
    max-width: 1200px;
    margin: auto;
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
  }

  h1 {
    text-align: center;
    color: #2d2d2d;
    font-weight: 600;
    margin-bottom: 30px;
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
  }

  th {
    background: #4f46e5;
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    padding: 14px 15px;
    font-size: 14px;
    border-radius: 8px;
  }

  td {
    background: #fff;
    padding: 14px 15px;
    vertical-align: middle;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
  }

  tr td:first-child {
    font-weight: 600;
    color: #4f46e5;
  }

  tr:hover td {
    background-color: #f0f4ff;
  }

  /* Avatar style */
  .student-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right: 10px;
    vertical-align: middle;
  }

  /* Marks list */
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
    color: #4f46e5;
    padding: 6px 10px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 13px;
  }

  /* Action Buttons */
  .action-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-right: 5px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .view-btn { background: #3b82f6; }
  .view-btn:hover { background: #2563eb; }

  .edit-btn { background: #f59e0b; }
  .edit-btn:hover { background: #d97706; }

  .delete-btn { background: #ef4444; }
  .delete-btn:hover { background: #dc2626; }

  .no-data {
    text-align: center;
    padding: 20px;
    color: #777;
    font-style: italic;
  }

  /* Responsive */
  @media (max-width: 768px) {
    table, thead, tbody, th, td, tr { display: block; }
    th { display: none; }
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
    .action-btn { margin-bottom: 5px; }
  }
</style>

<div class="container">
  <h1>Student Data</h1>
  <table id="studentTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Student</th>
        <th>Email</th>
        <th>Marks</th>
        <th>Phone</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($students as $student)
      <tr>
        <td data-label="#">{{ $student->id }}</td>
        <td data-label="Student Name">
          <img src="{{ $student->image ? asset('storage/'.$student->image) : 'https://via.placeholder.com/35' }}" class="student-avatar" alt="Avatar">
          {{ $student->name }}
        </td>
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
        <td data-label="Image" style="width:60px; height:60px; text-align:center; vertical-align:middle;">
            <img
                src="{{ asset('storage/' . $student->image) }}"
                alt="Student Image"
                style="width:50px; height:50px; object-fit:cover; border-radius:8px;"
            >
        </td>

        <td data-label="Actions">
          <a href="#">
            <button type="button" class="action-btn view-btn">View</button>
          </a>
          <a href="{{ route('edit.student', $student->id) }}">
            <button type="button" class="action-btn edit-btn">Edit</button>
          </a>
          <form action="#" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this student?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn delete-btn">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="no-data">No student data available</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
