<?php

include_once 'Bee.php';

class Warrior extends Bee {

    function __construct($healthPoint){
        parent::__construct($healthPoint);
    }
    
    public function getDamage(){
        //return a damage between 4 and 7 randomly
        return mt_rand(4, 7);
    }
}