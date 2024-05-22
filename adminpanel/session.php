<?php

    session_start();
    if($_SESSION['LOGIN']==false){
        header("Location: login.php");
    }
?>