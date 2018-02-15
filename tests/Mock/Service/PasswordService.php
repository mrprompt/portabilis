<?php
namespace App\Tests\Mock\Service;

use App\Service\PasswordService as Service;
use Mockery as m;

/**
 * Password Service Mock
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
abstract class PasswordService
{
    /**
     * @return m\MockInterface
     */
    public static function getMock()
    {
        $user = m::mock(Service::class);
        $user->shouldReceive('generate')->andReturn(rand(0, 100))->byDefault();
        $user->shouldReceive('verify')->andReturn(true)->byDefault();

        return $user;
    }
}
