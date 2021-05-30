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
    public $newTitle;
    public function addComment() {
        /*
         * Validate if the comment is empty
         */
        $this->validate([
            'newComment'=>'required|max:10',
            'newTitle'=>'required'
        ]);

        /*
         * store the new comment
         */
        $createComment = \App\Models\Comments::create([
            'body' => $this->newComment,
            'title'=>$this->newTitle,
            'user_id' => 1 /* hard coded user id */
        ]);

        $this->comments->prepend($createComment);

        /*
         * Cleans the last new comment and newTitle
         */
        $this->newComment = "";
        $this->newTitle = "";
    }

    /*
     * Validates in real time. If I fill some field and then clear then up the validates is going to
     *  send the error to the view
     */

    public function updated($field) {
        $this->validateOnly($field, [
            'newComment'=>'required|max:10',
            'newTitle'=>'required'
        ]);
    }

    /*
     * Remove the comment by ID
     */
    public function remove($commentId) {
        \App\Models\Comments::destroy($commentId);
        /*
         * This will refresh the comments and return a list of comments
         * without the removed comment
         */
        $this->comments = $this->comments->except($commentId);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
