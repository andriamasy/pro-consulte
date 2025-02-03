<?php

namespace App\Tests\Specialist;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpecialistListTest extends WebTestCase
{
    public function testAppelList(): void
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertStringContainsString('Nos psychologues', $client->getResponse()->getContent());
    }
}
