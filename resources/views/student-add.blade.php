<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add Student</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    /* Reset some defaults */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Roboto', sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #333;
    }

    .container {
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      max-width: 450px;
      width: 100%;
      text-align: center;
      animation: fadeIn 1s ease;
    }

    h1 {
      margin-bottom: 25px;
      font-weight: 700;
      color: #2575fc;
    }

    form label {
      display: block;
      text-align: left;
      margin: 12px 0 5px;
      font-weight: 500;
    }

    form input {
      width: 100%;
      padding: 10px 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
      transition: border-color 0.3s;
    }

    form input:focus {
      border-color: #2575fc;
      outline: none;
      box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
    }

    button {
      margin-top: 20px;
      padding: 12px 20px;
      background-color: #2575fc;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #1a5edb;
    }

    /* Responsive adjustments */
    @media (max-width: 500px) {
      .container {
        padding: 30px 20px;
      }
    }

    /* Fade-in animation */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
 <div class="container" style="
      max-width: 450px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      font-family: Arial, sans-serif;
  ">
  <h1 style="text-align:center; color:#2575fc; margin-bottom: 25px;">Add New Student</h1>

  @if($success = Session::get('success'))
    <div style="
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;">
        {{ $success }}
    </div>
  @endif

  <form id="add-student" enctype="multipart/form-data">
    @csrf

    <label for="name">Student Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter full name" required style="width:100%; padding:10px; margin-top:5px; border-radius:6px; border:1px solid #ccc;">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter email address" required style="width:100%; padding:10px; margin-top:5px; border-radius:6px; border:1px solid #ccc;">

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" placeholder="Enter phone number" required style="width:100%; padding:10px; margin-top:5px; border-radius:6px; border:1px solid #ccc;">

    <label for="image">Upload Image:</label>
    <input type="file" id="image" name="image" accept="image/*" style="width:100%; margin-top:5px;">

    <div id="preview-container" style="margin-top:10px; text-align:center; display:none;">
      <img id="image-preview" src="#" alt="Preview" style="max-width:120px; border-radius:8px; margin-top:10px;">
    </div>

    <button type="submit" id="submit-btn" style="
        margin-top:20px; width:100%; padding:12px; background-color:#2575fc; color:#fff;
        border:none; border-radius:6px; font-size:16px; cursor:pointer; transition:background-color 0.3s;">
      Add Student
    </button>
  </form>
</div>

  <!-- jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
      // Attach event listener to the form
      $('#add-student').on('submit', function (e) {
          e.preventDefault();

          // Serialize form data
          let formData = new FormData(this);

          // AJAX call
          $.ajax({
              type: "POST",
              url: "{{ route('store.student') }}",
              data: formData,
              processData: false,
              contentType: false,
              beforeSend: function() {
                  // Optional: show loading spinner or disable button
                  $('#submit-btn').prop('disabled', true).text('Saving...');
              },
              success: function (response) {
                  // Show success message
                  $('<div/>', {
                      text: ' Student added successfully!',
                      css: {
                          background: '#d4edda',
                          color: '#155724',
                          padding: '10px',
                          borderRadius: '6px',
                          marginBottom: '15px',
                          border: '1px solid #c3e6cb',
                          fontWeight: '500'
                      }
                  }).insertBefore('#add-student');

                  // Reset the form
                  $('#add-student')[0].reset();
              },
              error: function (xhr) {
                  // Handle errors gracefully
                  alert('❌ Something went wrong: ' + xhr.responseText);
              },
              complete: function() {
                  // Re-enable button
                  $('#submit-btn').prop('disabled', false).text('Add Student');
              }
          });
      });
  });
</script>

</body>
</html>
