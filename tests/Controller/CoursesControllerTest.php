<?php
namespace App\Tests\Controller;

use App\Tests\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Courses Controller Test Case
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CoursesControllerTest extends BaseController
{
    /**
     * @test
     */
    public function accessCoursesRoute()
    {
        $crawler = $this->client->request('GET', '/courses');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Cursos', $crawler->filter('h1')->text());
    }
}
