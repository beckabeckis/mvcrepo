<?php

namespace App\Test\Controller;

use App\Entity\Library;
use App\Controller\TwentyOneGameController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TwentyOneGameControllerTest extends WebTestCase
{
    /**
     * Test /game route.
     */
    public function testGame(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/doc route.
     */
    public function testDoc(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/doc');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/board route.
     */
    public function testBoard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/board');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/board_drawn route.
     */
    public function testBoardDrawn(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/board');
        $client->request('GET', '/game/board_drawn');

        $this->assertResponseIsSuccessful();
    }

    // /**
    //  * Test /game/board_drawn route when lost.
    //  */
    // public function testBoardDrawnWhenLost(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/game/board');
    //     $client->request('GET', '/game/board_drawn');
    //     $client->request('GET', '/game/board_drawn');
    //     $client->request('GET', '/game/board_drawn');
    //     $client->request('GET', '/game/board_drawn');
    //     $client->request('GET', '/game/board_drawn');

    //     $this->assertResponseRedirects('/game/board_lost');
    // }

    // /**
    //  * Test /game/board_one route.
    //  */
    // public function testBoardOne(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/game/board');
    //     $client->request('GET', '/game/board_drawn');
    //     $client->request('POST', '/game/board_one', []);

    //     $this->assertResponseRedirects('/game/board_ess');
    // }

    //  /**
    //  * Test /game/board_thirteen route.
    //  */
    // public function testBoardThirteen(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/game/board');
    //     $client->request('GET', '/game/board_drawn');
    //     $client->request('POST', '/game/board_thirteen');

    //     $this->assertResponseRedirects('/game/board_ess');
    // }

    /**
     * Test /game/board_ess route.
     */
    public function testBoardEss(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/board');
        $client->request('GET', '/game/board_ess');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/board_lost route.
     */
    public function testBoardlost(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/board');
        $client->request('GET', '/game/board_lost');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/board_end route.
     */
    public function testBoardEnd(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/board');
        $client->request('GET', '/game/board_end');

        $this->assertResponseIsSuccessful();
    }
}
