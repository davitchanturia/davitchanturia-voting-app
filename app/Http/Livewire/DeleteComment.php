<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class DeleteComment extends Component
{
    public Comment $comment;

    protected $listeners = ['setDeleteComment'];

    public function setDeleteComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('deleteCommentWasSet');
    }

    public function deleteComment()
    {
        //authorization
        if (auth()->guest() || auth()->user()->cannot('delete', $this->comment)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        Comment::destroy($this->comment->id);

        $this->emit('commentWasDeleted', 'Comment was deleted!');

    }

    public function render()
    {
        return view('livewire.delete-comment');
    }
}