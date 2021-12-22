<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static $running = 1;
    public  static $upcoming = 2;
    public  static $completed = 3;


    public function courses(){
        return DB::table('course_subjects')
        ->join('subjects','subjects.id','=','course_subjects.subject_id')
        ->where('course_subjects.course_id','=',$this->id)->get();
    }

    public function students(){
        return DB::table('student_courses')
        ->join('students','students.id', '=', 'student_courses.student_id')
        ->where('student_courses.course_id','=',$this->id)->get();
    }
}
