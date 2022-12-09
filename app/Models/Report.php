<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\student;
use App\Models\Post;

class Report extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table="report";
    protected $fillable = [
        'student_id',
        'post_id',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
