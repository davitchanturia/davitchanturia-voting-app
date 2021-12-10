<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use Illuminate\Http\Response;

class DeleteIdea extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function deleteIdea()
    {

        //authorization
        if (auth()->guest() || auth()->user()->cannot('delete', $this->idea)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        Vote::where('idea_id', $this->idea->id)->delete();  // ვშლით ყველა იმ ვოუთებს რომელიც იდეასთან არის დაკავშირებული
        Comment::where('idea_id', $this->idea->id)->delete();  // ვშლით ყველა იმ კომენტარებს რომელიც იდეასთან არის დაკავშირებული

        Idea::destroy($this->idea->id);  //და შემდეგ ვშლით იდეას

        // session flash message
        session()->flash('success_message', 'Idea was deleted succesfully!');

        return redirect(route('idea.index'));
    }

    public function render()
    {
        return view('livewire.delete-idea');
    }
}
