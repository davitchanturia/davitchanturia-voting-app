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
    public $filter;

    // queryString ცვლადი უზრუნველყოფს რომ ბრაუზერის url ში თვალსაჩინო იყოს შესრულებული ყველა query
    protected $queryString = [
        'status',
        'category',
        'filter'
    ];

    public function mount()
    {
        $this->status = request()->status ?? 'All';
        $this->category = request()->category ?? 'All Categories';
    }

    protected $listeners = ['queryStringUpdatedStatus'];  //statusFIlters-ში შექმნილ ივენთს ვარეგისტრირებთ აქ

    // when category is changed user has to be redirected to first page
    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingFIlter()
    {
        $this->resetPage();
    }

    public function updatedFilter()
    {
        if ($this->filter === 'My Ideas') {
            if (! auth()->check()) {
                return redirect()->route('login');
            }
        }
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
                ->when($this->status && $this->status != 'All', function ($query) use ($statuses) {  // filters ideas by certain status
                    return $query->where('status_id', $statuses->get($this->status));
                })
                ->when($this->category && $this->category != 'All Categories', function ($query) use ($categories) {
                    return $query->where('category_id', $categories->pluck('id', 'name')->get($this->category));  //filters by sertain category
                })
                ->when($this->filter && $this->filter === 'Top Voted', function ($query) {   // filters ideas by votes count
                    return $query->orderByDesc('votes_count');
                })
                ->when($this->filter && $this->filter === 'My Ideas', function ($query) {  // filtrs by logged in user's ideas
                    return $query->where('user_id', auth()->id());
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
