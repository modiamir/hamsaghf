<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MediaControllerTest extends WebTestCase
{
    public function testUpload()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/media/upload');
    }

}
