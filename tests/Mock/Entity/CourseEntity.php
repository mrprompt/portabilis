<?php
namespace App\Tests\Mock\Entity;

use App\Entity\CourseEntity;
use Mockery as m;

/**
 * Course Entity Mock
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
abstract class Course
{
    /**
     * @return m\MockInterface
     */
    public static function getMock()
    {
        $course = m::mock(CourseEntity::class);
        $course->shouldReceive('getId')->andReturn(1)->byDefault();
        $course->shouldReceive('setName')->andReturnNull()->byDefault();
        $course->shouldReceive('getName')->andReturn('Lorem ipsum')->byDefault();

        return $course;
    }
}
