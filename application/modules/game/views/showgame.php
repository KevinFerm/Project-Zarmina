<?php
if($participating == true && $logged_in == true && $activematch == true) {
    echo 'Probably run the game module because everything is true and match is on!';
} elseif($participating == true && $logged_in == true && $activematch == false) {
    echo 'Game is over so show stats and stuff maybe??';
} elseif($participating == false && $logged_in == true){
    echo "LOL NOT PARTICIPATING IN THE MATCH - IF FULL  REDIRECT, ELSE BUTTON FOR JOINING?";
} else {
    header("Location: /login");
}
