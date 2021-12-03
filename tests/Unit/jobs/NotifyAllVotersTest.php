<?php

namespace Tests\Unit\jobs;

use App\Jobs\NotifyAllVoters;
use App\Mail\IdeaStatusUpdateMailable;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

class NotifyAllVotersTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sends_an_email_to_all_users()
    {
        $user = User::factory()->create([
            'email' => 'dato@redberry.ge'
        ]);
        $userB = User::factory()->create([
            'email' => 'user@test.com'
        ]);
        
        $categoryOne = Category::factory()->create(['name' => 'category 1']);

        $statusConsidering =  Status::factory()->create(['id' => '2', 'name' => 'Considering']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'description' => 'description for first idea'
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Vote::factory()->create([
            'user_id' => $userB->id,
            'idea_id' => $idea->id
        ]);

        Mail::fake();

        NotifyAllVoters::dispatch($idea);

        Mail::assertQueued(IdeaStatusUpdateMailable::class, function ($mail) {
            return $mail->hasTo('dato@redberry.ge')
                && $mail->build()->subject === 'An idea you voted for has a new status';
        });

        Mail::assertQueued(IdeaStatusUpdateMailable::class, function ($mail) {
            return $mail->hasTo('user@test.com')
                && $mail->build()->subject === 'An idea you voted for has a new status';
        });
    }
}
