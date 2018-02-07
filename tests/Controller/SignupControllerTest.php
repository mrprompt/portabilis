<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SignupControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/signup');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to the Signup:index page', $crawler->filter('.container h1')->text());
    }

    public function validArgumentsProvider()
    {
        return [
            [
                [
                    'signup_form[name]' => 'Foo',
                    'signup_form[email]' => uniqid() . '@foo.bar.bar',
                    'signup_form[password][first]' => '123456',
                    'signup_form[password][second]' => '123456',
                    'signup_form[locale]' => 'pt_BR'
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
        // $this->assertContains('Registered', $crawler->filter('.alert p')->text());
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
