<?php

abstract class IHashCodeProvider {
    public function getHashCode() {
        return spl_object_hash($this);
    }
}

class HashMap implements ArrayAccess {
    private $_map;
    private $_keys; // save keys for keys()

    public function __construct() {
        $this->_map = [];
        $this->_keys = [];
    }

    public function offsetExists($offset) {
        return array_key_exists($this->_map, $this->hash($offset));
    }

    public function offsetGet($offset) {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value) {
        return $this->put($offset, $value);
    }

    public function offsetUnset($offset) {
        $hash = $this->hash($offset);

        unset($this->_map[$hash]);
        unset($this->_keys[$offset]);
    }

    public function get($key) {
        return $this->_map[$this->hash($key)];
    }

    public function put($key, $value) {
        $hash = $this->hash($key);

        $this->_map[$hash] = $value;
        $this->_keys[$hash] = $key;

        return $this;
    }

    public function keys() {
        return array_values($this->_keys);
    }

    public function values() {
        return array_values($this->_map);
    }

    private function hash($key) {
        if (is_object($key)) {
            return $key instanceof IHashCodeProvider ? $key->getHashCode() : spl_object_hash($key);
        }

        return $key;
    }
}