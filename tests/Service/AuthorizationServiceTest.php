<?php
namespace App\Tests\Service;

use App\Entity\User;
use App\Service\AuthorizationService;
use App\Tests\Mock\Repository\UserRepository as UserRepositoryMock;
use App\Tests\Mock\Service\PasswordService as PasswordServiceMock;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * AuthorizationService test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class AuthorizationServiceTest extends KernelTestCase
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

        $this->obj = new AuthorizationService(
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
     * @covers \App\Service\AuthorizationService::authorize()
     */
    public function authorizeMustBeReturnUserEntity()
    {
        $userModel = new User();
        $userModel->setPassword('foo');

        $result = $this->obj->authorize($userModel);

        $this->assertInstanceOf(User::class, $result);
    }
}
