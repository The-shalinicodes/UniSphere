<?php
session_start();
include('connection.php');
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="settings.css">
</head>

<body>

    <div class="settings-container">
        <div class="img">
            <img src="./image/mainlogo1.png" alt="Main-Logo" height="80px">
        </div>
        <h1>Settings</h1>
        <form action="changesettings.php" method="post">
            <div class="settings-section">
                <h2>Account Settings</h2>
                <div class="setting">
                    <label for="username">Change Username:</label>
                    <input type="text" id="username" name="username">
                </div>
                <div class="setting">
                    <label for="email">Change Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="setting">
                    <label for="phone">Change Phone Number:</label>
                    <input type="tel" id="phone" name="phone">
                </div>
            </div>

            <div class="settings-section" id="emailSettingsSection">
                <h2>Receive updates via E-mail</h2>
                <div class="setting settings">
                    <input type="checkbox" id="receiveEmailUpdates" name="receiveEmailUpdates">
                    <label for="receiveEmailUpdates" class="mail">Receive updates via E-mail</label>
                </div>
                <div class="setting" id="emailInputContainer" style="display: none;">
                    <label for="emailAddress">Email Address:</label>
                    <input type="email" id="emailAddress" name="emailAddress">
                </div>
            </div>

            <div class="settings-section">
                <button id="saveButton" name="save">Save</button>
            </div>
        </form>
    </div>

    <script>
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePhoneNumber(phoneNumber) {
            const phoneRegex = /^\d{10}$/;
            return phoneRegex.test(phoneNumber);
        }

        const defaultEmail = "user@example.com";

        document.getElementById('receiveEmailUpdates').addEventListener('change', function () {
            const emailInputContainer = document.getElementById('emailInputContainer');
            if (this.checked) {
                emailInputContainer.style.display = 'block';
                document.getElementById('emailAddress').value = defaultEmail;
            } else {
                emailInputContainer.style.display = 'none';
            }
        });


        document.getElementById('saveButton').addEventListener('click', function () {
            let valid = true;

            const receiveEmailCheckbox = document.getElementById('receiveEmailUpdates');
            const email = document.getElementById('email').value.trim();
            const email1 = document.getElementById('emailAddress').value.trim();
            if ((email !== '' && !validateEmail(email)) || (receiveEmailCheckbox.checked && email1 != '' && !validateEmail(email1))) {
                valid = false;
                alert('Please enter a valid email address.');
            }
            if (receiveEmailCheckbox.checked && email1 == '') {
                valid = false;
                alert('Please enter an email address.')
            }

            const phoneNumber = document.getElementById('phone').value.trim();
            if (phoneNumber !== '' && !validatePhoneNumber(phoneNumber)) {
                valid = false;
                alert('Please enter a valid phone number (10 digits).');
            }

            if (valid) {
                alert('Settings saved!');
            }
        });

    </script>
</body>

</html>
<?php
}
else{
    header("Location: login.php");
}
?>