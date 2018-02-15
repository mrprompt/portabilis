<?php
namespace App\Tests\Controller;

use DateTime;
use App\Tests\Controller\BaseController;
use App\Entity\UserEntity;

/**
 * Profile Controller Test Case
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class ProfileControllerTest extends BaseController
{
    /**
     * @test
     */
    public function accessIndexWithoutSession()
    {
        $crawler = $this->client->request('GET', '/profile');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * @test
     */
    public function accessIndexWithSession()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/profile');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Editar perfil', $crawler->filter('.container > .row > .col-md-6 > h2')->text());
    }

    public function validArgumentsProvider()
    {
        return [
            [
                [
                    'profile_form[name]' => 'Foo',
                    'profile_form[email]' => uniqid() . '@foo.bar.bar',
                    'profile_form[document_cpf]' => '11111111111',
                    'profile_form[document_rg]' => '222222222',
                    'profile_form[phone_number]' => '123456',
                    'profile_form[birthday][day]' => '1',
                    'profile_form[birthday][month]' => '1',
                    'profile_form[birthday][year]' => date('Y'),
                    'profile_form[save]' => true,
                ]
            ]
        ];
    }

    /**
     * @dataProvider validArgumentsProvider
     * @test
     */
    public function postFormWithValidData($data)
    {
        $this->logIn();
        
        $crawler = $this->client->request('GET', '/profile');
        $form = $crawler->selectButton('profile_form_save')->form();

        $this->client->submit($form, $data);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->filter('.danger')->count());
    }

    public function invalidArgumentsProvider()
    {
        return [
            [
                [

                ]
            ]
        ];
    }

    /**
     * @dataProvider invalidArgumentsProvider
     * @test
     */
    public function testSignupFormWithInvalidArguments($data)
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/profile');
        $form = $crawler->selectButton('profile_form_save')->form();

        $this->client->submit($form, $data);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->filter('.danger')->count());
    }
}
