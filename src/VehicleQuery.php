<?php

namespace Indielab\AutoScout24;

class VehicleQuery
{
	protected $client = null;
	
	public function setClient(Client $client)
	{
		$this->client = $client;	
	}
	
	public function where(array $args)
	{
		
	}

	public function find()
	{
		$each = $this->client->endpointResponse('vehicles');
		
		return new VehicleQueryIterator($each['Vehicles']);
	}
}