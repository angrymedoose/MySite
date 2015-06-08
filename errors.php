<?php

function Errors()
{
    session_start();
    if (!empty($_SESSION["error"])) {
        $err = $_SESSION["error"];
        unset($_SESSION["error"]);
          return $err;
    }
	else return '';
}

