<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GravatarTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_generate_gravatar_default_image_when_no_email_found()
    {
        $user = User::factory()->create([
            'name' => 'dato',
            'email' => 'datochanturia@test.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://gravatar.com/avatar/'.md5($user->email).'?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-4.png',
            $gravatarUrl
        );

        $response = Http::get($user->getavatar());

        $this->assertTrue($response->successful());
    }

    public function test_user_can_generate_gravatar_default_image_when_no_email_found_1()
    {
        $user = User::factory()->create([
            'name' => 'dato',
            'email' => '1datochanturia@test.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://gravatar.com/avatar/'.md5($user->email).'?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-28.png',
            $gravatarUrl
        );

        $response = Http::get($user->getavatar());

        $this->assertTrue($response->successful());
    }
}
