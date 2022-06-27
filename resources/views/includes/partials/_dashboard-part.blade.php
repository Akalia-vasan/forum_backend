@if(count($posts) > 0)    
    @foreach($posts as $comment)
    <div class="comment card-body" data-id="{{ $comment->id }}">
        <a class="avatar">
            <img src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g">
        </a>
        <div class="content" data-value="{{ $comment->content }}">
            <a class="author">{{ $comment->user->name }}</a>
            <div class="metadata">
            <span class="date">
                @if($comment->created_at->diffInSeconds(carbon()->now()) < 40)
                    Just now
                @else
                    {{ carbon()->now()->sub($comment->created_at->diff(carbon()->now()))->diffForHumans() }}
                @endif
            </span>
            </div>

            <div class="text comment-item">
                {!! nl2br($comment->content) !!}
            </div>

            <div class="actions">
                <a class="btn btn-primary btn-sm viewMore reply" href="{{ route('auth.post.qa', $comment->id) }}">
                        Ask Questions - 
                        <span class="badge badge-light">{{ \App\Models\Comment::where('post_id', $comment->id)->where('parent_id', null)->count() }}</span>
                    </a>
            </div>

        </div>
    </div>
    @endforeach

@else
       <span style=" display: inline-block;width: 100%;text-align: left;font-size: 16px;margin-left:30px;">Data Not Found</span>     
@endif

{{$posts->links()}}