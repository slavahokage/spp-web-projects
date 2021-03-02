<div class="content">

    <a href="{{ route('posts.show', [$post->slug]) }}">
        <h1 class="title">{{ $post->title }}</h1>
    </a>
    <p><b>Posted:</b> {{ $post->created_at->diffForHumans() }}</p>
    <p><b>Category:</b> {{ $post->category }}</p>
    <p>{!! nl2br(e($post->content)) !!}</p>

    <form method="post" action="{{ route('posts.destroy', $post) }}">
        @csrf
        @method('delete')
        <div class="field is-grouped">
            <div class="control">
                <a href="{{ route('posts.edit', $post) }}" class="button is-info is-outlined">
                    Edit
                </a>
            </div>
            <div class="control">
                <a href="{{ route('download', ['hash' => $post->filename_hash]) }}" class="button is-info is-outlined">
                    Download file
                </a>
            </div>
            <div class="control">
                <button type="submit" class="button is-danger is-outlined">Delete</button>
            </div>
        </div>
    </form>

</div>
