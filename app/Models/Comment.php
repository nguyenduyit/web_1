<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Post;
use App\Models\ReplyComment;


class Comment extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='comment';
    protected $primary_key='id';

    protected $fillable =[
        'content',
        'rating',
        'post_id',
        'student_id',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function replycomment(){
        return $this->hasMany(ReplyComment::class);
    }

}
