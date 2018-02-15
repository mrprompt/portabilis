<?php
namespace App\Tests\Controller;

use App\Tests\Controller\BaseController;

/**
 * Default Controller Test Case
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class DefaultControllerTest extends BaseController
{
    /**
     * @test
     */
    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Hello!', $crawler->filter('h1')->text());
    }
}
