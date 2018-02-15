<?php
namespace App\Tests\Controller;

use App\Tests\Controller\BaseController;

/**
 * Login Controller Test Case
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class LoginControllerTest extends BaseController
{
    /**
     * @test
     */
    public function testLoginForm()
    {
        $crawler = $this->client->request('GET', '/signup');

        $form = $crawler->selectButton('login_form_login')->form();

        $this->client->submit($form, [
            'login_form[email]' => 'foo@bar.bar',
            'login_form[password]' => '123456',
        ]);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->filter('.danger')->count());
    }
}
