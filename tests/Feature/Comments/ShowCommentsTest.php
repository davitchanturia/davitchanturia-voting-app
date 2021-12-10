<?php

namespace Tests\Feature\Comments;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_idea_comments_livewire_component_renders()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'THis is my first comment',
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-comments');
    }


    public function test_idea_comment_livewire_component_renders()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'THis is my first comment',
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-comment');
    }

    public function test_no_comments_shows_approptiate_message()
    {
        $idea = Idea::factory()->create();

        $this->get(route('idea.show', $idea))
            ->assertSee('No comments yet');
    }

    public function test_list_of_comments_shows_on_idea_page()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);

        $commentTwo = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my second comment',
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeInOrder(['This is my first comment', 'This is my second comment'])
            ->assertSee('2 comments');
    }

    public function test_comments_count_shows_correctly_on_index_page()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);

        $commentTwo = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my second comment',
        ]);

        $this->get(route('idea.index'))
            ->assertSee('2 comments');
    }

    public function test_op_badge_shows_if_author_of_idea_comments_on_idea()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $commentOne = Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSee('OP');
    }

    public function test_comments_pagination_works()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
        ]);

        Comment::factory($commentOne->getPerPage())->create([
            'idea_id' => $idea->id,
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertSee($commentOne->body);
        $response->assertDontSee(Idea::find(Idea::count()));

        $response = $this->get(route('idea.show', [
            'idea' => $idea,
            'page' => 2,
        ]));

        $response->assertDontSee(Idea::find(Idea::count()));
        $response->assertSee($commentOne->title);
    }
}
