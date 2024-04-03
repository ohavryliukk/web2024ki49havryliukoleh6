<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "businesscard_db";
// $servername = "sql108.infinityfree.com";
// $username = "if0_36292191";
// $password = "xEVAM5Vt5yNrCWP";
// $dbname = "if0_36292191_businesscard";

session_start();
session_regenerate_id(true);

$conn = new mysqli($servername, $username, $password, $dbname);