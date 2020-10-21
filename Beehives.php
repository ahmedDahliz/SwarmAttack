<?php
include 'Queen.php';
include 'Worker.php';
include 'Warrior.php';

class Beehives {
    private $name;
    public $queen;
    public $workers = [];
    public $warriors;

    function __construct($name){
        $this->name = $name;
        $this->queen = new Queen(50);
        for($i = 0; $i < mt_rand(15, 20); $i++){
            $this->workers[] = new Worker(5);
        }
        for($i = 0; $i < mt_rand(10, 15); $i++){
            $this->warriors[] = new Warrior(10);
        }
    }

    public function getName(){
        return $this->name;
    }

    public function getHit($damage){
        switch (mt_rand(1, 3)) {
            case 1:
                $this->queen->attacked($damage);
                break;
    
            case 2:
                $i = mt_rand(0, (sizeof($this->workers)-1));
                $isDead = $this->workers[$i]->attacked($damage);
                if($isDead){
                    unset($this->workers[$i]);
                    $this->workers = array_values($this->workers);
                }
                
                break;

            case 3:
                $i = mt_rand(0, (sizeof($this->warriors)-1));
                $isDead = $this->warriors[$i]->attacked($damage);
                if($isDead){
                    unset($this->warriors[$i]);
                    $this->warriors = array_values($this->warriors);
                }
                break;
        }
        return [ 'isdead'=> $this->queen->isDead(), 'damage'=> $damage];
    }

    public function attack($colony){
        switch (mt_rand(1, 3)) {
            case 1:
                $attackData = $colony->getHit($this->queen->getDamage());
                $attackData['message'] = 'A queen bee from '.$this->name.' caused a '.$attackData['damage'].' damage to a bee from '.$colony->getName();
                break;
    
            case 2:
                $i = mt_rand(0, (sizeof($this->workers)-1));
                $attackData = $colony->getHit($this->workers[$i]->getDamage());
                $attackData['message'] = 'A worker bee from '.$this->name.' caused a '.$attackData['damage'].' damages to a bee from '.$colony->getName();
                break;

            case 3:
                $i = mt_rand(0, (sizeof($this->warriors)-1));
                $attackData = $colony->getHit($this->warriors[$i]->getDamage());
                $attackData['message'] = 'A warrior bee from '.$this->name.' caused a '.$attackData['damage'].' damages to a bee from '.$colony->getName();
                break;
        }
        return $attackData;
    }
}