<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainPageControllerTest extends WebTestCase {

    public function testMain() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('Рад вас приветствовать на моем сайте!', $crawler->filter('div.page__welcome')->text());
    }
    
    public function testPage() {
        
    }

}
