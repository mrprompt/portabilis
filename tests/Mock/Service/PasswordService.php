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
        $mock = m::mock(Service::class);
        $mock->shouldReceive('generate')->andReturn(rand(0, 100))->byDefault();
        $mock->shouldReceive('verify')->andReturn(true)->byDefault();

        return $mock;
    }
}
