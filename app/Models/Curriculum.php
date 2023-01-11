<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';
    protected $fillable = [
        'name',
        'class_time',
        'class_date',
        'course_id'
    ];

    public function home_works() {
        return $this->hasMany(HomeWork::class);
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function notes() {
        return $this->hasMany(Note::class);
    }
}
