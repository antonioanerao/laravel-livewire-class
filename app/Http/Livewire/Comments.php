<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments = [
        [
            'body'=>'dsdsdsds',
            'created_at' => '24/10/1991',
        ]
    ];

    public $newComment;

    public function addComment() {
        if($this->newComment != '') {
            array_unshift($this->comments, [
                'body' => $this->newComment,
                'created_at' => Carbon::now()->diffForHumans(),
                'creator' => 'noone',
            ]);
        }

        $this->newComment = "";
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
