<?php
namespace App\Tests\Repository;

use App\Entity\CourseEntity;
use App\Common\ChangeProtectedAttribute;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CourseRepositoryTest extends KernelTestCase
{
    use ChangeProtectedAttribute;
    
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
        $result = $this->obj->findById(1);

        $this->assertTrue(is_array($result));
    }

    public function validData()
    {
        $course1 = new CourseEntity;
        
        $this->modifyAttribute($course1, 'id', '1');
        $this->modifyAttribute($course1, 'name', 'Course 1');
        $this->modifyAttribute($course1, 'monthly_payment', 0);
        $this->modifyAttribute($course1, 'registration_fee', 0);
        $this->modifyAttribute($course1, 'period', 'matutino');
        $this->modifyAttribute($course1, 'duration', 0);
        
        return [
            [
                $course1
            ]
        ];
    }

    /**
     * @test
     * @covers \App\Repository\CourseRepository::create
     * @dataProvider validData
     */
    public function createWithValidData($data)
    {
        $result = $this->obj->create($data);

        $this->assertTrue(is_object($result));
        $this->assertInstanceOf(CourseEntity::class, $result);
    }

    /**
     * @test
     * @covers \App\Repository\CourseRepository::create
     * @expectedException \Doctrine\DBAL\Exception\NotNullConstraintViolationException
     */
    public function createWithUnpopulatedEntityThrowsException()
    {
        $this->obj->create(new CourseEntity());
    }
}
