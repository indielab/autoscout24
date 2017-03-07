<?php

namespace Indielab\AutoScout24;

class VehicleQueryIterator implements \Iterator
{
	private $_data = null;
	
	public function __construct(array $data)
	{
		$this->_data = $data;
	}
	
	function rewind()
	{
		return reset($this->_data);
	}
	
	/**
	 * @return \Indielab\AutoScout24\Vehicle Returns the Vehicle Object.
	 */
	function current()
	{
		return new Vehicle(current($this->_data));
	}
	
	function key() 
	{
		return key($this->_data);
	}
	
	function next()
	{
		return next($this->_data);
	}
	
	function valid()
	{
		return key($this->_data) !== null;
	}
}