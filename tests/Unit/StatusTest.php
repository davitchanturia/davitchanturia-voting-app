<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_count_of_each_status()
    {
        $statusOpen = Status::factory()->create(['name' => 'open']);
        $statusConsidering = Status::factory()->create(['name' => 'considering']);
        $statusInProgress = Status::factory()->create(['name' => 'in_progress']);
        $statusimplemented = Status::factory()->create(['name' => 'implemented']);
        $statusClosed = Status::factory()->create(['name' => 'closed']);

        Idea::factory(3)->create([
            'status_id' => $statusOpen->id
        ]);

        Idea::factory()->create([
            'status_id' => $statusConsidering->id
        ]);

        Idea::factory(3)->create([
            'status_id' => $statusimplemented->id
        ]);

        Idea::factory(2)->create([
            'status_id' => $statusInProgress->id
        ]);

        Idea::factory(3)->create([
            'status_id' => $statusClosed->id
        ]);

        $this->assertEquals(12, Status::getCount()['all_statuses']);
        $this->assertEquals(3, Status::getCount()['open']);
        $this->assertEquals(1, Status::getCount()['considering']);
        $this->assertEquals(3, Status::getCount()['implemented']);
        $this->assertEquals(2, Status::getCount()['in_progress']);
        $this->assertEquals(3, Status::getCount()['closed']);
    }
}
