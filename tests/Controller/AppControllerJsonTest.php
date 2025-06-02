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

    /**
     * Test jsonDeck route.
     */
    public function testJsonDeck(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/api/deck');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test jsonShuffle route.
     */
    public function testJsonShuffle(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/api/deck/shuffle');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test jsonDraw route.
     */
    public function testJsonDraw(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/api/deck/draw');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test jsonDrawMore route.
     */
    public function testJsonDrawMore(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/api/deck/draw/3');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test jsonDrawMore route.
     */
    public function testJsonDrawMoreMax(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/api/deck/draw/53');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test jsonGame route.
     */
    public function testJsonGame(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/api/game');

        $this->assertResponseIsSuccessful();
    }
}
