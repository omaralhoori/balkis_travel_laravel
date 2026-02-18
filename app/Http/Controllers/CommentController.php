<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(CommentRequest $request): RedirectResponse
    {
        Comment::create([
            'blog_post_id' => $request->blog_post_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'is_approved' => false,
        ]);

        return back()->with('comment_success', 'تم إرسال تعليقك بنجاح! سيتم مراجعته قبل النشر.');
    }
}
