<?php
    //Restart variables to default
    $_SESSION = null;
    $n_players = 1;
    $num_lives = 5;
    $player_list = '';

?>

<form action="<?=base_url?>main/hangman" method="POST">
    <div class="row">
        <div class="col-md-6" style="text-align: right;">
            <label for="n_players" class="col-md-12 float-right">Nº PLAYERS</label>
            <label for="player_name" class="col-md-12 float-right">PLAYERS NAME</label>
            <label for="num_lives" class="col-md-12 float-right">NUMBER OF LIVES</label>
        </div>
        <div class="col-md-6" style="text-align: left;">
            <input type="number" id="n_players" name="n_players" required class="col-md-4" value="<?=$n_players?>" min="1"/>
                <div class="row" style="margin-top:15px">
                    <input type="text" id="player_name" name="player_name" class="col-md-4"/>
                    <div class="col-md-1"></div>
                    <input class="col-md-3" type="button" value="ADD PLAYER" onclick="add_player()"/>
                    <input hidden type="text" id="player_list" name="player_list" value="<?=$player_list?>"/>
                </div>
                <input type="number" id="num_lives" name="num_lives" required class="col-md-4" style="margin-top: 15px" value="<?=$num_lives?>" min="1"/>
        </div>
    </div>
    <input  class="mx-auto" type="submit" value="START GAME"/>
    <div class="row">
        <div id="players_box" class="mx-auto">
            <h3 id="players_names"><strong>PLAYERS: </strong></h3>
        </div>
    </div>
</form>

<script>
    var n_players = 0;

    //Function to add multiplayer game
    function add_player(){
        player = document.forms[0].elements["player_name"].value;
        //Check if they want to add a player without specifing name
        if(player != ''){
            player_list = document.forms[0].elements["player_list"].value;
            
            //Check if there were players in the list
            if(player_list != ''){
                player_list += ";" + player;
            }
            else{
                player_list = player;
            }
            n_players++;
            //Check if number of players is the same as players specified
            if(n_players > document.forms[0].elements['n_players'].value){
                document.forms[0].elements['n_players'].value = n_players;
            }

            //Update document values
            document.forms[0].elements["player_list"].value = player_list;
            document.forms[0].elements['player_name'].value = '';
            document.getElementById('players_names').innerHTML += player + ',&nbsp;'
        }

    }

</script>


