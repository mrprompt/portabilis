<?php
namespace App\Tests\Mock\Repository;

use App\Repository\UserRepository as Repository;
use App\Entity\User as UserModel;
use Mockery as m;

/**
 * User Repository Mock
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
abstract class UserRepository
{
    /**
     * @return m\MockInterface
     */
    public static function getMock()
    {
        $userModel = new UserModel();
        
        $user = m::mock(Repository::class);
        $user->shouldReceive('create')->andReturn($userModel)->byDefault();
        $user->shouldReceive('findById')->andReturn($userModel)->byDefault();
        $user->shouldReceive('findAll')->andReturn([$userModel])->byDefault();

        return $user;
    }
}
