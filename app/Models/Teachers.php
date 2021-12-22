<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\User;
use Illuminate\Support\Facades\DB;

class Teachers extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function user(){
        return  $this->belongsTo(User::class, 'user_id','id');
    }
    public function subjects(){
        return DB::table('teacher_subjects')->join('subjects','subjects.id','teacher_subjects.subject_id')
            ->where('teacher_subjects.teacher_id', '=', $this->id)->select('*','teacher_subjects.id as ts_id','subjects.id as s_id')->get();
    }
}
