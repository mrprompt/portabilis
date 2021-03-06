<?php
namespace App\Tests\Controller;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\UserEntity;
use App\Common\ChangeProtectedAttribute;

class BaseController extends WebTestCase
{
    use ChangeProtectedAttribute;

    /**
     * Client
     */
    protected $client;
    
    /**
     * Create user session
     */
    protected function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $user = new UserEntity();

        $this->modifyAttribute($user, 'id', 1);
        
        $session->set('user', $user);
        $session->save();
        
        $cookie = new Cookie($session->getName(), $session->getId());
        
        $this->client->getCookieJar()->set($cookie);
    }

    /**
     * Bootstrap
     */
    public function setUp()
    {
        $kernel = self::bootKernel();

        $this->client = static::createClient();
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        parent::tearDown();
        
        $this->client = null;
    }
}