<?php

namespace Tests\Feature;

use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class editIdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_edit_idea_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('edit-idea');
    }

    public function test_edit_idea_form_validation_works()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', '')
            ->set('category', '')
            ->set('description', '')
            ->call('UpdateIdea')
            ->assertHasErrors(['title', 'category', 'description'])
            ->assertSee('The title field is required');
    }

    public function test_editing_an_idea_works_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', 'My Edited Idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'description for my updated idea')
            ->call('UpdateIdea')
            ->assertEmitted('ideaWasUpdated');
        $this->assertDatabaseHas('ideas', [
            'title' => 'My Edited Idea',
            'description' => 'description for my updated idea',
            'category_id' =>  $categoryTwo->id,
        ]);
    }

    public function test_editing_an_idea_does_not_work_when_user_has_not_authorization_because_another_user_created_idea()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
        ]);

        Livewire::actingAs($userB)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', 'My Edited Idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'description for my updated idea')
            ->call('UpdateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_editing_an_idea_does_not_work_when_user_has_not_authorization_because_idea_was_created_longer_than_an_hour_ago()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'created_at' => now()->subHours(2),
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', 'My Edited Idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'description for my updated idea')
            ->call('UpdateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_editing_an_idea_shows_on_menu_when_user_has_authorization()
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
            ->assertSee('Edit Idea');
    }

    public function test_editing_an_idea_does_not_shows_on_menu_when_user_has_not_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();
 
        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 4,
            ])
            ->assertDontSee('Edit Idea');
    }
}
