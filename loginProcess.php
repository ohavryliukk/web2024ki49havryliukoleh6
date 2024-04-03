<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo "Error: All fields are required.";
    } else {
        $sql = "SELECT * FROM registered_users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['login_id'] = $row['id'];
            } else {
                http_response_code(404);
                echo $row['password'];
            }
        } else {
            http_response_code(404);
            echo "Error: User not found.";
        }
    }
} else {
    http_response_code(404);
    echo "Error: Invalid request method.";
}

$conn->close();