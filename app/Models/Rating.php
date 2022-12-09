<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Rating extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='id';
    protected $table='rating';
    protected $fillable = [
        'student_id',
        'rated',
        'rated_student'
    ];

    public function student(){
       return $this->belongsTo(Student::class);
    }
    public function rated_student(){
       return $this->belongsTo(Student::class,'rated_student');
    }
}
