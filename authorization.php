<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <div id="loginFormBlock">
            <h2>Login</h2>
            <form id="loginForm" action="loginProcess.php" method="POST">
                <input type="email" name="email" placeholder="Your Email"><br>
                <input class="input-password" type="text" name="password" placeholder="Your Password"><br>
                <input type="submit" value="Login">
            </form>
            <p>Don't have an account? <a href="#" onclick="showRegistrationForm()">Register here</a></p>
            <?php include 'googleLogin.php'; ?>
        </div>

        <div id="registrationFormBlock" style="display: none;">
            <h2>Registration</h2>
            <form id="registrationForm">
                <input type="text" name="name" placeholder="Your Name"><br>
                <input type="email" name="email" placeholder="Your Email"><br>
                <input class="input-password" type="text" name="password" placeholder="Your Password"><br>
                <input type="submit" value="Register">
            </form>
            <p>Already have an account? <a href="#" onclick="showLoginForm()">Login here</a></p>
        </div>
        <div id="messageBox" style="display:none;"></div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function showRegistrationForm() {
            document.getElementById("loginFormBlock").style.display = "none";
            document.getElementById("registrationFormBlock").style.display = "block";
        }

        function showLoginForm() {
            document.getElementById("registrationFormBlock").style.display = "none";
            document.getElementById("loginFormBlock").style.display = "block";
        }

        document.getElementById("registrationForm").addEventListener("submit", function (event) {
            event.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "registerProcess.php", true);
            xhr.onreadystatechange = function () {
                console.log(xhr.responseText);
                if (xhr.status === 200) {
                    showMessage(xhr.responseText, 'success');
                } else {
                    showMessage(xhr.responseText, 'error');
                }
            };
            xhr.send(formData);
        });

        document.getElementById("loginForm").addEventListener("submit", function (event) {
            event.preventDefault();
            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "loginProcess.php", true);
            xhr.onreadystatechange = function () {
                console.log(xhr.responseText);
                if (xhr.status === 200) {
                    showMessage(xhr.responseText, 'success');
                    window.location = "home.php";
                } else {
                    showMessage(xhr.responseText, 'error');
                }
            };
            xhr.send(formData);
        });

        function showMessage(message, type) {
            var messageBox = document.getElementById("messageBox");
            messageBox.innerHTML = message;
            messageBox.className = "message " + type;
            messageBox.style.display = "block";
            setTimeout(function () {
                messageBox.style.display = "none";
            }, 5000);
        }
    </script>
</body>

</html>