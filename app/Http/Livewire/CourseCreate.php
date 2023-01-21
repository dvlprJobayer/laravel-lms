<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Curriculum;
use Carbon\Carbon;
use Livewire\Component;

class CourseCreate extends Component
{
    public $name;
    public $description;
    public $price;
    public $time;
    public $end_date;
    public $selected_days = [];

    public $days = [
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
    ];
    public function render()
    {
        return view('livewire.course-create');
    }

    public function addCourse () {
        $this->validate([
            'name' => 'required|unique:courses,name',
            'description' => 'required',
            'price' => 'required',
            'time' => 'required',
            'end_date' => 'required',
            'selected_days' => 'required|array|min:1',
        ]);

        $course = Course::create([
            'name' => $this->name,
            'slug' => str_replace(' ', '-', strtolower($this->name)),
            'description' => $this->description,
            'price' => $this->price,
            'end_date' => $this->end_date,
            'user_id' => auth()->user()->id
        ]);

        $i = 1;
        $start_date = new \DateTime(Carbon::now());
        $end_date = new \DateTime($this->end_date);
        $interval = new \DateInterval('P1D');
        $date_range = new \DatePeriod($start_date, $interval ,$end_date);
        foreach ($date_range as $date) {
            foreach ($this->selected_days as $day) {
                if($date->format('l') === $day) {
                    Curriculum::create([
                        'name' => $course->name . ' - Class ' . $i++,
                        'class_time' => $this->time,
                        'class_date' => $date,
                        'course_id' => $course->id,
                    ]);
                }
            }
        }

        $this->reset(['name', 'description', 'price', 'time', 'end_date', 'selected_days']);
        flash()->addSuccess('Course created successfully');
        return redirect()->to('/course');
    }
}
