<?php

namespace App\Http\Livewire;

use App\Models\SupportTicket;
use Livewire\Component;

class Tickets extends Component
{
    public $active = 1;
    protected $listeners = [
        'ticketSelected'
    ];

    public function ticketSelected($ticketID) {
        $this->active = $ticketID;
    }

    public function render()
    {
        return view('livewire.tickets', [
                'tickets' => SupportTicket::all(),
            ]
        );
    }
}
