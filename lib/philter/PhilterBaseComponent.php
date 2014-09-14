<?php

abstract class PhilterBaseComponent
{
    private static $_attrCache = array();

    private $_attributes;
    private $_children;

    public function __construct($args)
    {
        $attributes = array();
        $children = array();

        if($args) {
            $attributes = array_shift($args);
        }

        if(!isset(self::$_attrCache[get_class($this)])) {
            self::createAttributeCache(get_class($this), $this->getAttributeKeys());
        }

        $this->validateAttributes($attributes);

        foreach ($args as $child) {
            if(is_array($child)) {
                foreach($child as $subchild) {
                    if(!($subchild instanceof PhilterBaseComponent)) {
                        throw new PhilterException('Invalid child passed to ' . get_class($this) . '.');
                    }

                    $children[] = $subchild;
                }
            } else {
                if(!$child instanceof PhilterBaseComponent) {
                    if (is_string($child)) {
                        $children[] = new html_string($child);
                    } else {
                        throw new PhilterException('Invalid child passed to ' . get_class($this) . '.');
                    }
                } else {
                    $children[] = $child;
                }
            }
        }

        $this->_attributes = $attributes;
        $this->_children = $children;
    }

    public function getChildren()
    {
        return $this->_children;
    }

    public function hasAttribute($attr)
    {
        return isset(self::$_attrCache[get_class($this)]['key_to_attr'][$attr]);
    }

    public abstract function render();

    public function __toString()
    {
        return Philter::render($this);
    }

    protected function getAttributes()
    {
        return $this->_attributes;
    }

    /* TODO: attribute validation is done kind of sketchily right now...rethink this later */

    private function validateAttributes($attributes)
    {
        static $bools = array('true', 'false');

        foreach($attributes as $attr => $val) {
            if(!$this->hasAttribute($attr)) {
                throw new PhilterException("Invalid attribute $attr passed to " . get_class($this) . ".");
            }

            $philter_attr = self::$_attrCache[get_class($this)]['key_to_attr'][$attr];

            switch($philter_attr->getType()) {
                case PhilterAttribute::ATTR_INT:
                    if(!ctype_digit($val)) {
                        throw new PhilterException("Invalid attribute $attr passed to " . get_class($this) . ".  Expected: {$philter_attr->getType()}");
                    }
                    break;
                case PhilterAttribute::ATTR_STR:
                    break;
                case PhilterAttribute::ATTR_NUM:
                    if(!is_numeric($val)) {
                        throw new PhilterException("Invalid attribute $attr passed to " . get_class($this) . ".  Expected: {$philter_attr->getType()}");
                    }
                    break;
                case PhilterAttribute::ATTR_BOOL:
                    if(!in_array(mb_strtolower($val), $bools)) {
                        throw new PhilterException("Invalid attribute $attr passed to " . get_class($this) . ".  Expected: {$philter_attr->getType()}");
                    }
                    break;
            }
        }
        foreach(self::$_attrCache[get_class($this)]['req_keys'] as $attr) {
            if(!isset($attributes[$attr])) {
                throw new PhilterException("Expected required attribute $attr in " . get_class($this) . ".");
            }
        }
    }

    protected function getAttributeKeys()
    {
        return array();
    }

    private static function createAttributeCache($class, array $attributes)
    {
        self::$_attrCache[$class]['key_to_attr'] = array();
        self::$_attrCache[$class]['req_keys'] = array();

        foreach($attributes as $attr) {
            self::$_attrCache[$class]['key_to_attr'][$attr->getName()] = $attr;

            if($attr->isRequired()) {
                self::$_attrCache[$class]['req_keys'][] = $attr->getName();
            }
        }
    }
}

class PhilterAttribute
{
    const ATTR_INT = 'int';
    const ATTR_STR = 'string';
    const ATTR_NUM = 'number';
    const ATTR_BOOL = 'bool';

    private $_name;
    private $_type;
    private $_required;

    public function __construct($name, $type=self::ATTR_STR, $required=false)
    {
        $this->_name = $name;
        $this->_type = $type;
        $this->_required = $required;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function isRequired()
    {
        return $this->_required;
    }
}
