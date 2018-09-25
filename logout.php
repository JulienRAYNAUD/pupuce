<?php
//je lance la session
//I start the session
session_start();
//je détruit la session
//I destroy the session
session_destroy();
//je redirige vers l'index de mon site en passant la variable logout à "success"
//I redirect to the index of my site by passing the variable logout as "success"
header("Location: index.php?logout=success");
exit;
