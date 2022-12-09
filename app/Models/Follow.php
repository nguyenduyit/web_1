<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Follow extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table="follow";
    protected $primaryKey="id";
    protected $fillable =[
        'student_id',
        'student_id_follow',
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function student_follow(){
        return $this->belongsTo(Student::class,'student_id_follow');
    }
}
