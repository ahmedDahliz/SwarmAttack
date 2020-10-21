<?php

include_once 'Bee.php';

class Worker extends Bee {

    function __construct($healthPoint){
        parent::__construct($healthPoint);
    }

    public function getDamage(){
        //return a damage between 2 and 4 randomly
        return mt_rand(2, 4);
    }
}