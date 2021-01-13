<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminControllerSecurityTest extends WebTestCase
{

    /**
     * @dataProvider getUrlsForRegularUsers
     */

    public function testAccessDeniedForRegularUser(string $httpMethod, string $url)
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER' => 'sh3rkan2121@yahoo.com',
            'PHP_AUTH_PW' => 'parola111',
        ]);
        $client->request($httpMethod, $url);
        $this->assertEquals(Response::HTTP_FORBIDDEN, $client->getResponse()->getStatusCode());
    }

    public function getUrlsForRegularUsers() 
    {
        yield ['GET', '/admin/su/categories'];
        yield ['GET', '/admin/su/edit-category/2'];
        yield ['GET', '/admin/su/users'];
        yield ['GET', '/admin/su/delete-category/2'];
        yield ['GET', '/admin/su/upload_video'];
    }

    public function testAdminSu()

    {
        $client = static::createClient([],[
            'PHP_AUTH_USER' => 'sh3rkan21@yahoo.com',
            'PHP_AUTH_PW' => 'parola111',
        ]);

        $crawler = $client->request('GET', '/admin/su/categories');
        $this->assertEquals('Categories list', $crawler->filter('h2')->text());
    }


}
