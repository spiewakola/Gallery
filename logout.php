<?php

session_start();
require_once 'functions.php';
unset($_SESSION['user']);
redirectWithMessage('wylogowano pomyslnie','signin.php');