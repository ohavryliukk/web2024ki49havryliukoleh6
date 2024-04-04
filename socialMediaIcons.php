<?php
include "database.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM social_media";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<li class='social-media'><a href='" . $row["url"] . "'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($row['icon']) . "' alt='" . $row["name"] . "'/>";
        echo "</a></li>";
    }
} else {
    echo "No social media found";
}

$conn->close();
?>