<?php

namespace TaylorNetwork\ApiModel;

use Illuminate\Database\Eloquent\Model;
use TaylorNetwork\API\API;

class ApiModel extends Model
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
    public function find($id)
    {
        $this->fill($this->getAPI()->{$this->driver}('find', [ 'id' => $id ])->decodeContent(true));
        return $this;
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