<?php

namespace Nadar\YiiRestClient\Tests;

use luya\headless\Client;
use luya\testsuite\cases\WebApplicationTestCase;
use Nadar\YiiRestClient\Api;

class ApiTest extends WebApplicationTestCase
{
    public function getConfigArray()
    {
        return [
           'id' => 'apitest',
           'basePath' => dirname(__DIR__),
        ];
    }   

    public function testComponent()
    {
        $api = new Api();
        $api->server = 'localhost';
        $api->accessToken = 'foo';

        $this->assertInstanceOf(Client::class, $api->getClient());
    }
}