<?php
namespace App\Tests\Repository;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;

/**
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var User
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
        parent::setUp();

        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
        $this->obj = $this->em->getRepository(User::class);
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
     * @covers \App\Repository\UserRepository::findAll
     */
    public function findAll()
    {
        $result = $this->obj->findAll();

        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     * @covers \App\Repository\UserRepository::findById
     */
    public function findById()
    {
        $result = $this->obj->findById(1);

        $this->assertTrue(is_array($result));
        $this->assertTrue(is_object($result[0]));
        $this->assertInstanceOf(User::class, $result[0]);
    }

    /**
     * @test
     * @covers \App\Repository\UserRepository::create
     * @expectedException \Doctrine\DBAL\Exception\NotNullConstraintViolationException
     */
    public function createWithUnpopulatedEntityThrowsException()
    {
        $result = $this->obj->create(new User());
    }
}
