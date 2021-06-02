<div class="card">
    <div class="card-body">
        <img src="{{ $image }}" width="30%">

        <section>
            <input type="file" id="image" wire:change="$emit('fileChoosen')">
        </section>

        <hr>
        <form wire:submit.prevent="addComment" name="addComment">

            <div>
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
            </div>

            <label>Title</label>
            <input name="title" class="form-control" wire:model.lazy="newTitle">
            @error('newTitle')
            <span class="text-danger text-xl-center">
                    {{ $message }}
                </span>
            @enderror
            <hr>
            <label>New Comment</label>
            <textarea name="comment" class="form-control" wire:model.lazy="newComment"></textarea>
            @error('newComment')
            <span class="text-danger text-xl-center">
                    {{ $message }}
                </span>
            @enderror

            <hr>
            <button type="submit" name="addComment" class="btn btn-primary" >Add Comment</button>
        </form>
        <hr>

        <h3>Comments</h3>
        @foreach($comments as $comment)
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><h3><small>Title: {{ $comment->title }}</small>
                            <i class="float-right" wire:click="remove({{$comment->id}})">
                                <button class="btn btn-sm btn-danger">X</button>
                            </i>
                        </h3>
                    </div>
                    <label>Author:</label> {{ $comment->user->name }} <br>
                    <label>Date:</label> {{ $comment->created_at->diffForHumans() }} <br>
                    <label>Comment:</label> {{ $comment->body }} <br>
                    @if($comment->image)
                        <img src="storage/{{ $comment->image }}" width="30%">
                    @endif
                </div>
            </div> <br>
        @endforeach

        {{ $comments->links() }}

        <script>
            window.livewire.on('fileChoosen', () => {
                let inputField = document.getElementById('image')
                let file = inputField.files[0]
                let reader = new FileReader();

                reader.onloadend = () => {
                    window.livewire.emit('fileUpload', reader.result)
                }

                reader.readAsDataURL(file)
            });
        </script>
    </div>
</div>
