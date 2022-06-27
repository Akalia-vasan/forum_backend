@extends('layouts.app')

@section('content')

<div class="container" id="comments">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-4">
                    <div class="d-flex flex-start">
                        <img class="rounded-circle shadow-1-strong me-3"
                            src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g" alt="avatar" width="60"
                            height="60" />
                        <div>
                            <h6 class="fw-bold mb-1">{{$post->user ? $post->user->name : 'Guest'}}</h6>
                            <div class="d-flex align-items-center mb-3">
                                <p class="mb-0">
                                {{$post->created_at ? date('jS \of F Y', strtotime($post->created_at)) : ''}}
                                <span class="badge bg-primary">{{ $post->flag }}</span>
                                </p>
                            </div>
                            <p class="mb-0">
                            {!! $post->content !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div id="comments" class="card-body ui segment">
                    <div class="ui comments threaded ">
                        <h3 class="ui dividing header">Questions</h3>
                        @if(!$comments->count())
                            No comments added. Be the first to add a comment.
                        @endif
                        @foreach($comments as $comment)
                            <div class="comment" data-id="{{ $comment->id }}">
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
                                        <a class="clickReply reply"><i class="icon reply"></i> Reply</a>
                                        {{-- validate if owner only --}}
                                        @if($comment->author_id == auth()->user()->id)
                                            <a class="clickEdit edit" data-id="{{ $comment->id }}"><i class="icon edit"></i> Edit</a>
                                            
                                            <a class="clickDelete delete" data-id="{{ $comment->id }}"><i class="icon remove"></i> Delete</a>
                                        @endif
                                        @if(\App\Models\Comment::where('parent_id', $comment->id)->count())
                                            <a class="viewMore reply">
                                                View Replies
                                                <span class="ui teal circular label">{{ \App\Models\Comment::where('parent_id', $comment->id)->count() }}</span>
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route('auth.comments.add') }}" class="ui reply form" method="post">
                        {!! csrf_field() !!}
                        <div class="field">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <textarea name="content" placeholder="Comment" class="form-control bg-white"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary submit icon button">
                            Add Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="formTemplate hidden">
    <div class="ui comments">
        <form action="{{ route('auth.post.reply') }}" class="ui reply form" method="post" style="background-color: #eceaea; padding: 10px;">
            {!! csrf_field() !!}
            <input type="hidden" name="parent_id">
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="field">
                <textarea name="content" placeholder="reply"  class="form-control bg-white"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm submit mini icon button">
                <i class="icon reply"></i> Reply
            </button>
        </form>
    </div>
</div>

{{-- form template panel to update comment --}}
<div class="updateFormTemplate hidden">
    <div class="ui comments">
        <form action="" class="ui edit form" method="post" style="background-color: #eceaea; padding: 10px;">
            {!! csrf_field() !!}
            <input type="hidden" name="comment_id">
            <div class="ui form clearfix">
                <div class="field">
                    <textarea name="content" rows="2" class="form-control bg-white"></textarea>
                    <p class="help-block-custom"></p>
                </div>
                <div class="field">
                    <div class="pull-left">
                        <button type="button" class="ui button mini editCancel">Cancel</button>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="ui button blue mini updateClick">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="commentHolderTemplate hidden">
    <div class="ui comments threaded">
    </div>
</div>

<div class="commentTemplate hidden">
    <div class="card-body comment" data-id="">
        <a class="avatar">
            <img src="">
        </a>
        <div class="content">
            <a class="author"></a>
            <div class="metadata">
                <span class="date"></span>
            </div>
            <div class="text comment-item"></div>
            <div class="actions">
                <a class="clickReply reply"><i class="icon reply"></i> Reply</a>
                <a class="clickEdit edit"><i class="icon edit"></i> Edit</a>
                <a class="clickDelete delete"><i class="icon remove"></i> Delete</a>
                <a class="viewMore reply">
                    View Replies
                    <span class="ui teal circular label">1</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
