<?php
namespace App\Tests\Controller;

use DateTime;
use App\Tests\Controller\BaseController;

/**
 * Register Controller Test Case
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class RegisterControllerTest extends BaseController
{
    public function validArgumentsProvider()
    {
        return [
            [
                [
                    'signup_form[name]' => 'Foo',
                    'signup_form[email]' => uniqid() . '@foo.bar.bar',
                    'signup_form[password]' => '123456',
                    'signup_form[document_cpf]' => '11111111111',
                    'signup_form[document_rg]' => '222222222',
                    'signup_form[phone_number]' => '123456',
                    'signup_form[birthday][day]' => '1',
                    'signup_form[birthday][month]' => '1',
                    'signup_form[birthday][year]' => date('Y'),
                    'signup_form[save]' => true,
                ]
            ]
        ];
    }

    /**
     * @dataProvider validArgumentsProvider
     * @test
     */
    public function testSignupForm($data)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/signup');

        $form = $crawler->selectButton('signup_form_save')->form();

        $client->submit($form, $data);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->filter('.info')->count());
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
        $client = static::createClient();

        $crawler = $client->request('GET', '/signup');

        $form = $crawler->selectButton('signup_form_save')->form();

        $client->submit($form, $data);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->filter('.danger')->count());
    }
}
