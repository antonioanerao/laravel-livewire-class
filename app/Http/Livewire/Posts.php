<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    public $title;
    public $body;

    public function addPost() {
        $data = request()->all();
        $data['serverMemo']['data']['user_id'] = 1;

        $this->validate([
            'title'=>'required|min:5',
            'body'=>'required|min:5'
        ]);

        try{
            \App\Models\Posts::create($data['serverMemo']['data']);
        }catch (\Exception $exception) {
            session()->flash('message', $exception->getMessage());
            return false;
        }

        $this->title = "";
        $this->body = "";
        session()->flash('message', "Your post has added successfully");
        return true;
    }

    public function updated($field) {
        $this->validateOnly($field, [
            'title'=>'required|min:5',
            'body'=>'required|min:5'
        ]);
    }

    public function removePost($postID) {
        \App\Models\Posts::destroy($postID);
        /*
         * This will refresh the comments and return a list of comments
         * without the removed comment
         */
        session()->flash('message', "Post deleted successfully");
    }

    public function render()
    {
        return view('livewire.posts', [
            'posts' => \App\Models\Posts::latest()->paginate(2)
        ]);
    }
}
