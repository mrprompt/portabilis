<?php
namespace App\Tests\Mock\Service;

use App\Entity\User;
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
        $mock = m::mock(Service::class);
        $mock->shouldReceive('authorize')->andReturn(new User)->byDefault();

        return $mock;
    }
}
