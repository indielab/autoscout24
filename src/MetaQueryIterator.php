<?php

namespace Indielab\AutoScout24;

/**
 * Meta Query Iterator.
 * 
 * @method \Indielab\AutoScout24\Meta lng()
 * @method \Indielab\AutoScout24\Meta page();
 * @method \Indielab\AutoScout24\Meta itemsPerPage()
 * @method \Indielab\AutoScout24\Meta vehtyp()
 * @method \Indielab\AutoScout24\Meta sort()
 * @method \Indielab\AutoScout24\Meta makefull()
 * @method \Indielab\AutoScout24\Meta modelfull()
 * @method \Indielab\AutoScout24\Meta make()
 * @method \Indielab\AutoScout24\Meta model()
 * @method \Indielab\AutoScout24\Meta typename()
 * @method \Indielab\AutoScout24\Meta body()
 * @method \Indielab\AutoScout24\Meta fuel()
 * @method \Indielab\AutoScout24\Meta trans()
 * @method \Indielab\AutoScout24\Meta drive()
 * @method \Indielab\AutoScout24\Meta polnorm()
 * @method \Indielab\AutoScout24\Meta liccat()
 * @method \Indielab\AutoScout24\Meta consrat()
 * @method \Indielab\AutoScout24\Meta cond()
 * @method \Indielab\AutoScout24\Meta bodycol()
 * @method \Indielab\AutoScout24\Meta intcol()
 * @method \Indielab\AutoScout24\Meta tshaft()
 * @method \Indielab\AutoScout24\Meta seg()
 * @method \Indielab\AutoScout24\Meta equip()
 * @method \Indielab\AutoScout24\Meta equipor()
 * @method \Indielab\AutoScout24\Meta prop()
 * @method \Indielab\AutoScout24\Meta extras()
 * @method \Indielab\AutoScout24\Meta yearfrom()
 * @method \Indielab\AutoScout24\Meta yearto()
 * @method \Indielab\AutoScout24\Meta kmfrom()
 * @method \Indielab\AutoScout24\Meta kmto()
 * @method \Indielab\AutoScout24\Meta seatsfrom()
 * @method \Indielab\AutoScout24\Meta seatsto()
 * @method \Indielab\AutoScout24\Meta doorsfrom()
 * @method \Indielab\AutoScout24\Meta doorsto()
 * @method \Indielab\AutoScout24\Meta pricefrom()
 * @method \Indielab\AutoScout24\Meta priceto()
 * @method \Indielab\AutoScout24\Meta ccmfrom()
 * @method \Indielab\AutoScout24\Meta ccmto()
 * @method \Indielab\AutoScout24\Meta co2emitfrom()
 * @method \Indielab\AutoScout24\Meta co2mitto()
 * @method \Indielab\AutoScout24\Meta consfrom()
 * @method \Indielab\AutoScout24\Meta consto()
 * @method \Indielab\AutoScout24\Meta hpfrom()
 * @method \Indielab\AutoScout24\Meta hpto()
 * @method \Indielab\AutoScout24\Meta rad()
 * @method \Indielab\AutoScout24\Meta loc()
 * @method \Indielab\AutoScout24\Meta age()
 * @method \Indielab\AutoScout24\Meta onlytoorder()
 * @method \Indielab\AutoScout24\Meta includetoorder()
 * @method \Indielab\AutoScout24\Meta hasimage()
 * @method \Indielab\AutoScout24\Meta logo()
 * 
 * @author Basil Suter <basil@nadar.io>
 */
class MetaQueryIterator implements \Iterator
{
    private $_data = null;
    
    public function __construct(array $data)
    {
        $this->_data = $data;
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
        return new Meta(current($this->_data));
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
    
    /**
     * Filters the query iterator by one item and returns the Object.
     * 
     * @param string $varName
     * @return \Indielab\AutoScout24\Meta
     */
    public function filter($varName)
    {
        $key = array_search($varName, array_column($this->_data, 'ParameterName'));
        
        return new Meta($this->_data[$key]);
    }
    
    /**
     * 
     * @param unknown $name
     * @param unknown $args
     * @return \Indielab\AutoScout24\Meta
     */
    public function __call($name, $args)
    {
        return $this->filter($name);
    }
}