<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\Post;
use App\Models\District;
use App\Models\Ward;
use App\Models\Comment;
use App\Models\Confirm;
use App\Models\ReplyComment;
use App\Models\Rating;
use App\Models\Report;
use App\Models\Follow;
use App\Models\BlackList;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory;
    use Notifiable;
    public $timestamps=false;
    protected $table='student';
    protected $primary_key='id';
    protected $fillable= [
        'maso',
        'name',
        'password',
        'email',
        'image',
        'course_id',
        'faculty_id',
        'major_id',
        'phone',
        'district_id',
        'ward_id',
    ];

   public function course(){
      return  $this->belongsTo(Course::class);
   }

   public function faculty(){
      return $this->belongsTo(Faculty::class);
   }

   public function major(){
      return $this->belongsTo(Major::class);
   }

   public function post(){
      return $this->hasMany(Post::class);
   }

   public function district(){
      return $this->belongsTo(District::class);
   }
   public function ward(){
      return $this->belongsTo(Ward::class);
   }

   public function comment(){
      return $this->hasMany(Comment::class);
   }
   public function confirm(){
      return $this->hasMany(Confirm::class);
   }

   public function has_confirm(){
      return $this->hasMany(Confirm::class,'owner_id_post');
   }

   public function replycomment(){
      return $this->hasMany(ReplyComment::class);
   }

   public function rating(){
      return $this->hasMany(Rating::class,'student_id','id');
   }

   public function rated(){
      return $this->hasMany(Rating::class,'rated_student','id');
   }

   public function report(){
      return $this->hasMany(Report::class);
   }

   public function follow(){
      return $this->hasMany(Follow::class,'student_id','id');
   }

   public function has_follow(){
      return $this->hasMany(Follow::class,'student_id_follow','id');
   }
   public function blacklist(){
      return $this->belongsTo(BlackList::class,'student_id','id');
   }

}
