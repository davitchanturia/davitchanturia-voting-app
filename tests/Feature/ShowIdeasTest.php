<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use SebastianBergmann\Type\FalseType;
use Illuminate\Foundation\Testing\WithFaker;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_ideas_pagination_works()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'category 1']);
        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);


        Idea::factory(Idea::PAGINATION_COUNT +1)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
        ]);

        $ideaOne = Idea::find(1);
        $ideaOne->title = 'my firts idea';
        $ideaOne->save();

        $ideaEleven = Idea::find(11);
        $ideaEleven->title = 'my eleventh idea';
        $ideaEleven->save();

        $response = $this->get(route('idea.index'));

        $response->assertSee($ideaEleven->title);
        $response->assertDontSee($ideaOne->title);

        $response = $this->get('/?page=2');

        $response->assertDontSee($ideaEleven->title);
        $response->assertSee($ideaOne->title);
    }

    public function test_in_app_back_button_works_when_index_page_visited_first()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'category 1']);
        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'description' => 'description for idea',
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
        ]);

        $response = $this->get('/?category=Category%202&status=Open');
        $response = $this->get(route('idea.show', [$idea]));
        
        $this->assertStringContainsString('/?category=Category%202&status=Open', $response['backUrl']);
    }

    public function test_in_app_back_button_works_when_show_page_only_page_visited()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'category 1']);
        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'description' => 'description for idea',
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
        ]);

        $response = $this->get(route('idea.show', [$idea]));
        
        
        $this->assertStringContainsString(route('idea.index'), $response['backUrl']);
    }
}
