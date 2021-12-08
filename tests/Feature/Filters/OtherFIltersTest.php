<?php

namespace Tests\Feature\Filters;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class OtherFIltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_top_voted_filter_works()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

        $category = Category::factory()->create();

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my idea',
            'description' => 'description for my idea'
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my idea',
            'description' => 'description for my idea'
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $ideaOne->id
        ]);

        Vote::factory()->create([
            'user_id' => $userB->id,
            'idea_id' => $ideaOne->id
        ]);

        Vote::factory()->create([
            'user_id' => $userC->id,
            'idea_id' => $ideaOne->id
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $ideaTwo->id
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('filter', 'Top Voted')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2
                    && $ideas->first()->votes()->count() === 3
                    && $ideas->get(1)->votes()->count() === 1;
            });
    }

    public function test_my_ideas_filter_works_correctly_when_user_is_logged_id()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create();

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my first idea',
            'description' => 'description for my idea'
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my second idea',
            'description' => 'description for my idea'
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $userB->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my third idea',
            'description' => 'description for my idea'
        ]);

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2
                    && $ideas->first()->title === 'my second idea'
                    && $ideas->get(1)->title === 'my first idea';
            });
    }

    public function test_my_ideas_filter_works_correctly_when_user_is_not_logged_id()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create();

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my first idea',
            'description' => 'description for my idea'
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my second idea',
            'description' => 'description for my idea'
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $userB->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my third idea',
            'description' => 'description for my idea'
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertRedirect(route('login'));
    }

    public function test_my_ideas_filter_works_correctly_with_categories_filter()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);
        $categoryB = Category::factory()->create(['name' => 'Category 2']);
        

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my first idea',
            'description' => 'description for my idea'
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my second idea',
            'description' => 'description for my idea'
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $userB->id,
            'category_id' => $categoryB->id,
            'status_id' => $statusOpen->id,
            'title' => 'my third idea',
            'description' => 'description for my idea'
        ]);

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('category', 'Category 1')
            ->set('filter', 'My Ideas')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2
                    && $ideas->first()->title === 'my second idea'
                    && $ideas->get(1)->title === 'my first idea';
            });
    }

    public function test_no_filters_works_correctly()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create();

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my first idea',
            'description' => 'description for my idea'
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my second idea',
            'description' => 'description for my idea'
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $userB->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'my third idea',
            'description' => 'description for my idea'
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('filter', 'No Filters')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 3
                    && $ideas->first()->title === 'my third idea'
                    && $ideas->get(1)->title === 'my second idea';
            });
    }

    public function test_spam_ideas_filter_works()
    {
        $user = User::factory()->create([
            'email' => 'dato@redberry.ge',
        ]);

        $ideaOne = Idea::factory()->create([
            'title' => 'Idea One',
            'spam_reports' => 1
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'Idea Two',
            'spam_reports' => 2
        ]);

        $ideaThree = Idea::factory()->create([
            'title' => 'Idea Three',
            'spam_reports' => 3
        ]);

        $ideaFour = Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'Spam Ideas')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 3
                    && $ideas->first()->title === 'Idea Three'
                    && $ideas->get(1)->title === 'Idea Two'
                    && $ideas->get(2)->title === 'Idea One';
            });
    }
}
