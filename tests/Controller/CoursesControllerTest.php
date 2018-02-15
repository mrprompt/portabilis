<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoursesControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/courses');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // $this->assertContains('Hello, world!', $crawler->filter('.jumbotron .container h1')->text());
    }
}
