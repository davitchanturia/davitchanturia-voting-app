<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use Illuminate\Http\Response;

class DeleteIdea extends Component
{
    public $idea;

    // public $title;
    // public $category;
    // public $description;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        // $this->title = $idea->title;
        // $this->category = $idea->category_id;
        // $this->description = $idea->description;
    }

    public function deleteIdea()
    {

        //authorization
        if (auth()->guest() || auth()->user()->cannot('delete', $this->idea)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        Vote::where('idea_id', $this->idea->id)->delete();  // ვშლით ყველა იმ ვოუთებს რომელიც იდეასთან არის დაკავშირებული

        Idea::destroy($this->idea->id);  //და შემდეგ ვშლით იდეას

        return redirect(route('idea.index'));
    }

    public function render()
    {
        return view('livewire.delete-idea');
    }
}
