<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Major extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='id';
    protected $table='major';
    protected $fillable = [
        'faculty_id',
        'name',
    ];

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function student(){
       return  $this->hasMany(Student::class);
    }
}
