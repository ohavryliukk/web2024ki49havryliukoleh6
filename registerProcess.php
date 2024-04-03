<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($password)) {
        http_response_code(400);
        echo "Error: All fields are required.";
    } else {
        $sql = "SELECT * FROM registered_users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            http_response_code(404);
            echo "Error: This email is already registered.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO registered_users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

            if ($conn->query($sql) === TRUE) {
                echo "Registration successful!";
            } else {
                http_response_code(404);
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
} else {
    http_response_code(404);
    echo "Error: Invalid request method.";
}

$conn->close();
