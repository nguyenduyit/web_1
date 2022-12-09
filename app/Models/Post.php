<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Category;
use App\Models\Comment;
use App\Models\ReplyComment;
use App\Models\Confirm;
use App\Models\Report;

class Post extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $primary_key='id';
    protected $table='post';
    protected $fillable= [
        'title',
        'image',
        'price',
        'student_id',
        'category_id',
        'status',
        'time',
        'updated_at',
        'created_at',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function replycomment(){
        return $this->hasMany(ReplyComment::class);
    }

    public function confirm(){
        return $this->belongsTo(Confirm::class,'id','post_id_confirm');
    }

    public function report(){
        return $this->hasMany(Report::class);
    }

}
