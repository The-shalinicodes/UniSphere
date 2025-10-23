<!DOCTYPE html>
<html lang="en">

<head>
  <link href="image/mainlogo2.png" rel="icon" type="image/icon type">
  <link rel="stylesheet" href="style1.css" />
  <link rel="stylesheet" href="captcha.css" />
  <title>Login | Together4U</title>
</head>

<body onload="generate()">
  <section>
    <div class="form-box">
      <div class="form-value">
        <form method="post" action="log.php" name="Login" onsubmit="return validationForm()">
          <h2>Login</h2>
          <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?><i class="fa-solid fa-xmark" onclick="closeForm()"></i>
          </p>
          <?php } ?>
          <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" placeholder="Email" name="email" id="email" autocomplete="username" />
            <label for="email">Email</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" placeholder="Password" name="password" id="password" autocomplete="current-password" />
            <label for="password">Password</label>
          </div>
          <div class="capt inputbox">
            <div id="user-input" class="inline">
              <input type="text" id="submit" class="inn" name="captcha" placeholder="Captcha" />
              <label for="submit">Captcha</label>
            </div>

            <div class="inline" onclick="generate()">
              <i class="fas fa-sync"></i>
            </div>

            <div id="image" class="inline" selectable="False"></div>
          </div>
          <button type="submit">
            <span>Sign in</span>
          </button>
        </form>
      </div>
    </div>
  </section>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://kit.fontawesome.com/ea2578e43f.js" crossorigin="anonymous"></script>
  <script src="login.js"></script>
  
</body>

</html>