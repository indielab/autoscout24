<?php

namespace Indielab\AutoScout24\Base;

use Indielab\AutoScout24\Client;

abstract class Query
{
    private $_client = null;
    
    /**
     *
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->_client = $client;
        
        return $this;
    }
    
    public function getClient()
    {
        return $this->_client;
    }
}