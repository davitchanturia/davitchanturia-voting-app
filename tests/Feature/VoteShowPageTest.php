<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use App\Models\Vote;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class VoteShowPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_page_contains_idea_show_livewire_component()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'category 2']);

        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'description for first idea'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-show');
    }

    public function test_show_page_correctly_receives_votes_count()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'category 2']);

        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'description for first idea'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $userB->id
        ]);

        $this->get(route('idea.show', $idea))
            ->assertViewHas('votesCount', 2);
    }

    public function test_votes_count_shows_correctly_on_show_page_livewire_component()
    {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'category 2']);

        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'description for first idea'
        ]);

        Livewire::test(IdeaShow::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->assertSet('votesCount', 5)
        ->assertSeeHtml('<div class="text-xl leading-snug"> 5 </div>')
        ->assertSeeHtml(' <div class="text-sm font-bold leading none"> 5 </div>');
    }
}
