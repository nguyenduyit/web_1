<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $primary_key='id';
    protected $table='blacklist';
    protected $fillable = [
        'student_id',
        'count'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
