<?php

namespace Indielab\AutoScout24;

use Curl\Curl;

class Client
{
    public $cuid;
    
    public $member;
    
    const API_URL = 'https://www.autoscout24.ch/api/hci/v3/json/';
    
    public function __construct($cuid, $member)
    {
        $this->cuid = $cuid;
        $this->member = $member;
    }
    
    public function endpointResponse($name, array $args = [])
    {
        $curl = new Curl();
        $curl->get(self::API_URL . $name, array_merge($args, ['cuid' => $this->cuid, 'member' => $this->member]));
        
        if (!$curl->error) {
            return $this->decodeResponse($curl->response);
        }
        
        throw new Exception("Invalid API Request: " . $curl->error_message);
    }
    
    public function decodeResponse($response)
    {
        return json_decode($response, true);
    }
}
