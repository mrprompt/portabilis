<?php
namespace App\Tests\Controller;

use App\Tests\Controller\BaseController;

/**
 * Logout Controller Test Case
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class LogoutControllerTest extends BaseController
{
    /**
     * @test
     */
    public function logoutMustBeRedirectToHomePage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/logout');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
