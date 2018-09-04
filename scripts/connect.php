<?php

$hostname = 'achEng.asdougl.com';
$username = 'asdouglc_acheng';
$password = '1Fl5L5HUeF';
$database = 'asdouglc_achievementEngine';
/*
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'login';
*/

// connect to the database
$db = new mysqli($hostname, $username, $password, $database);

$errors = array(); 
?>