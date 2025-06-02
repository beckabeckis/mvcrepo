<?php

namespace App\Test\Controller;

use App\Project\Table;
use App\Card\CardGraphic;
use App\Controller\ProjectController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase
{
    /**
     * Test /about route.
     */
    public function testAbout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/about');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Jag har valt');
    }
    
    /**
     * Test /proj route no session.
     */
    public function testProj(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj');
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Spelets idé är');
    }

    /**
     * Test /proj/square_board route.
     */
    public function testSquareBoard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj');
        for ($i = 1; $i <= 52; $i++) {
            $client->request('GET', '/proj/square_board');

            $this->assertResponseIsSuccessful('p', 'Nytt kort:');
        }

    }

    /**
     * Test /proj/square_board_post route.
     */
    public function testSquareBoardPost(): void
    {
        $postData = [
            'row' => "1",
            'col' => "2",
            'value' => "6",
            'color' => "heart",
            'test' => "ok"
        ];
        $client = static::createClient();
        $client->request('GET', '/proj');
        $client->request('POST', '/proj/square_board_post', $postData);

        $this->assertResponseRedirects('/proj/square_board');
    }

    /**
     * Test /proj/square_board_post route with all cards full.
     */
    public function testSquareBoardPostCardsFull(): void
    {
        $postData = [
            'row' => "1",
            'col' => "2",
            'value' => "6",
            'color' => "heart",
            'test' => "full deck"
        ];
        $client = static::createClient();
        $client->request('GET', '/proj');
        $client->request('POST', '/proj/square_board_post', $postData);

        $this->assertResponseRedirects('/proj/square_board_finished');
    }

    /**
     * Test /proj/square_board_finished route with testing all cards is not filled.
     */
    public function testSquareBoardFinishedCardsNotFilled(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj');
        $client->request('GET', '/proj/square_board_finished');

        $this->assertResponseIsSuccessful();
        $this->assertResponseIsSuccessful('h3', 'Amerikanska poäng:');
    }

    /**
     * Test /proj/square_board_finished route with testing all cards is filled.
     */
    public function testSquareBoardFinishedCardsFilled(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj');
        $client->request('GET', '/proj/square_board_finished?testing=true');

        $this->assertResponseIsSuccessful();
        $this->assertResponseIsSuccessful('h3', 'Engelska poäng:');
    }

    /**
     * Test /proj/api route.
     */
    public function testApi(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj');
        $client->request('GET', '/proj/api');

        $this->assertResponseIsSuccessful();
    }
}
