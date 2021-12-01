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

    public $status;
    public $category;

    protected $queryString = [
        'status',
        'category'
    ];

    public function mount()
    {
        $this->status = request()->status ?? 'All';
        $this->category = request()->category ?? 'All Categories';
    }

    protected $listeners = ['queryStringUpdatedStatus'];  //statusFIlters-ში შექმნილ ივენთს ვარეგისტრირებთ აქ

    // public function updatingStatus()
    // {
    //     $this->resetPage();
    // }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function queryStringUpdatedStatus($newStatus) //ივენთის საშუალებით გამოგზავნილ სტატუსს მნიშვნელობას ვანიჭებთ ამ კლასში სტატუს ცვლადს
    {
        $this->resetPage();
        $this->status = $newStatus;
    }

    public function render()
    {
        $statuses = Status::all()->pluck('id', 'name');
        $categories = Category::all();

        return view('livewire.ideas-index', [
            'ideas' => Idea::with('user', 'category', 'status')
                ->when($this->status && $this->status != 'All', function ($query) use ($statuses) {
                    return $query->where('status_id', $statuses->get($this->status));
                })
                ->when($this->category && $this->category != 'All Categories', function ($query) use ($categories) {
                    return $query->where('category_id', $categories->pluck('id', 'name')->get($this->category));
                })
                ->addSelect(['voted_by_user' => Vote::select('id')  // count user's votes on certain idea
                    ->where('user_id', auth()->id())
                    ->whereColumn('idea_id', 'ideas.id')
                ])
                ->withCount('votes')  //count total votes
                ->orderBy('id', 'desc')  //sort by latest ideas
                ->simplePaginate(Idea::PAGINATION_COUNT),  //paginate idea page
            'categories' => $categories,
            
        ]);
    }
}
