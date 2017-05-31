<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $link = $crawler
            ->filter('a:contains("about")')
            ->eq(1)
            ->link()
        ;
        
        $crawler = $client->click($link);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
