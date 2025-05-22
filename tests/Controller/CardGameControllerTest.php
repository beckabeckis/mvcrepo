<?php

namespace App\Test\Controller;

use App\Controller\CardGameController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardGameControllerTest extends WebTestCase 
{
    /**
     * Test /session and /session/delete route.
     */
    public function testSession(): void
    {
        $client = static::createClient();
        $client->request('GET', '/session');

        $this->assertResponseIsSuccessful();

        $client->request('GET', '/session/delete');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card route.
     */
    public function testCard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card/deck route no session.
     */
    public function testDeckNoSession(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card/deck route.
     */
    public function testDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/session');
        $client->request('GET', '/card/deck');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card/deck/shuffle route no session.
     */
    public function testShuffleNoSession(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/shuffle');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card/deck/shuffle route.
     */
    public function testShuffle(): void
    {
        $client = static::createClient();
        $client->request('GET', '/session');
        $client->request('GET', '/card/deck/shuffle');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card/deck/draw route no session.
     */
    public function testDrawNoSession(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/draw');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card/deck/draw route.
     */
    public function testDraw(): void
    {
        $client = static::createClient();
        $client->request('GET', '/session');
        $client->request('GET', '/card/deck/draw');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card/deck/draw{num} route no session.
     */
    public function testDrawManyNoSession(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/draw/4');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /card/deck/draw/{num} route.
     */
    public function testDrawMany(): void
    {
        $client = static::createClient();
        $client->request('GET', '/session');
        $client->request('GET', '/card/deck/draw/50');
        $client->request('GET', '/card/deck/draw/2');
        $client->request('GET', '/card/deck/draw/3');

        $this->assertResponseIsSuccessful();
    }
}