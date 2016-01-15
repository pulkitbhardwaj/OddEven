<?php

session_start();

$target_page = $_SERVER['HTTP_REFERER'];

session_destroy();

header('Location: '.$target_page);

?>