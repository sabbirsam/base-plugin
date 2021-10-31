<?php
/**
 * @package  base-based-filter
 */

class BaseActivate{

    public static function activate(){ //make it static so I can call it direct on a function

        flush_rewrite_rules();
    }
}
