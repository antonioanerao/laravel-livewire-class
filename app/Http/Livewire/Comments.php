<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $newComment;
    public $newTitle;
    public $image;
    public $ticketID = 1;
    protected $listeners = ['fileUpload'=>'handleFileUpload', 'ticketSelected'=>'ticketSelected'];

    public function handleFileUpload($imageData) {
        $this->image = $imageData;
    }

    public function ticketSelected($ticketID) {
        $this->ticketID = $ticketID;
    }

    public function storeImage() {
        if(!$this->image) {
            return null;
        }

        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = \Str::random(10).'.jpg';
        \Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function addComment() {
        /*
         * Validate if the comment is empty
         */
        $this->validate([
            'newComment'=>'required|max:10',
            'newTitle'=>'required'
        ]);

        /*
         * Handle the image upload
         */
        $image = $this->storeImage();

        /*
         * store the new comment
         */
        \App\Models\Comments::create([
            'body' => $this->newComment,
            'title'=>$this->newTitle,
            'image' => $image,
            'user_id' => 1, /* hard coded user id */
            'support_ticket_id' => $this->ticketID,
        ]);
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
        session()->flash('message', "Comment deleted successfully");
    }

    public function render()
    {
        return view('livewire.comments',
        [
            'comments' => \App\Models\Comments::where('support_ticket_id', $this->ticketID)->latest()->paginate(2)
        ]);
    }
}
