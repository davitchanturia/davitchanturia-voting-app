<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_check_if_user_is_admin()
    {
        $user = User::factory()->make([
            'name' => 'dato',
            'email' =>'dato@redberry.ge'
        ]);

        $userB = User::factory()->make([
            'name' => 'shavdia',
            'email' =>'geno@test.ge'
        ]);

        $this->assertTrue($user->isAdmin());
        $this->assertFalse($userB->isAdmin());
    }
}
