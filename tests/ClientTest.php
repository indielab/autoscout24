<?php 

namespace Indielab\AutoScout24\Tests;

class ClientTest extends AutoScoutTestCase
{
    public function testVehiclesEndpoint()
    {
        $r = $this->client->endpointResponse('vehicles');
        
        $this->assertTrue(is_array($r));
    }
}
