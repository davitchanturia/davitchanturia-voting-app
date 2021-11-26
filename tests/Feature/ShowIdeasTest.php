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
    

    public function test_list_of_ideas_shows_on_main_page()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'category 2']);

        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);


        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'description for first idea'
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'my second idea',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusConsidering->id,
            'description' => 'description for second idea'
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();

        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($categoryOne->name);
        $response->assertSee(
            '<div class="bg-gray-200 text-xxs font-bold uppercase leading-none 
        rounded-full text-center w-28 h-7 py-2 px-4">Open</div>',
            false
        );

        
        $response->assertSee($ideaTwo->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($categoryTwo->name);
        $response->assertSee(
            '<div class="bg-purple text-white text-xxs font-bold uppercase 
        leading-none rounded-full text-center w-28 h-7 py-2 px-4"> Considering </div>',
            false
        );
    }
    
    
    public function test_single_idea_shows_correctly_on_the_show_page()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'category 1']);

        $statusOpen =  Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title'       => 'My First Idea',
            'category_id' =>$category->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);
       
        $response = $this->get(route('idea.show', $idea));
         
        $response->assertSuccessful();
        $response->assertSee($idea->title);
        $response->assertSee($category->id);
        $response->assertSee($idea->description);
        $response->assertSee(
            '<div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
        Open </div>',
            false
        );
    }

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
}
