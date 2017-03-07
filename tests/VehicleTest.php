<?php

namespace Indielab\AutoScout24\Tests;

use Indielab\AutoScout24\VehicleQuery;

class VehicleTest extends AutoScoutTestCase
{
	public function testQueryVehicles()
	{
		$query = new VehicleQuery();
		$query->setClient($this->client);
		
		$iteration = $query->find();
		$this->assertInstanceOf('Indielab\AutoScout24\VehicleQueryIterator', $iteration);
		
		foreach ($iteration as $item) {
			
			echo $item->getMakeText();
			
			break;
		}
	}
}