<?php

namespace App\Test\Controller;

use App\Controller\AppControllerJson;
use App\Controller\AppControllerJsonCard;
use App\Controller\AppControllerJsonLibrary;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerJsonTest extends WebTestCase 
{
    /**
     * Test jsonQuote route.
     */
    public function testJsonQuote(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/api/quote');


        $this->assertResponseIsSuccessful();
    }
}