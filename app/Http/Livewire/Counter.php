<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;

    public function increment($value)
    {
        $this->count++;
        flash()->addSuccess('Count incremented '. $value);
    }

    public function decrement()
    {
        $this->count--;
        flash()->addSuccess('Count decremented');
    }
    public function render()
    {
        return view('livewire.counter');
    }
}
