<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CatalogControllerTest extends WebTestCase
{
    public function testCatalog()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalog');
    }

    public function testCategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalog/{category}');
    }

    public function testProduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalog/{category}/{product}');
    }

}
