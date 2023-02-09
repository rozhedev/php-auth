<?php
	session_start();
	unset($_SESSION['session_username']);
    unset($_SESSION['session_password']);
	session_destroy();
	header("location:login.php");
