<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form wire:submit.prevent="addComment" name="addComment">
                <label>New Comment</label>
                <textarea required name="comment" class="form-control" wire:model.lazy="newComment"></textarea>
                <hr>
                <button type="submit" name="addComment" class="btn btn-primary" >Add Comment</button>
            </form>
            <hr>

            <h3>Comments</h3>
            @foreach($comments as $comment)
                <div class="card">
                    <div class="card-body">
                        <label>Author:</label> {{ $comment->user->name }} <br>
                        <label>Date:</label> {{ $comment->created_at->diffForHumans() }} <br>
                        <label>Comment:</label> {{ $comment->body }}
                    </div>
                </div> <br>
            @endforeach
        </div>
    </div>
</div>
