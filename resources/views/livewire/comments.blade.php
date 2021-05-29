<div>
    <label>New Comment</label>
    <textarea  name="comment" class="form-control" wire:model="newComment"></textarea>
    <hr>
    <button type="button" class="btn btn-primary" name="store" wire:click="addComment">Add Comment</button>

    <hr>

    <h3>Comments</h3>
    @foreach($comments as $comment)
        <div class="card">
            <div class="card-body">
                <label>Author</label> Nome <br>
                <label>Date</label> {{ $comment['created_at'] }} <br>
                <label>Comment:</label> {{ $comment['body'] }}
            </div>
        </div> <br>
    @endforeach
</div>
