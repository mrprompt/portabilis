<?php
namespace App\Tests\Mock\Service;

use App\Service\UserService as Service;
use App\Service\PasswordService;
use Mockery as m;

/**
 * User Service Mock
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
abstract class UserService
{
    /**
     * @return m\MockInterface
     */
    public static function getMock()
    {
        $user = m::mock(UserInterface::class);
        $user->shouldReceive('create')->andReturn(true)->byDefault();
        $user->shouldReceive('delete')->andReturn(true)->byDefault();
        $user->shouldReceive('update')->andReturn(true)->byDefault();
        $user->shouldReceive('findByUserId')->andReturn(true)->byDefault();
        $user->shouldReceive('listAll')->andReturn(true)->byDefault();

        return $user;
    }
}
