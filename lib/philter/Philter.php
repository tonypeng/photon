<?php

class Philter {
    public static function render(PhilterBaseComponent $root) {
        // keep re-rendering $root until we get to a non-simplifiable element
        while(!($root instanceof PhilterHtml)) {
            $root = $root->render();
        }

        // now our $root is simplified

        // render children
        $children = array();

        foreach ($root->getChildren() as $child) {
            $children[] = self::render($child);
        }

        return $root->renderHtml($children);
    }
}