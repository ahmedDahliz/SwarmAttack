<?php

include_once 'Bee.php';

class Worker extends Bee {

    function __construct($healthPoint){
        parent::__construct($healthPoint);
    }

    public function getDamage(){
        return mt_rand(2, 4);
    }
}