<?php

require_once "models/superheroe.php";

class mainController{

    //Default function to load index.php
    public function index(){
        require_once "views/home.php";
    }

    //Function to load game hangman specifing the mainController and action hangman 
    public function hangman(){
        //Check if there is data
        if(isset($_POST)){

            //Check variables and initializa $_SESSION
            $model = new Superheroe();
            $superheroe = $model->getRandom();
            $_SESSION['superheroe'] = $superheroe;
            
            if(isset($_POST['n_players'])){
                $n_players = $_POST['n_players'];
                $_SESSION['n_players'] = $n_players;
            }else{
                $n_players = 1;
                $_SESSION['n_players'] = 1;
            }

            if(isset($_POST['num_lives'])){
                $_SESSION['num_lives'] = $_POST['num_lives'];
            }else{
                $_SESSION['num_lives'] = 10;
            }

            if(isset($_POST['player_list'])){
                $_SESSION['player_list_raw'] =$_POST['player_list']; 

                // Check if they have specified enough players, 
                // else initialize enough players or cut if too much players
                if($_POST['player_list'] != ''){
                    $_SESSION['player_list'] = array_slice(explode(';', $_POST['player_list']), 0, $n_players);
                    if(count($_SESSION['player_list']) < $n_players){
                        for($i=count($_SESSION['player_list']); $i < $n_players; $i++){
                            array_push($_SESSION['player_list'], 'default '.$i);
                        }
                    }
                }
                else{
                    $_SESSION['player_list'] = [];
                    for($i=0; $i< $n_players; $i++){
                        array_push($_SESSION['player_list'], 'default '.$i);
                    }
                }
            }else{
                $_SESSION['player_list'] = [];
                for($i=0; $i< $n_players; $i++){
                    array_push($_SESSION['player_list'], 'default '.$i);
                }
            }
            
            require_once('views/game.php');
        }else{
            require_once('views/home.php');
        }
    }
}