<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Post;

class Confirm extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $table='confirm';

    protected $fillable = [
        'student_id_confirm',
        'post_id_confirm',
        'owner_id_post',
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id_confirm','id');
    }

    public function owner_post(){
        return $this->belongsTo(Student::class,'owner_id_post');
    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id_confirm');
    }
}
