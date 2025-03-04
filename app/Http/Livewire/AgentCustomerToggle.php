<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\User\Models\User;

class AgentCustomerToggle extends Component
{
    protected $listeners = ['toggle' => 'toggle'];
    public $agent = true;
    public $users;

    public function mount() {
        $this->init();
    }
    public function init() {
        $this->users =  User::where('role_id',3)->where('booking_agent', $this->agent)->get();
    }

    public function toggle() {
        $this->agent = !$this->agent;
        $this->init();
    }



    public function render()
    {
        return view('livewire.agent-customer-toggle');
    }
}