<script>
    var baseUrl = '';

    var replyClick = function () {
        console.log(11);
        $('.clickReply').on('click', function () {
            var reply = $(this);
            var commentHolder = reply.parent().parent().parent();
            var formTemplate = $('.formTemplate .ui.comments').clone();
            formTemplate.find('input[name="parent_id"]').val(commentHolder.data('id'));
            $('#comments').find('.comments form').parent().remove();
            commentHolder.append(formTemplate);
        });
    };
    replyClick();
    var model = $('input[name="model"]').val();
    var commentHolder = $('.commentHolderTemplate').find('.comments');
    var comment = $('.commentTemplate').find('.comment');
    var viewMoreClick = function () {
        $('.viewMore.reply').on('click', function() {
            var viewMore = $(this);
            viewMore.unbind("click");
            $.ajax({
                url: '{{ route('auth.comments.view') }}' + '?ajax=true&&parent=' + viewMore.parent().parent().parent().data('id'),
                method: 'GET',
            }).done(function(data) {
                var tempHolder = commentHolder.clone();
                console.log(data);
                $.each(data, function(i, block){
                    var commentBlock = comment.clone();
                    commentBlock.find('.avatar img').attr('src', 'https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g');
                    commentBlock.find('.content .author').text(block.user.name);
                    commentBlock.find('.content').attr('data-value', block.content);
                    commentBlock.find('.content .text').text(block.content);
                    commentBlock.find('.metadata .date').text(block.ago.replace('before', 'ago'));
                    commentBlock.attr('data-id', block.id);
                    commentBlock.find('.clickEdit').attr('data-id', block.id);
                    commentBlock.find('.clickDelete').attr('data-id', block.id);
                    if(block.child > 0){
                        commentBlock.find('.viewMore.reply .circular.label').text(block.child);
                    } else {
                        commentBlock.find('.viewMore.reply').remove();
                    }
                    tempHolder.append(commentBlock);
                });
                viewMore.parent().parent().parent().append(tempHolder);
                viewMore.remove();
                replyClick();
                viewMoreClick();
                editClick();
                deleteClick()
            });
        });
    };
    viewMoreClick();

    /* edit click function */
    var editClick = function () {
        $('.clickEdit').on('click', function () {

            var id = $(this).data('id');
            var commentHolder  = $('.comment[data-id="' + id + '"]');
            var commentItemHolder = commentHolder.find('.content');
            var commentItem = commentItemHolder.find('.comment-item');

            commentItem.hide();
            commentItemHolder.find('.comments').remove();
            var updateFormTemplate = $('.updateFormTemplate .ui.comments').clone();
            updateFormTemplate.find('form').attr('data-id', id);
            updateFormTemplate.find('input[name="comment_id"]').val(commentHolder.data('id'));
            updateFormTemplate.find('textarea').val(commentItemHolder.attr('data-value'));
            updateFormTemplate.find('.updateClick').attr('data-id', id);
            updateFormTemplate.find('.editCancel').attr('data-id', id);
            $('#comments').find('.comments form').parent().remove();
            commentItem.show();
            commentItemHolder.first().append(updateFormTemplate);
        });
    };
    editClick();

    /* update click function */
    var appendedComment = $('.comment');
    appendedComment.on('click', '.updateClick', function () {
        var id = $(this).data('id');
        var form = $('form[data-id="' + id + '"]');
        var commentId = form.find('input[name="comment_id"]').val();
        var commentValue = form.find('textarea').val();
        if (!commentValue) {
            form.find('textarea').addClass('error');
            form.find('.help-block-custom').text('The comment field is required.');
            return false;
        }
        $.ajax({
            method: "POST",
            url: "{{ route('auth.comments.update') }}" + '?ajax=true',
            data: {commentId: commentId, commentValue: commentValue, _token: "{{ csrf_token() }}"}
        }).done(function () {
            var comment = $('.comment[data-id="' + id + '"]');
            comment.find('.content').attr('data-value', commentValue);
            comment.find('.comment-item').first().text(commentValue);
            form.parent().fadeOut();
            swal({
                title: "Updated",
                text: "Comment is updated successfully.",
                type: "success"
            },function() {
                location.reload();
            });
        });
    });

    /* edit cancel function */
    var editCancel = function () {
        appendedComment.on('click', '.editCancel', function () {
            var id = $(this).data('id');
            var form = $('form[data-id="' + id + '"]');
            form.parent().fadeOut();
            form.find('.help-block-custom').text('');
        });
    };
    editCancel();

    /* delete click function */
    var deleteClick = function () {
        $('.clickDelete').on('click', function () {
            var commentId = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this comment..?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#F2711C",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('auth.comments.delete') }}" + '?ajax=true',
                        data: { commentId: commentId, _token: "{{ csrf_token() }}" }
                    }).done(function(){
                        swal({
                            title: "Deleted",
                            text: "Comment is deleted successfully.",
                            type: "success"
                        },function() {
                            location.reload();
                        });
                    });
                } else { }
            });
        });
    };
    deleteClick();

</script>
@endsection

