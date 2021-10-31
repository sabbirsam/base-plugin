<?php
/**
 * @package  base-based-filter
 */

class Basedeactivate{

    public static function deactivate(){ //make it static so I can call it direct 
        flush_rewrite_rules();
    }
}

