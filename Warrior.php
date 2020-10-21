<?php

include_once 'Bee.php';

class Warrior extends Bee {

    function __construct($healthPoint){
        parent::__construct($healthPoint);
    }
    
    public function getDamage(){
        return mt_rand(4, 7);
    }
}