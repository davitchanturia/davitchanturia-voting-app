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
        $ideaOne = Idea::factory()->create();

        Idea::factory($ideaOne->getPerPage())->create();

        $response = $this->get('/');

        $response->assertSee(Idea::find(Idea::count())->title);
        $response->assertDontSee($ideaOne->title);

        $response = $this->get('/?page=2');

        $response->assertDontSee(Idea::find(Idea::count())->title);
        $response->assertSee($ideaOne->title);
    }

    public function test_in_app_back_button_works_when_index_page_visited_first()
    {
        $ideaOne = Idea::factory()->create();

        $response = $this->get('/?category=Category%202&status=Considering');
        $response = $this->get(route('idea.show', $ideaOne));

        $this->assertStringContainsString('/?category=Category%202&status=Considering', $response['backUrl']);
    }

    public function test_in_app_back_button_works_when_show_page_only_page_visited()
    {
        $ideaOne = Idea::factory()->create();

        $response = $this->get(route('idea.show', $ideaOne));

        $this->assertEquals(route('idea.index'), $response['backUrl']);
    }
}
