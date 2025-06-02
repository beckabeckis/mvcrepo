<?php

namespace App\Test\Controller;

use App\Entity\Library;
use App\Controller\LibraryController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LibraryControllerTest extends WebTestCase
{
    /**
     * Test library route.
     */
    public function testIndex(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('GET', '/library');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /api/library/books route with no books in library.
     */
    public function testIndexWithNoBooks(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/library/delete_all');
        $client->request('GET', '/library');

        $this->assertResponseIsSuccessful();
        $client->request('GET', '/library/reset');
    }

    /**
     * Test library/create route.
     */
    public function testCreateBook(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
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
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
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
        $client->request('GET', '/library/reset');
    }

    // /**
    //  * Test library/update/{id} route.
    //  */
    // public function testUpdateLibrary(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/library/reset');
    //     $response = $client->request('GET', '/library/update/1');

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
    //         'id' => 1,
    //         'title' => 'testTile',
    //         'author' => 'testAuthor',
    //         'isbn' => 'testISBN',
    //         'imageLink' => 'testImageLink',
    //         'details' => 'testDetails',
    //     ]);

    //     $this->assertResponseRedirects('/library/book/1');
    // }

    // /**
    //  * Test library/create post route.
    //  */
    // public function testUpdateLibraryPost(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/library/reset');
    //     $response = $client->request('POST', '/library/update', [
    //         'id' => 1,
    //         'title' => 'testTile',
    //         'author' => 'testAuthor',
    //         'isbn' => 'testISBN',
    //         'imageLink' => 'testImageLink',
    //         'details' => 'testDetails',
    //     ]);

    //     $this->assertResponseRedirects('/library/book/1');
    // }

    /**
     * Test library/viww route.
     */
    public function testViewAllProducts(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
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
    //     $response = $client->request('GET', '/library/book/1');

    //     $this->assertResponseIsSuccessful();
    // }

    // /**
    //  * Test library/delete/{id} route.
    //  */
    // public function testDeleteLibraryById(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/library/reset');
    //     $client->catchExceptions(false);
    //     $response = $client->request('GET', '/library/delete/1');

    //     $this->expectException(\createNotFoundException::class);
    // }


    /**
     * Test /api/library/books route.
     */
    public function testShowAllBooksApi(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/api/library/books');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /api/library/books route with no books in library.
     */
    public function testShowAllBooksApiWithNoBooks(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/library/delete_all');
        $client->request('GET', '/api/library/books');

        $this->assertResponseIsSuccessful();
        $client->request('GET', '/library/reset');
    }

    /**
     * Test /api/library/books/9780060188702 route.
     */
    public function testSearchByIsbnApi(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->catchExceptions(false);

        $client->request('GET', '/api/library/books/9780060188702');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /api/library/books/9780060188702 route with no books in library.
     */
    public function testSearchByIsbnApiWithNoBooks(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/library/delete_all');
        $client->request('GET', '/api/library/books/9780060188702');

        $this->assertResponseIsSuccessful();
        $client->request('GET', '/library/reset');
    }
}
