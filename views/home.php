<?php

    if(isset($_SESSION)){
        if (!isset($_SESSION['n_players'])){
            $n_players = 1;
        }else{
            $n_players = $_SESSION['n_players'];
        }
        $player_list = '';
    }else{
        $n_players = 1;
        $player_list = '';
    }

?>

<form action="main/hangman" method="POST">
    <div class="row">
        <div class="col-md-6" style="text-align: right;">
            <label for="n_players" class="col-md-12 float-right">Nº PLAYERS</label>
            <label for="player_name" class="col-md-12 float-right">PLAYERS NAME</label>
        </div>
        <div class="col-md-6" style="text-align: left;">
            <input type="number" id="n_players" name="n_players" required class="col-md-4" value="<?=$n_players?>" min="1"/>
                <div class="row">
                    <input type="text" id="player_name" name="player_name" class="col-md-4"/>
                    <div class="col-md-1"></div>
                    <input class="col-md-3" type="button" value="ADD PLAYER" onclick="add_player()"/>
                    <input hidden type="text" id="player_list" name="player_list" value="<?=$player_list?>"/>
                </div>
                
        </div>
    </div>
    <input  class="mx-auto" type="submit" value="START GAME"/>
</form>

<script>

    function add_player(){
        player = document.forms[0].elements["player_name"].value;
        if(player != ''){
            player_list = document.forms[0].elements["player_list"].value;
        if(player_list != ''){
            player_list += ";" + player;
        }
        else{
            player_list = player;
        }
        document.forms[0].elements["player_list"].value = player_list;
        document.forms[0].elements['player_name'].value = '';
        }

    }

</script>


