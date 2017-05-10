<?php

namespace Tests;

use App\Model\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sign in a user for testing purposes
     * @param User $user
     * @return User The signed in user
     */
    public function signIn($user = null)
    {
        $user = $user ?: create(User::class);
        $this->be($user);
        return $user;
    }
}
