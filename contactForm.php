<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2>Contact Me</h2>
        <form id="contactForm" method='post' action='submitContact.php'>
            <input type='text' name='name' placeholder='Your Name'><br>
            <input type='email' name='email' placeholder='Your Email'><br>
            <textarea name='message' placeholder='Your Message'></textarea><br>
            <input type='submit' value='Send'>
        </form>
        <div id="messageBox" style="display:none;"></div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        document.getElementById("contactForm").addEventListener("submit", function (event) {
            event.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", this.getAttribute("action"), true);
            xhr.onreadystatechange = function () {
                if (xhr.status == 200) {
                    showMessage('Message sent successfully!', 'success');
                } else {
                    var response = JSON.parse(xhr.responseText);
                    var errors = response.errors;
                    var errorMessage = "Errors:";
                    errors.forEach(function (error) {
                        errorMessage += "<br>" + error;
                    });
                    showMessage(errorMessage, 'error');
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