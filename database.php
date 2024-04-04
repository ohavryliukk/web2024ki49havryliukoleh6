<?php
include "config.php";
$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

session_start();
session_regenerate_id(true);

$conn = new mysqli($servername, $username, $password, $dbname);