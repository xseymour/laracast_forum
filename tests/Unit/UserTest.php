<?php
use App\Model\User;
use Tests\DatabaseTestCase;

/**
 * Class Description Here.
 *
 * @author Xavier Seymour (Xseymour3@gmail.com)
 * Date: 5/8/17
 */

class UserTest extends DatabaseTestCase
{
    /**
     * @var User
     */
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = create(User::class);
    }

    /**
     * @test
     */
    function a_user_has_replies()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->user->replies);
    }

    /**
     * @test
     */
    function a_user_has_threads()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->user->threads);
    }

}