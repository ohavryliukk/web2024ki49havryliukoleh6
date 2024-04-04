<?php
include "database.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = array();

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
    $errors[] = "All fields are required";
}

$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(array("success" => false, "errors" => $errors));
    exit;
}

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($email);
$message = $conn->real_escape_string($_POST['message']);

$sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(array("success" => true));
} else {
    http_response_code(500);
    echo json_encode(array("success" => false, "message" => "Server error"));
}

$conn->close();
?>