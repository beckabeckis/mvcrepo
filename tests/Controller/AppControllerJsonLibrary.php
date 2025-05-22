<?php

namespace App\Test\Controller;

use App\Controller\AppControllerJsonLibrary;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerJsonLibraryTest extends WebTestCase 
{
    /**
     * Test /api/library/books route.
     */
    public function testShowAllBooksApi(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/library/books');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /api/library/books/9780060188702 route.
     */
    public function testSearchByIsbnApi(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/library/books/9780060188702');

        $this->assertResponseIsSuccessful();
    }
}