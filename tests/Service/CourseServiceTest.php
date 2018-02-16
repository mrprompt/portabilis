<?php
namespace App\Tests\Service;

use App\Entity\CourseEntity;
use App\Service\CourseService;
use App\Tests\Mock\Repository\CourseRepository as CourseRepositoryMock;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * CourseService test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CourseServiceTest extends KernelTestCase
{
    /**
     * @var CourseService
     */
    private $obj;

    /**
     * Boot
     */
    public function setUp()
    {
        self::bootKernel();

        $this->obj = new CourseService(
            CourseRepositoryMock::getMock()
        );
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        parent::tearDown();
        
        $this->obj = null;
    }

    /**
     * @test
     * @covers \App\Service\CourseService::create()
     */
    public function createMustBeReturnSameObject()
    {
        $courseModel = new CourseEntity();

        $result = $this->obj->create($courseModel);

        $this->assertInstanceOf(CourseEntity::class, $result);
    }

    /**
     * @test
     * @covers \App\Service\CourseService::findAll()
     */
    public function findAllMustBeReturnArray()
    {
        $result = $this->obj->findAll();

        $this->assertTrue(is_array($result));
    }
}
