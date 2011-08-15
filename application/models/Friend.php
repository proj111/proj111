<?php

class Application_Model_Friend
{
    
    protected $_FKUserId;
    protected $_name;
    protected $_dateCreated;
    protected $_friendId;
    
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
    
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid friend property');
        }
        $this->$method($value);
    }
    
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid friend property');
        }
        return $this->$method();
    }
    
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    public function setFKUserId($id)
    {
        $this->_FKUserId = (int) $id;
        return $this;
    }
    
    public function getFKUserId()
    {
        return $this->_FKUserId;
    }
    
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }
    
    public function getName()
    {
        return $this->_name;
    }
    
    public function setDateCreated($ts)
    {
        $this->_dateCreated = $ts;
        return $this;
    }
    
    public function getDateCreated()
    {
        return $this->_dateCreated;
    }
    
    public function setFriendId($id)
    {
        $this->_friendId = (int) $id;
        return $this;
    }
    
    public function getFriendId()
    {
        return $this->_friendId;
    }

}

