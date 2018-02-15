<?php
namespace App\Tests\Controller;

use DateTime;
use App\Tests\Controller\BaseController;

/**
 * Signup Controller Test Case
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class SignupControllerTest extends BaseController
{
    /**
     * @test
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/signup');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
