<?php

namespace Indielab\AutoScout24\Tests;

use Indielab\AutoScout24\VehicleQuery;
use Indielab\AutoScout24\Vehicle;

class VehicleTest extends AutoScoutTestCase
{
    public function testQueryVehicles()
    {
        $query = new VehicleQuery();
        $query->setClient($this->client);
        
        $iteration = $query->find();
        $this->assertInstanceOf('Indielab\AutoScout24\VehicleQueryIterator', $iteration);
        
        
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
            //echo $i . " => " .$car->getId() . PHP_EOL;
        }
    }
    
    public function testFindOne()
    {
        $query = new VehicleQuery();
        $query->setClient($this->client);
        $car = $query->findOne(4592990);
        
        $this->assertNotNull($car);
    }
    
    public function testFindAllWithFilter()
    {
        $query = new VehicleQuery();
        $query->setClient($this->client);
        
        $cars = $query->setMake(55)->findAll();
        
        foreach ($cars as $car) {
            $this->assertSame(55, $car->getMakeId());
        }
    }
    
    public function testDateParser()
    {
        $date = '/Date(1486132651000+0100)/';
        
        $r = Vehicle::dateParser($date);
        
        $this->assertSame(1486132651, $r);
    }
    
    public function testDateCar()
    {
        $query = new VehicleQuery();
        $query->setClient($this->client);
        $car = $query->findOne(4592990);
        $this->assertSame(1486132651, $car->getDateCreated());
    }
}
