<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Student;

class ReplyComment extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $table='reply_comment';
    protected $primary_key='id';
    protected $fillable = [
        'content',
        'student_id',
        'post_id',
        'comment_id',
    ];

    public function comment(){
        return $this->belongsTo(Comment::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
