<?php

namespace Tests\Feature;

use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_list_of_ideas_shows_on_main_page()
    {
        $ideaOne = Idea::factory()->create([
            'title' => 'my first idea',
            'description' => 'description for first idea'
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'my second idea',
            'description' => 'description for second idea'
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaTwo->description);
    }
    
    
    public function test_single_idea_shows_correctly_on_the_show_page()
    {
        $idea = Idea::factory()->create([
            'title'       => 'My First Idea',
            'description' => 'Description of my first idea',
         ]);
        dd($idea->slug);
        $response = $this->get(route('idea.show', $idea->slug));
         
        $response->assertSuccessful();
        $response->assertSee($idea->title);
        $response->assertSee($idea->description);
    }
}
