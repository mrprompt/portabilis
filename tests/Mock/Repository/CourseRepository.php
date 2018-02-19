<?php
namespace App\Tests\Mock\Repository;

use App\Repository\CourseRepository as Repository;
use App\Entity\CourseEntity;
use Mockery as m;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

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
        $paginator = new Pagerfanta(new DoctrineORMAdapter(''));
        $courseModel = new CourseEntity();
        
        $mock = m::mock(Repository::class);
        $mock->shouldReceive('create')->andReturn($courseModel)->byDefault();
        $mock->shouldReceive('findAll')->andReturn([$courseModel])->byDefault();
        $mock->shouldReceive('listAll')->andReturn($paginator)->byDefault();

        return $mock;
    }
}
