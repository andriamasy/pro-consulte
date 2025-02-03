<?php

namespace App\Tests\Appel\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpecialistListTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form    = $crawler->selectButton('Se connecter')->form([
            'username' => 'admin@example.com',
            'password' => 'adminpass',
        ]);
        $client->submit($form);
        $client->followRedirect();

        $crawler = $client->request('GET', '/admin');

        $this->assertStringContainsString('Nos psychologues', $client->getResponse()->getContent());
    }
}