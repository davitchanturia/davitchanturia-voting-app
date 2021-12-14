<?php

namespace Tests\Feature\Filters;

use App\Http\Livewire\StatusFilters;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class StatusFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_contains_status_filter_livewire_component()
    {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);

        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'description for first idea'
        ]);

        $this->get(route('idea.index'))
            ->assertSeeLivewire('status-filters');
    }

    public function test_show_page_contains_status_filter_livewire_component()
    {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);

        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'description for first idea'
        ]);

        $this->get(route('idea.show', [$idea]))
            ->assertSeeLivewire('status-filters');
    }


    public function test_shows_correct_status_count()
    {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);

        $statusImplemented =  Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'description for first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'description for first idea'
        ]);

        Livewire::test(StatusFilters::class)
            ->assertSee('All Ideas (2)')
            ->assertSee('Implemented (2)');
    }

    public function test_filtering_works_when_query_string_in_place()
    {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);

        $statusOpen = Status::factory()->create(['name' => 'open']);
        $statusConsidering = Status::factory()->create(['name' => 'considering']);
        $statusInProgress = Status::factory()->create(['name' => 'In Progress']);
        $statusImplemented =  Status::factory()->create(['name' => 'Implemented']);
        $statusClosed =  Status::factory()->create(['name' => 'Closed']);

        //considering
        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'description' => 'description for first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'description' => 'description for first idea'
        ]);

        //in Progress
        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
            'description' => 'description for first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
            'description' => 'description for first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
            'description' => 'description for first idea'
        ]);

        $response = $this->get(route('idea.index'));
        $response->assertSuccessful();
        
        Livewire::withQueryParams(['status' => 'considering'])
            ->test(StatusFilters::class)
            ->assertSee('All Ideas (5)')
            ->assertSet('status', 'considering');
    }

    public function test_show_page_does_not_show_selected_status()
    {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);

        $statusImplemented =  Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'description for first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'description for first idea'
        ]);

        $response = $this->get(route('idea.show', $idea));
        $response->assertDontSee('border-blue text-gray-900', false);
    }

    public function test_index_page_shows_selected_status()
    {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);

        $statusImplemented =  Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'description for first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'description for first idea'
        ]);

        $response = $this->get(route('idea.index'));
        $response->assertSee('border-blue text-gray-900', false);
    }
}
