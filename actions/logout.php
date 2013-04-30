<?php

session_start();

if (array_key_exists("auth", $_SESSION)) {
    session_unset();
    session_write_close();
}

session_destroy();

?>
