<?php

namespace App\Test\Controller;

use App\Controller\LibraryController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LibraryControllerTest extends WebTestCase 
{
    /**
     * Test library route.
     */
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test library/create route.
     */
    public function testCreateBook(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/reset');
        $client->request('GET', '/library/create');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test library/create post route.
     */
    public function testCreateBookPost(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/reset');
        $client->request('POST', '/library/create', [
            'title' => 'testTile',
            'author' => 'testAuthor',
            'isbn' => 'testISBN',
            'imageLink' => 'testImageLink',
            'details' => 'testDetails',
        ]);

        $this->assertResponseRedirects('/library/view');
    }

    /**
     * Test library/update/{id} route.
     */
    // public function testUpdateLibrary(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/library/reset');
    //     $response = $client->request('GET', '/library/update/28');

    //     $this->assertResponseIsSuccessful();
    // }

    // /**
    //  * Test library/create post route.
    //  */
    // public function testUpdateLibraryPost(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/library/reset');
    //     $response = $client->request('POST', '/library/update', [
    //         'id' => 28,
    //         'title' => 'testTile',
    //         'author' => 'testAuthor',
    //         'isbn' => 'testISBN',
    //         'imageLink' => 'testImageLink',
    //         'details' => 'testDetails',
    //     ]);

    //     $this->assertResponseRedirects('/library/book/28');
    // }

    /**
     * Test library/viww route.
     */
    public function testViewAllProducts(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/reset');
        $client->request('GET', '/library/view');

        $this->assertResponseIsSuccessful();
    }

    // /**
    //  * Test library/book/{id} route.
    //  */
    // public function testViewOneProduct(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/library/reset');
    //     $response = $client->request('GET', '/library/book/28');

    //     $this->assertResponseIsSuccessful();
    // }

    /**
     * Test library/delete/{id} route.
     */
    // public function testDeleteLibraryById(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/library/reset');
    //     $client->catchExceptions(false);
    //     $response = $client->request('GET', '/library/delete/28');

    //     $this->expectException(\createNotFoundException::class);
    // }
}