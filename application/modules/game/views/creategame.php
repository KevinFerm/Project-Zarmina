<?php if($available == true && $logged_in == true){ ?>
<h2>Create Game - Choose what to play as!</h2>
<button type="button" id="human">Human</button>
<a href="/game/creategame/alien">Alien</a>
<a href="/game/creategame/human">Human</a>
<button type="button" id="alien">Alien</button>
<?php } elseif($available == false && $logged_in == true) {echo '<p>Already in a game, sorry!';} elseif($logged_in == false){header("Location: /login");} else {echo 'Sorry...';}?>
