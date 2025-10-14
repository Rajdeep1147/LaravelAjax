<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('results')->get();
        return view('student', compact('students'));
    }

    public function add()
    {
        return view('student-add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'phone' => 'required|string|max:15',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $filename, 'public'); // ✅ store in public disk
            $data['image'] = $filePath;
        }

        $student = DB::table('students')->insert($data);
        if($student) {
            // Student created successfully
            return redirect()->route('add.student')->with('success', 'Student added successfully.');
        }

    }
}
