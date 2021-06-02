<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form class="form-signin" wire:submit.prevent="addPost" name="addPost">
                <div class="text-center mb-4">
                    <img class="mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Laravel Liviwere Posts</h1>
                    <p>Just a new posts page</p>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Title" autofocus name="title" wire:model="title">
                    @error('title')
                        <span class="text-danger text-xl-center">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <textarea class="form-control" rows="5" name="body" wire:model="body"></textarea>
                </div>
                @error('body')
                <span class="text-danger text-xl-center">
                            {{ $message }}
                        </span>
                @enderror

                <button class="btn btn-lg btn-primary btn-block" type="submit" name="addPost">Create</button>
            </form>
        </div>

        <div class="col-md-6">
            <div>
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
            </div>

            <h3>Posts list</h3>

            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><h3><small>Title: {{ $post->title }}</small>
                                    <i class="float-right" wire:click="removePost({{$post->id}})"  >
                                        <button class="btn btn-sm btn-danger">X</button>
                                    </i>
                                </h3>
                            </div>
                            <label>Date:</label> {{ $post->created_at->diffForHumans() }} <br>
                            <label>Comment:</label> {{ $post->body }} <br>
                        </div>
                    </div> <br>
                @endforeach
                {{ $posts->links() }}
            @else
                <div class="alert alert-info">
                    There is no post to see
                </div>
            @endif


        </div>
    </div>
</div>
