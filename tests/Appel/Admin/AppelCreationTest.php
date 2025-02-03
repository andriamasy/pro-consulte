<?php

namespace App\Tests\Appel\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppelCreationTest extends WebTestCase
{
    public function testAppelCreation(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form    = $crawler->selectButton('Se connecter')->form([
            'username' => 'admin@example.com',
            'password' => 'adminpass',
        ]);
        $client->submit($form);
        $client->followRedirect();

        $client->request('POST', '/specialist/call', [
            'specialist_id' => 1,
        ]);

        // Vérifier que la réponse est bien JSON avec un success true
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('success', $data);
        $this->assertTrue($data['success']);
        $this->assertEquals('Appel est enregistré evec succès .', $data['message']);
    }
}
