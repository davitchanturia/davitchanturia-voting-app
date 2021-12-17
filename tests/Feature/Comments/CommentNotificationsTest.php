<?php

namespace Tests\Feature\comments;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\AddComment;
use App\Http\Livewire\CommentNotifications;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\DatabaseNotification;

class CommentNotificationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_comment_notifications_livewire_component_renders_when_user_logged_in()
    {
        $user = User::factory()->create();
 
        $response = $this->actingAs($user)->get(route('idea.index'));
 
        $response->assertSeeLivewire('comment-notifications');
    }

    public function test_comment_notifications_livewire_component_does_not_render_when_user_not_logged_in()
    {
        $response = $this->get(route('idea.index'));

        $response->assertDontSeeLivewire('comment-notifications');
    }

    public function test_notifications_show_for_logged_in_user()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();
        $userBCommenting = User::factory()->create();

        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, [ 'idea' => $idea, ])
            ->set('comment', 'This is the first comment')
            ->call('addComment');

        Livewire::actingAs($userBCommenting)
            ->test(AddComment::class, [ 'idea' => $idea, ])
            ->set('comment', 'This is the second comment')
            ->call('addComment');

        DatabaseNotification::first()->update([ 'created_at' => now()->subMinute() ]);

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('getNotifications')
            ->assertSeeInOrder(['This is the second comment', 'This is the first comment'])
            ->assertSet('notificationCount', 2);
    }

    public function test_notification_count_greater_than_threshold_shows_for_logged_in_user()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();
        $threshold = CommentNotifications::NOTIFICATION_THRESHOLD;

        foreach (range(1, $threshold + 1) as $item) {
            Livewire::actingAs($userACommenting)
                ->test(AddComment::class, [ 'idea' => $idea, ])
                ->set('comment', 'This is the first comment')
                ->call('addComment');
        }

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('getNotifications')
            ->assertSet('notificationCount', $threshold.'+')
            ->assertSee($threshold.'+');
    }

    public function test_can_mark_all_notifications_as_read()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();
        $userBCommenting = User::factory()->create();

        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, [ 'idea' => $idea, ])
            ->set('comment', 'This is the first comment')
            ->call('addComment');

        Livewire::actingAs($userBCommenting)
            ->test(AddComment::class, [ 'idea' => $idea, ])
            ->set('comment', 'This is the second comment')
            ->call('addComment');

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('getNotifications')
            ->call('markAllAsRead');

        $this->assertEquals(0, $user->fresh()->unreadNotifications->count());
    }

    public function test_can_mark_individual_notification_as_read()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();
        $userBCommenting = User::factory()->create();

        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, [ 'idea' => $idea, ])
            ->set('comment', 'This is the first comment')
            ->call('addComment');

        Livewire::actingAs($userBCommenting)
            ->test(AddComment::class, [ 'idea' => $idea, ])
            ->set('comment', 'This is the second comment')
            ->call('addComment');

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('getNotifications')
            ->call('markAsRead', DatabaseNotification::first()->id)
            ->assertRedirect(route('idea.show', [
                'idea' => $idea,
                'page' => 1,
            ]));

        $this->assertEquals(1, $user->fresh()->unreadNotifications->count());
    }

    public function test_notification_idea_deleted_redirects_to_index_page()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();

        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, [ 'idea' => $idea, ])
            ->set('comment', 'This is the first comment')
            ->call('addComment');

        $idea->delete();

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('getNotifications')
            ->call('markAsRead', DatabaseNotification::first()->id)
            ->assertRedirect(route('idea.index'));
    }

    public function test_notification_comment_deleted_redirects_to_index_page()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();

        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, [ 'idea' => $idea, ])
            ->set('comment', 'This is the first comment')
            ->call('addComment');

        $idea->comments()->delete();

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('getNotifications')
            ->call('markAsRead', DatabaseNotification::first()->id)
            ->assertRedirect(route('idea.index'));
    }
}
