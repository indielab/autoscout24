<?php

namespace Indielab\AutoScout24;

use Indielab\AutoScout24\Base\Query;

/**
 * Vehicle Query Class.
 *
 * @author Basil Suter <basil@nadar.io>
 */
class VehicleQuery extends Query
{
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
        return $this->getClient()->endpointResponse('vehicles', $this->_where);
    }
    
    /**
     *
     * @param array $vehicles
     * @param unknown $currentPageResultCount
     * @param unknown $currentPage
     * @param unknown $totalResultCount
     * @param unknown $totalPages
     * @return \Indielab\AutoScout24\VehicleQueryIterator
     */
    private function createIterator(array $vehicles, $currentPageResultCount, $currentPage, $totalResultCount, $totalPages)
    {
        $iterator = new VehicleQueryIterator($vehicles);
        $iterator->currentPageResultCount = $currentPageResultCount;
        $iterator->currentPage = $currentPage;
        $iterator->totalPages = $totalPages;
        $iterator->totalResultCount = $totalResultCount;
        return $iterator;
    }
    
    /**
     * Find pages
     * @return \Indielab\AutoScout24\VehicleQueryIterator
     */
    public function find()
    {
        $each = $this->getResponse();
        
        return $this->createIterator($each['Vehicles'], $each['ItemsOnPage'], $each['CurrentPage'], $each['TotalMatches'], $each['TotalPages']);
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
        $each = $this->getClient()->endpointResponse('vehicles', $this->_where);
        
        $data = $each['Vehicles'];
        
        for ($i=2;$i<=$each['TotalPages'];$i++) {
            $query = new self();
            $query->setClient($this->getClient());
            $query->setPage($i);
            $query->where($this->_where);
            $r = $query->getResponse();
            
            $data = array_merge($data, $r['Vehicles']);
        }
        
        return $this->createIterator($data, $each['TotalMatches'], 1, $each['TotalMatches'], 1);
    }
    
    /**
     *
     * @param integer $id The id of the vehicle
     * @return \Indielab\AutoScout24\Vehicle
     */
    public function findOne($id)
    {
        $response = $this->getClient()->endpointResponse('vehicles/'.$id);
        
        return (new Vehicle($response));
    }
}
