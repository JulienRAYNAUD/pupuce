<?php
//je lance ma session
session_start();
// je détruit ma session
session_destroy();
// je redirige vers une page de mon site
header("Location: index.php");
exit;
