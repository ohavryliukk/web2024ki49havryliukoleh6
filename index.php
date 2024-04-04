<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <?php
        include "database.php";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<img class='avatar' src='data:image/jpeg;base64," . base64_encode($row['avatar']) . "' alt='" . $row["name"] . "'/>";
                echo "<h1>" . $row["name"] . "</h1>";
                echo "<p>" . $row["description"] . "</p>";
            }
        } else {
            echo "No data found";
        }
        $conn->close();
        ?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>