<?php

abstract class SiteController extends Controller {

    /**
     * @return array
     */
    public static function getParams() {
        return array();
    }

    public function invalid() {
        $request = $this->getRequest();

        $expects = static::getParams();
        $expects_arr = [];

        foreach($expects as $expect) {
            list($key, $props) = $expect->toArray();

            $expects_arr[$key] = $props;
        }

        $request->expect($expects_arr);

        return false;
    }

}