<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Faculty extends Model
{
    use HasFactory;
    protected $primary_key="id";
    protected $table="faculty";

    protected $fillable=[
        'name_faculty',
    ];
     
    public function major(){
        return $this->hasMany(Major::class);
    }

    public function student(){
        $this->hasMany(Student::class);
    }
}
