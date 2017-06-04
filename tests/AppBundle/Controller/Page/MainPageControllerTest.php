<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainPageControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $link = $crawler
            ->filter('a:contains("Обо мне")')
            ->eq(0)
            ->link()
        ;
        
        $crawler = $client->click($link);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $this->assertContains('Здравствуйте, меня зовут Сергей "Япрошик"!', 
                $crawler->filter('h3')->text());
    }
}
