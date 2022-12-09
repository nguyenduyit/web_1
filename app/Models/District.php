<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ward;
use App\Models\Student;

class District extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='district';
    protected $primaryKey='id';
    protected $fillable= [
        'name',
    ];

    public function ward(){
        return $this->hasMany(Ward::class);
    }

    public function student(){
        return $this->hasMany(Student::class);
    }
}
