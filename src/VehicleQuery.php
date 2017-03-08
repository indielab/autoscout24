<?php

namespace Indielab\AutoScout24;

class VehicleQuery
{
    protected $client = null;
    
    public function setClient(Client $client)
    {
        $this->client = $client;
    }
    
    private $_where = [];
    
    public function where(array $args)
    {
        foreach ($args as $key => $value) {
            $this->_where[$key] = $value;
        }
        
        return $this;
    }
    
    public function setPage($page)
    {
        return $this->where(['page' => $page]);
    }

    public function setItemsPerPage($amount)
    {
        return $this->where(['itemsPerPage' => $amount]);
    }
    
    public function setMake($makeId)
    {
        return $this->where(['make' => $makeId]);
    }
    
    public function setModel($modelId)
    {
        return $this->where(['model' => $modelId]);
    }
    
    public function getResponse()
    {
        return $this->client->endpointResponse('vehicles', $this->_where);
    }
    
    /**
     * Find pages
     * @return \Indielab\AutoScout24\VehicleQueryIterator
     */
    public function find()
    {
        $each = $this->getResponse();
        
        $iterator = new VehicleQueryIterator($each['Vehicles']);
        $iterator->currentPageResultCount = $each['ItemsOnPage'];
        $iterator->currentPage = $each['CurrentPage'];
        $iterator->totalPages = $each['TotalPages'];
        $iterator->totalResultCount = $each['TotalMatches'];
        return $iterator;
    }
    
    /**
     * Generats multiple requests in order to ignore page row limitation.
     *
     * Attention: May use lot of RAM usage and take some time to response, depending
     * on how much cars you have in your list.
     *
     * @return \Indielab\AutoScout24\VehicleQueryIterator
     */
    public function findAll()
    {
        $each = $this->client->endpointResponse('vehicles');
        
        $data = $each['Vehicles'];
        
        for ($i=2;$i<=$each['TotalPages'];$i++) {
            $query = new self();
            $query->setClient($this->client);
            $query->setPage($i);
            $r = $query->getResponse();
            
            $data = array_merge($data, $r['Vehicles']);
        }
        
        $iterator = new VehicleQueryIterator($data);
        $iterator->currentPageResultCount = $each['TotalMatches'];
        $iterator->currentPage = 1;
        $iterator->totalPages = 1;
        $iterator->totalResultCount = $each['TotalMatches'];
        return $iterator;
    }
}
