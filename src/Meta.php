<?php

namespace Indielab\AutoScout24;

class Meta
{
    private $_data = null;
    
    public function __construct(array $data)
    {
        $this->_data = $data;
    }
    
    /**
     * @return string i.e. `logo`
     */
    public function getParameterName()
    {
        return $this->_data['ParameterName'];
    }
    
    /**
     * @return string i.e `Qualilogo`
     */
    public function getDescription()
    {
        return $this->_data['Description'];
    }
    
    /**
     * @return string i.e. `Integer`
     */
    public function getValueType()
    {
        return $this->_data['ValueType'];
    }
    
    /**
     * @return boolean i.e. `false`
     */
    public function getAcceptsCustomValues()
    {
        return $this->_data['AcceptsCustomValues'];
    }
    
    public function getCustomValuesBounds()
    {
        return $this->_data['CustomValuesBounds'];
    }
    
    public function getFilterParameterNames()
    {
        return $this->_data['FilterParameterNames'];
    }
    
    /**
     * @return array Optinal Data
     */
    public function getOptions()
    {
        return $this->_data['Options'];
    }
}