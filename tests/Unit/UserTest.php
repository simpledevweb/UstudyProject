<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_phone_format(): void
    {
        $user = new User(['phone' => '998913795859']);
        $this->assertEquals('+998-91-379-58-59', $user->phone_format);
    }
}
