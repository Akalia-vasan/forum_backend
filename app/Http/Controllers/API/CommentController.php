<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentUpdateRequest;
use App\Repositories\Admin\Post\PostApprovalRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Http\Responses\ViewResponse;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\Comment;
class CommentController extends Controller
{
    public function reply(CommentUpdateRequest $request)
    {
        $comment = (new Comment())->create([
            'content' => $request->content,
            'author_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id
        ]);
        
        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

    public function comment(CommentUpdateRequest $request)
    {
        $comment = (new Comment())->create([
            'content' => $request->content,
            'author_id' => auth()->user()->id,
            'post_id' => $request->post_id
        ]);
        
        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

    public function view()
    {
        $now = carbon()->now();
        return Comment::where('parent_id', request()->input('parent'))->get()
            ->each(function ($obj) use ($now) {
                $obj->child = Comment::where('parent_id', $obj->id)->count();
                $obj->ago = $obj->created_at->diffForHumans($now);
                $obj->user = $obj->user->name;
            });
    }

    public function updateComment(CommentUpdateRequest $request)
    {
        $commentId = $request->input('commentId');
        $commentValue = $request->input('commentValue');
        $comment = Comment::where('id', $commentId)->first();
        $comment->content = $commentValue;
        $comment->save();
        
        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

    public function destroy(PostRequest $request)
    {
        $commentId = $request->input('commentId');
        Comment::where('parent_id', $commentId)->delete();
        Comment::where('id', $commentId)->delete();

        
        return response()->json([
            'success' => true
        ]);
    }
}
