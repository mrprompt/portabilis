<?php
namespace App\Tests\Service;

use App\Common\ChangeProtectedAttribute;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\UserService;
use App\Entity\User;
use App\Tests\Mock\Repository\UserRepository as UserRepositoryMock;
use App\Tests\Mock\Service\PasswordService as PasswordServiceMock;

/**
 * User service test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class UserServiceTest extends KernelTestCase
{
    use ChangeProtectedAttribute;

    /**
     * @var UserService
     */
    private $obj;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Boot
     */
    public function setUp()
    {
        parent::setUp();

        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();

        $this->obj = new UserService(
            UserRepositoryMock::getMock(),
            PasswordServiceMock::getMock()
        );
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
     * @covers \App\Service\UserService::save()
     */
    public function createMustBeReturnSameObject()
    {
        $userModel = new User();
        $userModel->setPassword('foo');

        $result = $this->obj->create($userModel);

        $this->assertInstanceOf(User::class, $result);
    }
}
