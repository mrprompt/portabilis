<?php
namespace App\Tests\Mock\Service;

use App\Entity\UserEntity;
use App\Service\AuthorizationService as Service;
use App\Service\PasswordService;
use Mockery as m;

/**
 * AuthorizationService Mock
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
abstract class AuthorizationService
{
    /**
     * @return m\MockInterface
     */
    public static function getMock()
    {
        $user = new UserEntity;
        
        $mock = m::mock(Service::class);
        $mock->shouldReceive('authorize')->andReturn($user)->byDefault();

        return $mock;
    }
}
