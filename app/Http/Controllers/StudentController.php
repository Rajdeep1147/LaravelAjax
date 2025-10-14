<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $filePath = $file->storeAs('images', $filename, 'public');
            $data['image'] = $filePath;
        }

        $student = DB::table('students')->insert($data);
        if($student) {
            // Student created successfully
            return redirect()->route('add.student')->with('success', 'Student added successfully.');
        }

    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('student-edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $filename, 'public');
            $data['image'] = $filePath;
        }

        $student->update($data);

        // Return JSON for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully!',
            'image' => isset($data['image']) ? asset('storage/' . $data['image']) : null
        ]);
    }

}
