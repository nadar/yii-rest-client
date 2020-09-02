<?php

namespace Nadar\YiiRestClient;

use luya\headless\Client;
use Yii;
use yii\base\Component;

class Api extends Component
{
    public $url;

    public $token;

    /**
     * @var Client
     */
    private $_client;

    public function getClient()
    {
        if ($this->_client === null) {
            $this->_client = new Client($this->token, $this->url);
            
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