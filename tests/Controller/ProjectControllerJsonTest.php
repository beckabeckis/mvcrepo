<?php

namespace App\Test\Controller;

use App\Controller\ProjectControllerJson;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerJsonTest extends WebTestCase
{
    /**
     * Test /proj/api/deck route.
     */
    public function testApiDeck(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/proj/api/deck');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /proj/api/table route.
     */
    public function testApiTable(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/proj/api/table');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /proj/api/table_string route.
     */
    public function testApiTableString(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/proj/api/table_string');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /proj/api/table_is_full route.
     */
    public function testApiTableIsFull(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/proj/api/table_is_full');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /proj/api/score route.
     */
    public function testApiScore(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/proj/api/score');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /proj/api/delete route.
     */
    public function testApiDelete(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/proj/api/delete');

        $this->assertResponseIsSuccessful();
    }
}
