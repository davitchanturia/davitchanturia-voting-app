<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkCommentAsNotSpam extends Component
{
    public $comment;

    protected $listeners = ['setMarkAsNotSpamComment'];

    public function setMarkAsNotSpamComment($commentid)
    {
        $this->comment = Comment::findOrFail($commentid);

        $this->emit('MarkAsNotSpamCommentWasSet');
    }

    public function markAsNotSpam()
    {
        //authorization
        //  if (auth()->guest() || auth()->user()->cannot('delete', $this->comment)) {
        //     abort(Response::HTTP_FORBIDDEN);
        // }

        $this->comment->spam_reports = 0;
        $this->comment->save();

        $this->emit('commentWasMarkedAsNotSpam', 'Comment was marked as not spam!');
    }

    public function render()
    {
        return view('livewire.mark-comment-as-not-spam');
    }
}
