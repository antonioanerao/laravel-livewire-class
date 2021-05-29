<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{

    /*
     * Loads all comments from database
     */
    public $comments;
    public function mount() {
        $initialComments = \App\Models\Comments::latest()->get();
        $this->comments = $initialComments;
    }

    /*
     * Store new comments into database
     */
    public $newComment;
    public function addComment() {
        if($this->newComment == '') {
            return;
        }
        $createComment = \App\Models\Comments::create([
            'body' => $this->newComment,
            'user_id' => 1 /* hard coded user id */
        ]);

        $this->comments->prepend($createComment);

        /*
         * Cleans the last new comment
         */
        $this->newComment = "";
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
