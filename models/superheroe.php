<?php

class Superheroe{
    private $name;
    private $species;
    private $gender;

    public function __construct($name, $species, $gender)
    {
        $this->name = $name;
        $this->species = $species;
        $this->gender = $gender;
    }

    //Setters and getters
    public function setName($name){
        $this->name = $name;
    }

    public function setSpecies($species){
        $this->species = $species;
    }

    public function setGender($gender){
        $this->gender = $gender;
    }

    public function getName(){
        return $this->name;
    }

    public function getSpecies(){
        return $this->species;
    }

    public function getGender(){
        return $this->gender;
    }

    public function getAll(){
        
    }


}