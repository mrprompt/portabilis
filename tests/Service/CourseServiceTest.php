<?php
namespace App\Tests\Service;

use App\Entity\UserEntity;
use App\Service\UserService;
use App\Tests\Mock\Repository\UserRepository as UserRepositoryMock;
use App\Tests\Mock\Service\PasswordService as PasswordServiceMock;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * UserService test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CourseServiceTest extends KernelTestCase
{
    /**
     * @var UserService
     */
    private $obj;

    /**
     * Boot
     */
    public function setUp()
    {
        self::bootKernel();

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
        
        $this->obj = null;
    }

    /**
     * @test
     * @covers \App\Service\UserService::save()
     */
    public function createMustBeReturnSameObject()
    {
        $userModel = new UserEntity();
        $userModel->setPassword('foo');

        $result = $this->obj->create($userModel);

        $this->assertInstanceOf(UserEntity::class, $result);
    }
}
