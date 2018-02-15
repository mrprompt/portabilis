<?php
namespace App\Tests\Mock\Repository;

use App\Repository\CourseRepository as Repository;
use App\Entity\CourseEntity;
use Mockery as m;

/**
 * Course Repository Mock
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
abstract class CourseRepository
{
    /**
     * @return m\MockInterface
     */
    public static function getMock()
    {
        $courseModel = new CourseEntity();
        
        $mock = m::mock(Repository::class);
        $mock->shouldReceive('create')->andReturn($courseModel)->byDefault();
        $mock->shouldReceive('findAll')->andReturn([$courseModel])->byDefault();

        return $mock;
    }
}
