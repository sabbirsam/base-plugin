<?php
/**
 * @package  base-based-filter
 */

class CPT extends Base{
    function register(){
        $this->create_post_type();
    }
    
}

$cpt = new CPT();
$cpt->register();
