<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use App\Models\Category;
use App\Models\Status;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $statuses = Status::all()->pluck('id', 'name');

        return view('livewire.ideas-index', [
            'ideas' => Idea::with('user', 'category', 'status')
                ->when(request()->status && request()->status != 'All', function ($query) use ($statuses) {
                    return $query->where('status_id', $statuses->get(request()->status));
                })
                ->addSelect(['voted_by_user' => Vote::select('id')
                    ->where('user_id', auth()->id())
                    ->whereColumn('idea_id', 'ideas.id')
                ])
                ->withCount('votes')
                ->orderBy('id', 'desc')  //sort by latest ideas
                ->simplePaginate(Idea::PAGINATION_COUNT),  //paginate idea page
            'categories' => Category::all(),
            
        ]);
    }
}