<?php
include "database.php";

if (!isset($_SESSION['login_id'])) {
    header('Location: authorization.php');
    exit;
}

$id = $_SESSION['login_id'];

$get_google_user = mysqli_query($conn, "SELECT * FROM `google_users` WHERE `google_id`='$id'");
$get_user = mysqli_query($conn, "SELECT * FROM `registered_users` WHERE `id`='$id'");


if (mysqli_num_rows($get_google_user) > 0) {
    $user = mysqli_fetch_assoc($get_google_user);
} elseif (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    header('Location: logout.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h1>My Account</h1>
    </div>
    <div class="container">
        <?php if (!empty($user['profile_image'])): ?>
            <img class="avatar" src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>">
        <?php else: ?>
            <img class="avatar" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png">
        <?php endif; ?>
        <div class="_info">
            <h1>
                <?php echo $user['name']; ?>
            </h1>
            <p>
                <?php echo $user['email']; ?>
            </p>
            <a href="logout.php">Exit</a>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>

</html>