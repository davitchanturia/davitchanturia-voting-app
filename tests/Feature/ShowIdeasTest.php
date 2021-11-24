<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_list_of_ideas_shows_on_main_page()
    {
        $categoryOne = Category::factory()->create(['name' => 'category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'category 2']);


        $ideaOne = Idea::factory()->create([
            'title' => 'my first idea',
            'category_id' => $categoryOne->id,
            'description' => 'description for first idea'
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'my second idea',
            'category_id' => $categoryTwo->id,
            'description' => 'description for second idea'
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();

        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($categoryOne->name);

        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($categoryTwo->name);
    }
    
    
    public function test_single_idea_shows_correctly_on_the_show_page()
    {
        $category = Category::factory()->create(['name' => 'category 1']);

        $idea = Idea::factory()->create([
            'title'       => 'My First Idea',
            'category_id' =>$category->id,
            'description' => 'Description of my first idea',
        ]);
       
        $response = $this->get(route('idea.show', $idea));
         
        $response->assertSuccessful();
        $response->assertSee($idea->title);
        $response->assertSee($category->id);
        $response->assertSee($idea->description);
    }

    public function test_ideas_pagination_works()
    {
        $category = Category::factory()->create(['name' => 'category 1']);

        Idea::factory(Idea::PAGINATION_COUNT +1)->create([
            'category_id' => $category->id
        ]);

        $ideaOne = Idea::find(1);
        $ideaOne->title = 'my firts idea';
        $ideaOne->save();

        $ideaEleven = Idea::find(11);
        $ideaEleven->title = 'my eleventh idea';
        $ideaEleven->save();

        $response = $this->get(route('idea.index'));

        $response->assertSee($ideaOne->title);
        $response->assertDontSee($ideaEleven->title);

        $response = $this->get('/?page=2');

        $response->assertDontSee($ideaOne->title);
        $response->assertSee($ideaEleven->title);
    }
}
