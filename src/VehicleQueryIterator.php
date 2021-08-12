<?php

namespace Indielab\AutoScout24;

use Countable;

class VehicleQueryIterator implements \Iterator, Countable
{
    private $_data = null;
    
    public function __construct(array $data)
    {
        $this->_data = $data;
    }
    
    public $totalResultCount;
    
    public $totalPages;
    
    public $currentPage;
    
    public $currentPageResultCount;
    
    public function count()
    {
        return count($this->_data);
    }

    public function rewind()
    {
        return reset($this->_data);
    }
    
    /**
     * @return \Indielab\AutoScout24\Vehicle Returns the Vehicle Object.
     */
    public function current()
    {
        return new Vehicle(current($this->_data));
    }
    
    public function key()
    {
        return key($this->_data);
    }
    
    public function next()
    {
        return next($this->_data);
    }
    
    public function valid()
    {
        return key($this->_data) !== null;
    }
}
