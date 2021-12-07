<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\DeleteIdea;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteIdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_delete_idea_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('delete-idea');
    }


    public function test_deleting_an_idea_works_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        // $this->assertDatabaseMissing('ideas', [
        //     'id' => $idea->id,
        // ]);

        $this->assertEquals(0, Idea::count());
    }

    public function test_deleting_an_idea_works_when_user_is_admin()
    {
        $user = User::factory()->create([
            'email' => 'dato@redberry.ge'
        ]);

        $idea = Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        // $this->assertDatabaseMissing('ideas', [
        //     'id' => $idea->id,
        // ]);

        $this->assertEquals(0, Idea::count());
    }

    public function test_deleting_an_idea_with_votes_works_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        $this->assertEquals(0, Vote::count());
        $this->assertEquals(0, Idea::count());
    }

    public function test_deleting_an_idea_shows_on_menu_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 4,
            ])
            ->assertSee('Delete Idea');
    }

    public function test_deleting_an_idea_does_not_shows_on_menu_when_user_has_not_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();
 
        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 4,
            ])
            ->assertDontSee('Delete Idea');
    }
}
