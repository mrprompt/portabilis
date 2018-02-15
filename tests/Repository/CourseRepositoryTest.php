<?php
namespace App\Tests\Repository;

use App\Entity\CourseEntity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CourseRepositoryTest extends KernelTestCase
{
    /**
     * @var CourseEntity
     */
    protected $obj;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Bootstrap
     */
    public function setUp()
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
        $this->obj = $this->em->getRepository(CourseEntity::class);
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        parent::tearDown();
        
        $this->em->close();

        $this->em = null;
        $this->obj = null;
    }

    /**
     * @test
     * @covers \App\Repository\CourseRepository::findAll
     */
    public function findAll()
    {
        $result = $this->obj->findAll();

        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     * @covers \App\Repository\CourseRepository::findById
     */
    public function findById()
    {
        $this->markTestIncomplete();
        
        $result = $this->obj->findById(1);

        $this->assertTrue(is_array($result));
        $this->assertInstanceOf(CourseEntity::class, $result[0]);
    }

    /**
     * @test
     * @covers \App\Repository\CourseRepository::create
     * @expectedException \Doctrine\DBAL\Exception\NotNullConstraintViolationException
     */
    public function createWithUnpopulatedEntityThrowsException()
    {
        $this->markTestIncomplete();
        
        $this->obj->create(new CourseEntity());
    }
}
