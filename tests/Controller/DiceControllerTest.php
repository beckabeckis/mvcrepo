<?php

namespace App\Test\Controller;

use App\Controller\DiceController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DiceeControllerTest extends WebTestCase
{
    /**
     * Test /game/pig route.
     */
    public function testHome(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('GET', '/game/pig');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/pig/test/roll route.
     */
    public function testRollDice(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('GET', '/game/pig/test/roll');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/pig/test/roll/{num} route.
     */
    public function testTestRollDices(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('GET', '/game/pig/test/roll/10');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/pig/test/roll/{num} route with to many dices.
     */
    public function testRollDicesTooMany(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('GET', '/game/pig/test/roll/100');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/pig/test/dicehand/{num} route.
     */
    public function testTestDiceHand(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('GET', '/game/pig/test/dicehand/10');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/pig/init route.
     */
    public function testInit(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('GET', '/game/pig/init');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/pig/init post route.
     */
    public function testInitPost(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('POST', '/game/pig/init', [
            'num_dices' => 11,
        ]);

        $this->assertResponseRedirects('/game/pig/play');
    }

    /**
     * Test /game/pig/play route.
     */
    public function testPlay(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('POST', '/game/pig/init', [
            'num_dices' => 11,
        ]);
        $client->request('GET', '/game/pig/play');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Test /game/pig/roll route.
     */
    public function testRoll(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('POST', '/game/pig/init', [
            'num_dices' => 11,
        ]);
        $client->request('POST', '/game/pig/roll');

        $this->assertResponseRedirects('/game/pig/play');
    }

    /**
     * Test /game/pig/save route.
     */
    public function testSave(): void
    {
        if (isset($_ENV['SCRUTINIZER'])) {
            $this->markTestSkipped(
                'Scrutinizer CI build'
            );
        }
        $client = static::createClient();
        $client->request('POST', '/game/pig/init', [
            'num_dices' => 11,
        ]);
        $client->request('POST', '/game/pig/save');

        $this->assertResponseRedirects('/game/pig/play');
    }
}
