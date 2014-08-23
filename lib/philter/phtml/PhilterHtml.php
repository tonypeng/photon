<?php

abstract class PhilterHtml extends \PhilterBaseComponent {
    private static function getGlobalAttributes() {
        static $globalAttributes = null;

        if(!$globalAttributes) {
            $globalAttributes = array(
                new \PhilterAttribute('accesskey'),
                new \PhilterAttribute('class'),
                new \PhilterAttribute('contenteditable', \PhilterAttribute::ATTR_BOOL),
                new \PhilterAttribute('contextmenu'),
                new \PhilterAttribute('dir'),
                new \PhilterAttribute('draggable', \PhilterAttribute::ATTR_BOOL),
                new \PhilterAttribute('dropzone'),
                new \PhilterAttribute('hidden', \PhilterAttribute::ATTR_BOOL),
                new \PhilterAttribute('id'),
                new \PhilterAttribute('lang'),
                new \PhilterAttribute('spellcheck', \PhilterAttribute::ATTR_BOOL),
                new \PhilterAttribute('style'),
                new \PhilterAttribute('tabindex', \PhilterAttribute::ATTR_INT),
                new \PhilterAttribute('title'),
            );
        }

        return $globalAttributes;
    }

    public function render() {
        return null;
    }

    public function renderHtml($children) {
        $attrString = $this->getAttributeString();

        $output = "<{$this->getTag()}$attrString";

        if(!$this->isVoid()) {
            $output .= ">";

            foreach($children as $child) {
                $output .= $child;
            }

            $output .= "</{$this->getTag()}>";
        } else {
            $output .= " />";
        }

        return $output;
    }

    protected abstract function getTag();

    protected function isVoid() {
        return false;
    }

    protected function getHtmlAttributes() {
        return array();
    }

    protected final function getAttributeKeys() {
        return array_merge(self::getGlobalAttributes(), $this->getHtmlAttributes());
    }

    protected function getAttributeString() {
        $attributes = $this->getAttributes();

        $outString = '';

        foreach($attributes as $key => $value) {
            $outString .= ' '.$key.'="'.$value.'"';
        }

        return $outString;
    }
}