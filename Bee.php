<?php 

abstract class Bee {

    protected $healthPoint;
    protected $isDead;

    function __construct($healthPoint){
        $this->healthPoint = $healthPoint;
        $this->isDead = false;
    }

    public abstract function getDamage();

    public function attacked($damage) {
        $this->healthPoint -= $damage;
        if($this->healthPoint <= 0){
            $this->healthPoint = 0;
            $this->isDead = true;
        }
        return $this->isDead;
    }


    public function getHealthPoint(){
        return $this->healthPoint;
    } 

 
}