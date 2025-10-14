<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    public $fillable = ['marks', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
