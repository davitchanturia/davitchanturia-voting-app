<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $votesCount;

    public function mount(Idea $idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
    }
 
    public function render()
    {
        return view('livewire.idea-show');
    }
}
// @foreach ($ideas as $idea)
// <livewire:idea-index 
//     :idea="$idea" :votesCount="$idea->votes_count" 
// />
// @endforeach