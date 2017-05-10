<?php

namespace Tests;

use App\Exceptions\Handler;
use App\Model\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }

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

    /**
     * Helper funtion setUp used to disable exception handling, resulting in raw exceptions
     * being thrown all the way up when encountered in tests. This will be the default state of TestCase.
     *
     * If you wish to allow for regular exception handling, run withExceptionHandling on your feature tests
     *
     * Hat tip, @adamwathan https://gist.github.com/viralsolani/57341bd32048fec4e11bd90988ee6322
     */
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    /**
     * Re-enables exception handling, allowing exceptions to be caught by native catch
     * @return $this
     */
    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}
