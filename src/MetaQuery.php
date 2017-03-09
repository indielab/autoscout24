<?php

namespace Indielab\AutoScout24;

use Indielab\AutoScout24\Base\Query;

class MetaQuery extends Query
{
    /**
     * Find PKWs.
     *
     * @return \Indielab\AutoScout24\MetaQueryIterator
     */
    public function findPkw()
    {
        $data = $this->getClient()->endpointResponse('metadata/vehicletypes/10/parameters');
        
        return $this->createIterator($data);
    }
    
    /**
     * Find Nutzfahrzeuge.
     *
     * @return \Indielab\AutoScout24\MetaQueryIterator
     */
    public function findNfz()
    {
        $data = $this->getClient()->endpointResponse('metadata/vehicletypes/20/parameters');
        
        return $this->createIterator($data);
    }
    
    /**
     * Find LKWs.
     *
     * @return \Indielab\AutoScout24\MetaQueryIterator
     */
    public function findLkw()
    {
        $data = $this->getClient()->endpointResponse('metadata/vehicletypes/30/parameters');
        
        return $this->createIterator($data);
    }
    
    /**
     * Find Bikes.
     *
     * @return \Indielab\AutoScout24\MetaQueryIterator
     */
    public function findBike()
    {
        $data = $this->getClient()->endpointResponse('metadata/vehicletypes/60/parameters');
        
        return $this->createIterator($data);
    }
    
    /**
     * Find Campers.
     *
     * @return \Indielab\AutoScout24\MetaQueryIterator
     */
    public function findCamper()
    {
        $data = $this->getClient()->endpointResponse('metadata/vehicletypes/70/parameters');
        
        return $this->createIterator($data);
    }
    
    /**
     * Find Anhänger/Trailer.
     *
     * @return \Indielab\AutoScout24\MetaQueryIterator
     */
    public function findTrailer()
    {
        $data = $this->getClient()->endpointResponse('metadata/vehicletypes/80/parameters');
    
        return $this->createIterator($data);
    }
    
    private function createIterator(array $data)
    {
        return new MetaQueryIterator($data);
    }
}
