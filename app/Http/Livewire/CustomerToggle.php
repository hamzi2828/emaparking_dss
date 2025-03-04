<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CustomerToggle extends Component
{
    protected $listeners = ['toggle' => 'toggle'];
    public $agent = true;

    public function toggle() {
        $this->agent = !$this->agent;
    }

    public function render()
    {
        return view('livewire.customer-toggle');
    }
}
