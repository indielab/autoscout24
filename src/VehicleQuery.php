<?php

namespace Indielab\AutoScout24;

/**
 * Vehicle Query Class.
 * 
 * @author Basil Suter <basil@nadar.io>
 */
class VehicleQuery
{
    protected $client = null;
    
    /**
     * 
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }
    
    private $_where = [];
    
    /**
     * 
     * @param array $args
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function where(array $args)
    {
        foreach ($args as $key => $value) {
            $this->_where[$key] = $value;
        }
        
        return $this;
    }
    
    /**
     * 
     * @param integer $typeId Integer values with types, avialable list:
     * - 10: Personenwagen
     * - 20: Leichte Nutzfahrzeuge
     * 
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setVehicleTypeId($typeId)
    {
        return $this->where(['vehtyp' => $typeId]);
    }
    
    /**
     * 
     * @param string $type Sort parameter to set, available list:
     * - price_asc: Sort price ascending
     * - price_desc: Sort price descending
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setVehicleSorting($type)
    {
        return $this->where(['sort' => $type]);
    }
    
    /**
     * 
     * @param Integer $year Year from
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setYearTo($year)
    {
        return $this->where(['yearto' => $year]);
    }
    
    /**
     * 
     * @param integer $equipmentId Equipment Paramters like: 10 = Klimatisierung.
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setEquipment($equipmentId)
    {
        return $this->where(['equipor' => $equipmentId]);
    }
    
    /**
     * 
     * @param unknown $page
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setPage($page)
    {
        return $this->where(['page' => $page]);
    }

    /**
     * 
     * @param unknown $amount
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setItemsPerPage($amount)
    {
        return $this->where(['itemsPerPage' => $amount]);
    }
    
    /**
     * 
     * @param unknown $makeId
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setMake($makeId)
    {
        return $this->where(['make' => $makeId]);
    }
    
    /**
     * 
     * @param unknown $modelId
     * @return \Indielab\AutoScout24\VehicleQuery
     */
    public function setModel($modelId)
    {
        return $this->where(['model' => $modelId]);
    }
    
    /**
     * 
     * @return mixed
     */
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
            $query->where($this->_where);
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
    
    /**
     * 
     * @param integer $id The id of the vehicle
     * @return \Indielab\AutoScout24\Vehicle
     */
    public function findOne($id)
    {
        $response = $this->client->endpointResponse('vehicles/'.$id);
        
        return (new Vehicle($response));
    }
}
