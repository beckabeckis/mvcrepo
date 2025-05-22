<?php

namespace App\Test\Controller;

use App\Controller\AppControllerTwig;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTwigTest extends WebTestCase 
{
    /**
     * Test / route.
     */
    public function testHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /about route.
     */
    public function testAbout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/about');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /report route.
     */
    public function testReport(): void
    {
        $client = static::createClient();
        $client->request('GET', '/report');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /lucky route.
     */
    public function testLucky(): void
    {
        $client = static::createClient();
        $client->request('GET', '/lucky');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /api route.
     */
    public function testApi(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /metrics route.
     */
    public function testMetrics(): void
    {
        $client = static::createClient();
        $client->request('GET', '/metrics');

        $this->assertResponseIsSuccessful();
    }
}