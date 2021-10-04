<?php

class Superheroe{
    private $name;
    private $species;
    private $gender;

    public function __construct(){}

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
        $file = file_get_contents(base_url.'db/superheroes.json');
        $content = json_decode($file, true);

        return $content;
    }

    public function getRandom(){
        $file = file_get_contents(base_url.'db/superheroes.json');
        $content = json_decode($file, true);
        $rand = $content[rand(0, count($content) - 1)];
        
        return $rand;
    }


}