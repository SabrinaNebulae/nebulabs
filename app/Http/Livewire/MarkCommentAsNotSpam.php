<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkCommentAsNotSpam extends Component
{
    public Comment $comment;

    protected $listeners = ['setMarkAsNotSpamComment'];

    public function setMarkAsNotSpamComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('MarkAsNotSpamCommentWasSet');
    }

    public function markCommentAsNotSpam()
    {
        // Authorization (policies)
        if (auth()->guest() || !auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->comment->spam_reports = 0;
        $this->comment->save();

        $this->emit('commentWasMarkedAsNotSpam', 'Spam counter was reset for this comment!');
    }

    public function render()
    {
        return view('livewire.mark-comment-as-not-spam');
    }
}
