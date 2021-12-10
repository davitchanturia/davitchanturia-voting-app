<?php

namespace Tests\Feature\Comments;

use App\Http\Livewire\AddComment;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AddCommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_comment_livewire_component_renders()
    {
        $idea = Idea::factory()->create();

        $response = $this->get(route('idea.show', $idea));

        $response->assertSee('add-comment');
    }

    public function test_add_comment_form_renders_when_user_is_logged_in()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();

        $response = $this->actingAs($user)->get(route('idea.show', $idea));

        $response->assertSee('Post Comment');
    }

    public function test_add_comment_form_does_not_render_when_user_is_not_logged_in()
    {
        $idea = Idea::factory()->create();

        $response = $this->get(route('idea.show', $idea));

        $response->assertSee('Please login or create an account to post a comment.');
    }

    public function test_add_comment_form_validation_works()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(AddComment::class, [
                'idea' => $idea,
            ])
            ->set('comment', ' ')
            ->call('addComment')
            ->assertHasErrors('comment')
            ->set('comment', 'abc')
            ->call('addComment')
            ->assertHasErrors('comment');
    }

    public function test_add_comment_form_works()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(AddComment::class, [
                'idea' => $idea,
            ])
            ->set('comment', 'my comment')
            ->call('addComment')
            ->assertEmitted('commentWasAdded');

        $this->assertEquals(1, Comment::count());
        $this->assertEquals('my comment', $idea->comments->first()->body);
        
        $this->assertDatabaseHas('comments', [
            'body' => 'my comment',
        ]);
    }
}
