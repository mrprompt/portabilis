<?php

namespace App\Tests\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SignupControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/signup');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

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
        //$this->assertContains('Registered', $crawler->filter('.alert p')->text());
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
    }
}
