<?php

namespace Tests\Feature\comments;

use App\Http\Livewire\EditComment;
use App\Http\Livewire\IdeaComment;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class editCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_edit_comment_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('edit-comment');
    }

    public function test_edit_comment_is_set_correctly_when_user_clicks_it_from_menu()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'body' => 'this is my comment',
        ]);

        Livewire::actingAs($user)
            ->test(EditComment::class)
            ->call('setEditComment', $comment->id)
            ->assertSet('body', $comment->body)
            ->assertEmitted('editCommentWasSet');
    }

    public function test_edit_comment_form_validation_works()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'body' => 'this is my comment',
        ]);

        Livewire::actingAs($user)
            ->test(EditComment::class)
            ->call('setEditComment', $comment->id)
            ->set('body', '')
            ->call('updateComment')
            ->assertHasErrors(['body'])
            ->assertSee('The body field is required');
    }

    public function test_editing_an_comment_works_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'body' => 'This is my first comment',
        ]);

        Livewire::actingAs($user)
            ->test(EditComment::class)
            ->call('setEditComment', $comment->id)
            ->set('body', 'This is my updated comment')
            ->call('updateComment')
            ->assertEmitted('commentWasUpdated');
        $this->assertEquals('This is my updated comment', Comment::first()->body);
    }

    public function test_editing_an_comment_does_not_work_when_user_has_not_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);

        Livewire::actingAs($user)
            ->test(EditComment::class)
            ->call('setEditComment', $comment->id)
            ->set('body', 'This is my updated comment')
            ->call('updateComment')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_editing_an_comment_shows_on_menu_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);

        Livewire::actingAs($user)
            ->test(IdeaComment::class, [
                'comment' => $comment,
                'ideaUserId' => $idea->user->id,
            ])
            ->assertSee('Edit Comment');
    }

    public function test_editing_an_comment_does_not_shows_on_menu_when_user_has_not_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();
 
        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);
        Livewire::actingAs($user)
            ->test(IdeaComment::class, [
                'comment' => $comment,
                'ideaUserId' => $idea->user->id,
            ])
            ->assertDontSee('Edit Comment');
    }
}
