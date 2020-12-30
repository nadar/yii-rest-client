<?php

namespace Nadar\YiiRestClient;

use Yii;
use yii\base\Component;
use luya\headless\base\AfterRequestEvent;
use luya\headless\base\BeforeRequestEvent;
use luya\headless\Client;

/**
 * Api Component
 * 
 * The API Component contains the server and token informations which then can be used in ActiveEndpoints.
 * 
 * Configuration
 * 
 * ```php
 * 'components' => [
 *     'api' => [
 *         'class' => 'Nadar\YiiRestClient\Api',
 *         'server' => 'https://myapi.com',
 *         'accessToken' => '...',
 *     ]
 * ]
 * ```
 * 
 * Example Request
 * 
 * ```php
 * MyTestEndpoint::find()->all(Yii::$app->api-client);
 * ```
 * 
 * @property Client $client
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class Api extends Component
{
    /**
     * @var string The server URL which contains the REST API. f.e. `https://luya.io`
     */
    public $server;

    /**
     * @var string A prefix which will be added to the server url when endpoitName is `{{%my-endpoint-name}}`, example would be `v1/`. When working
     * with LUYA admin APIs the endpointPrefix would be `admin/`.
     */
    public $endpointPrefix;

    /**
     * @var string The access token to authenticate on the server. It will be taken as Bearer Token in the Header
     */
    public $accessToken;

    /**
     * @var Client
     */
    private $_client;

    /**
     * @return Client
     */
    public function getClient()
    {
        if ($this->_client === null) {
            $this->_client = new Client($this->accessToken, $this->server);
            $this->_client->endpointPrefix = $this->endpointPrefix;
            
        }

        if (YII_DEBUG) {
            $this->_client->setBeforeRequestEvent(function(BeforeRequestEvent $e) {
                Yii::debug($e->url, __METHOD__);
            });

            $this->_client->setAfterRequestEvent(function(AfterRequestEvent $e) {
                Yii::debug($e->statusCode . ': ' . $e->content, __METHOD__);
            });
        }

        return $this->_client;
    }
}
