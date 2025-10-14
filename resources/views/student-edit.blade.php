<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 500;
        }
        .student-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        .btn-primary {
            background: linear-gradient(90deg, #4e73df, #224abe);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #224abe, #4e73df);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="card-title text-center mb-4">Edit Student</h3>

                <!-- Success/Error Messages -->
                <div id="responseMessage">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>


                <form id="editStudentForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ old('name', $student->name) }}"
                            required
                        >
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="{{ old('email', $student->email) }}"
                            required
                        >
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            class="form-control"
                            value="{{ old('phone', $student->phone) }}"
                            required
                        >
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <label for="image" class="form-label">Profile Image</label><br>
                        @if($student->image)
                            <img src="{{ asset('storage/' . $student->image) }}" alt="Student Image" class="student-img">
                        @endif
                        <input type="file" name="image" id="image" class="form-control mt-2">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#editStudentForm").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);

        formData.append('_method', 'PUT'); // Tell Laravel to treat this as PUT

        $.ajax({
            url: "{{ route('update.student', $student->id) }}",
            type: "POST", // Laravel PUT/PATCH must be POST with _method
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                $("#responseMessage").html('<div class="alert alert-success">Student updated successfully!</div>');

                // Update the displayed image if a new one was uploaded
                if (response.image) {
                    $('.student-img').attr('src', response.image);
                }
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<div class="alert alert-danger"><ul>';
                $.each(errors, function(key, value){
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul></div>';
                $("#responseMessage").html(errorHtml);
            },
            beforeSend: function(){
                $("button[type='submit']").prop('disabled', true).text('Updating...');
            },
            complete: function(){
                $("button[type='submit']").prop('disabled', false).text('Update Student');
            }
        });
        });
});
</script>

</body>
</html>
