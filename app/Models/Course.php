<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Course extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='course';
    protected $fillable = [
        'sokhoa',
    ];

    public function student(){
        $this->hasMany(Student::class);
    }
}
