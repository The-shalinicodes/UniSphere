let captcha;
function generate() {
  document.getElementById("submit").value = "";

  captcha = document.getElementById("image");
  let uniquechar = "";

  const randomchar =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (let i = 1; i < 5; i++) {
    uniquechar += randomchar.charAt(Math.random() * randomchar.length);
  }

  captcha.innerHTML = uniquechar;
}

// function printmsg() { }

function closeForm() {
  console.log("hello");
  window.location.replace('login.php');
}

function showPass() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function validationForm() {

  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  var usr_inp = document.getElementById("submit").value;
  var regemail = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/g;
  var regpswd = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&()]).{8,}$/;

  if (email == "") {
    window.alert("Enter your E-mail address!");
    document.Login.email.focus();
    generate();
    return false;
  } else if (!regemail.test(email)) {
    window.alert("Please enter the email again!");
    document.Login.email.focus();
    generate();
    return false;
  }

  if (password == "") {
    window.alert("Please enter the password!");
    document.Login.password.focus();
    generate();
    return false;
  } else if (!regpswd.test(password)) {
    window.alert("Please enter the password again in the correct format!");
    document.Login.password.focus();
    generate();
    return false;
  }

  if (usr_inp == "") {
    window.alert("Please enter the Captcha!");
    document.Login.captcha.focus();
    generate();
    return false;
  } else if (usr_inp != captcha.innerHTML) {
    window.alert("Incorrect Captcha!");
    document.Login.captcha.focus();
    generate();
    return false;
  }
  return true;
}
