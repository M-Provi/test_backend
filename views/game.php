<?php
    //Get variables from $_SESSION
    $n_players = $_SESSION['n_players'];
    $players_list = $_SESSION['player_list'];
    $players_list_raw = $_SESSION['player_list_raw'];
    $superheroe = $_SESSION['superheroe']['name'];
    $num_lives = $_SESSION['num_lives'];
?>
<h1 class="row col-md-12" id="player_turn"><strong>PLAYERS TURN: </strong></h1>
<h1 id="lives"></h1>

<!--Basic information during game development-->
<div id="game">
    <div class="row">
        <h1 id="hold" class="mx-auto"></h1>
    </div>
    
    <div class="row">
        <div class="mx-auto guess">
            <input id="guess" type="text" required  maxlength="1" autofocus/>
            <input id="button_check" type="button" value="CHECK" onclick="check()"/>
        </div>
    </div>
    <div class="row">
        <div id="guesses" class="mx-auto">
            <h1 id="guessed_letters"><strong>Used letters:</strong> </h1>
        </div>
    </div>
</div>

<!--Hidden information to show when game ends-->
<div id="end_game" hidden>
        <div class="row">
            <div class="mx-auto">
                <h1 id="win_text"></h1>
            </div>
        </div>
        <div class="row">
            <img class="mx-auto" id="win_image" src="<?=base_url?>assets/img/AngryHulk.png"/>
        </div>
        <div class="row">
            <h1 class="mx-auto" id="win_superheroe"></h1>
        </div>
        <div class="row">
            <div class="row mx-auto">
                <form  action="<?= base_url ?>main/hangman" method="POST">
                    <input type="submit" value="PLAY AGAIN"/>
                    <!--We will reuse the same parameters to call mainController/hangman-->
                    <input hidden name="player_list" type="text" value="<?=$players_list_raw?>"/>
                    <input hidden name="num_lives" type="number" value="<?=$num_lives?>"/>
                    <input hidden name="n_players" type="number" value="<?=$n_players?>"/>
                </form>
                <form action="<?= base_url ?>" method="POST">
                    <input type="submit" value="NEW GAME"/>
                </form>
            </div>
        </div>
</div>

<script>
var word = '<?=$superheroe?>';
var lives = '<?=$num_lives?>';
var guessword;
var player_list = <?=json_encode($players_list)?>;
var player_turn = 0;
var n_players = <?=$n_players?>;

//Function to transform the superhero word to hangman word
function write_guessword(){
    var aux = '';
    document.getElementById('hold').innerHTML = '';
    for(i=0; i<guessword.length;i++){
        if(guessword[i] == ' '){
            document.getElementById('hold').innerHTML += (guessword[i]+'&nbsp;&nbsp;&nbsp;');
        }else{
            document.getElementById('hold').innerHTML += (guessword[i]+'&nbsp;');
        }
    }
    
}

//On page load we will update some information
window.onload = function(){
    console.log(player_list);
    console.log(word);
    var guess = function(){
        guessword = '';
        for(i=0; i< word.length; i++){
            
            if(/[a-zA-Z]/.test(word[i])){
                guessword += '_';
            }else{
                guessword += word[i];
            }
        }
    }
    guess();
    write_guessword();
    document.getElementById('player_turn').innerHTML = "<strong>PLAYERS TURN:&nbsp;&nbsp;</strong>"+player_list[player_turn];
    document.getElementById('lives').innerHTML = "<strong>Number of lives:</strong> "+lives;

}

//Function to change_player
function change_player(){
    
    if(player_turn >= n_players - 1){
        player_turn = 0;
    }else{
        player_turn++;
    }
    console.log("Turn: "+player_list[player_turn]);
    document.getElementById('player_turn').innerHTML = "<strong>PLAYERS TURN: </strong>"+player_list[player_turn];
}

//Function to check if correct word, update information, change player and check end of the game
function check(){
    var letter = document.getElementById('guess').value;
    document.getElementById('guess').value = '';

    //Check if the input is a letter with regexp
    if(letter != '' && /[a-zA-Z]/.test(letter)){
        var find = false;
        var aux = '';

        //Check all word to match the letter
        for(i=0; i<word.length; i++){
            if(word[i].toLowerCase() == letter.toLowerCase()){
                find = true;
                aux += word[i];
            }else{
                aux += guessword.charAt(i);
            }
        }

        //Add letter to used letters
        document.getElementById('guessed_letters').innerHTML += (letter.toUpperCase() + "&nbsp;&nbsp;");

        //Check if correct or fail
        if(find){
            guessword = aux;
            write_guessword();
        }
        else{
            lives -= 1;
            document.getElementById('lives').innerHTML = "<strong>Number of lives:</strong> "+lives;

            //Don't change player when the player loses game
            if(lives != 0){
                change_player();
            }
        }

        //Check if game has been lost and update information with JS
        if(lives == 0){
            console.log('LOSER');
            document.getElementById('button_check').disabled = true;
            document.getElementById('win_text').innerHTML = "<strong>LOSER</strong>";
            document.getElementById('win_image').src = '<?=base_url?>assets/img/AngryHulk.png';
            document.getElementById('win_superheroe').innerHTML = '<strong>SUPERHERO:</strong> <?=$superheroe?>';
            document.getElementById('game').hidden = true;
            document.getElementById('end_game').hidden = false;
        }

        //Check if the game has been won and update information with JS
        if(word.toLowerCase().localeCompare(guessword.toLowerCase()) == 0){
            console.log('WINNER');
            document.getElementById('win_text').innerHTML = "<strong>WINNER</strong>";
            document.getElementById('win_image').src = '<?=base_url?>assets/img/superhero2.png';
            document.getElementById('win_superheroe').innerHTML = '<strong>SUPERHERO:</strong> <?=$superheroe?>';
            document.getElementById('game').hidden = true;
            document.getElementById('end_game').hidden = false;
        }
    }
}
</script>