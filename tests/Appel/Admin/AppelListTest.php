<?php

namespace App\Tests\Appel\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppelListTest extends WebTestCase
{
    public function testAppelList(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form    = $crawler->selectButton('Se connecter')->form([
            'username' => 'admin@example.com',
            'password' => 'adminpass',
        ]);
        $client->submit($form);
        $client->followRedirect();

        $crawler = $client->request('GET', '/admin/appels');

        $this->assertStringContainsString('Liste des Appels', $client->getResponse()->getContent());
    }
}
