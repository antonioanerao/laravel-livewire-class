<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    /*
     * Loads all comments from database
     */
    //public $comments;
    public function mount() {
//        $initialComments = \App\Models\Comments::latest()->paginage(2);
//        $this->comments = $initialComments;
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

       // $this->comments->prepend($createComment);
        session()->flash('message', "Comment added successfully");

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
        //$this->comments = $this->comments->except($commentId);
        session()->flash('message', "Comment deleted successfully");
    }

    public function render()
    {
        return view('livewire.comments',
        [
            'comments' => \App\Models\Comments::latest()->paginate(2)
        ]);
    }
}
