<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkCommentAsSpam extends Component
{
    public $comment;

    protected $listeners = ['setMarkAsSpamComment'];

    public function setMarkAsSpamComment($commentid)
    {
        $this->comment = Comment::findOrFail($commentid);

        $this->emit('MarkAsSpamCommentWasSet');
    }

    public function markAsSpam()
    {
        // authorization
        if (auth()->guest() || auth()->user()->cannot('delete', $this->comment)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->comment->spam_reports++;
        $this->comment->save();

        $this->emit('commentWasMarkedAsSpam', 'Comment was marked as spam!');
    }

    public function render()
    {
        return view('livewire.mark-comment-as-spam');
    }
}
