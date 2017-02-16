<?php

namespace TaylorNetwork\ApiModel;

use Torann\RemoteModel\Model as RemoteModel;
use TaylorNetwork\API\API;

class ApiModel extends RemoteModel
{
    /**
     * API Instance
     *
     * @var API
     */
    protected $api;

    /**
     * API Driver Class
     *
     * @var string
     */
    protected $driver;

    /**
     * @inheritdoc
     */
    protected function request($endpoint = null, $method, $params = null)
    {
        if (!empty($params))
        {
            $results = $this->getAPI()->{$this->driver}($method, $params);
        }
        else
        {
            $results = $this->getAPI()->{$this->driver}($method);
        }

        return $results ? $this->newInstance($results) : null;
    }

    /**
     * @inheritdoc
     */
    public function getAPI()
    {
        if (!isset($this->api) || !$this->api instanceof API)
        {
            $this->api = new API();
        }

        return $this->api;
    }
}