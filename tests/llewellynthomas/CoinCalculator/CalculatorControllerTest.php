<?php

namespace Tests\llewellynthomas\CoinCalculator\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CalculatorControllerTest
 * @package Tests\llewellynthomas\CoinCalculator\Controller
 */
class CalculatorControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Applications', $crawler->filter('h1')->text());
        $this->assertContains('Coin Calculator', $crawler->filter('a')->text());
    }

    public function testCalculator()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calculator/coin');
        $this->assertContains('Coin Calculator', $crawler->filter('h1')->text());
    }
}