<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
use App\Http\Livewire\IdeasIndex;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_contains_idea_index_livewire_component()
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

        $this->get(route('idea.index'))
            ->assertSeeLivewire('idea-index');
    }

    public function test_ideas_index_livewire_component_page_correctly_receives_votes_count()
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

        Livewire::test(IdeasIndex::class)
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->first()->votes_count == 2;
            });
    }

    public function test_votes_count_shows_correctly_on_index_page_livewire_component()
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

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->assertSet('votesCount', 5);
    }

    public function test_user_id_logged_in_shows_voted_if_idea_already_voted_for_in_index_page()
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

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        $response = $this->actingAs($user)->get(route('idea.index'));

        $ideaWithVotes = $response['ideas']->items()[0];

        Livewire::actingAs($user)
            ->test(IdeaIndex::class, [
                'idea' => $ideaWithVotes,
                'votesCount' => 5
            ])
        ->assertSet('hasVoted', true)
        ->assertSee('Voted');
    }

    public function test_user_who_is_not_logged_in_is_redirected_to_login_page_when_trying_to_vote_on_index_page()
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

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->call('vote')
        ->assertRedirect(route('login'));
    }

    public function test_user_who_is_logged_in_can_vote_for_idea_on_index_page()
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

        $this->assertDatabaseMissing('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($user)
            ->test(IdeaIndex::class, [
                'idea' => $idea,
                'votesCount' => 5
            ])
            ->call('vote')
            ->assertSet('votesCount', 6)
            ->assertSet('hasVoted', true)
            ->assertSee('Voted');

        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);
    }

    public function test_user_who_is_logged_in_can_remove_vote_for_idea_on_index_page()
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

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);

        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($user)
            ->test(IdeaIndex::class, [
                'idea' => $idea,
                'votesCount' => 1
            ])
            ->call('vote')
            ->assertSet('votesCount', 0)
            ->assertSet('hasVoted', false)
            ->assertSee('Vote');

        $this->assertDatabaseMissing('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);
    }
}
