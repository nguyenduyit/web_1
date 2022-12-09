<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\Student;

class Ward extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='ward';
    protected $primaryKey='id';
    protected $fillable= [
        'district_id',
        'name',
    ];

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function student(){
        return $this->hasMany(Student::class);
    }
}
