<?php

include_once 'Bee.php';

class Queen extends Bee {

    function __construct($healthPoint){
        parent::__construct($healthPoint);
    }
    public function getDamage(){
        return 1;
    }

    public function isDead(){
        return $this->isDead;
    }
}