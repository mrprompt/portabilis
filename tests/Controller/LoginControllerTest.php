<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testLoginForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/signup');

        $form = $crawler->selectButton('login_form_login')->form();

        $client->submit($form, [
            'login_form[email]' => 'foo@bar.bar',
            'login_form[password]' => '123456',
        ]);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
