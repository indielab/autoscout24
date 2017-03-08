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
        
        $this->assertSame(1, $iteration->currentPage);
        $this->assertSame(25, $iteration->currentPageResultCount);
        $this->assertSame(2, $iteration->totalPages);
        $this->assertSame(40, $iteration->totalResultCount);
    }
    
    public function testFindAllVehicles()
    {
        $query = new VehicleQuery();
        $query->setClient($this->client);
        $iteration = $query->findAll();
        
        foreach ($iteration as $i => $car) {
            echo $i . " => " .$car->getTypeNameFull() . PHP_EOL;
        }
    }
}
