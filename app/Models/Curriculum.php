<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    public function home_works() {
        $this->hasMany(HomeWork::class);
    }

    public function attendances() {
        $this->hasMany(Attendance::class);
    }
}
