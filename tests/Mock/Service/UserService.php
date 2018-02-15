<?php
namespace App\Tests\Mock\Service;

use App\Entity\UserEntity;
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
        $mock = m::mock(UserEntity::class);
        $mock->shouldReceive('create')->andReturn(true)->byDefault();
        $mock->shouldReceive('delete')->andReturn(true)->byDefault();
        $mock->shouldReceive('update')->andReturn(true)->byDefault();
        $mock->shouldReceive('findByUserId')->andReturn(true)->byDefault();
        $mock->shouldReceive('listAll')->andReturn(true)->byDefault();

        return $mock;
    }
}
