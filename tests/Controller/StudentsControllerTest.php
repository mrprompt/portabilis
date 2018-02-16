<?php
namespace App\Tests\Controller;

use App\Tests\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Students Controller Test Case
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class StudentsControllerTest extends BaseController
{
    /**
     * @test
     */
    public function accessCoursesRoute()
    {
        $crawler = $this->client->request('GET', '/students');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Estudantes', $crawler->filter('h1')->text());
    }
}
