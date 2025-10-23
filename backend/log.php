<!DOCTYPE html>

<?php
session_start();
include('connection.php');
if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
$username = validate($_POST['email']);
$password = validate($_POST['password']);
// echo $username;
// echo md5($password);
// $username = stripcslashes($username);
// $password = stripcslashes($password);
// $username = mysqli_real_escape_string($con, $username);
// $password = mysqli_real_escape_string($con, $password);

if (empty($username)) {
    header("Location: login.php?error=Username cannot be empty.");
    exit();
}
else if (empty($password)) {
    header("Location: login.php?error=Password is required.");
    exit();
}

$sql = "select * from login_det where email = '$username' and password = '" . md5($password) . "'";
$result = mysqli_query($con, $sql);
// echo $username;
// echo md5($password);
// if (!$result) {
//     // Query execution error
//     die("Error in SQL query: " . mysqli_error($con));
// }
$count = mysqli_num_rows($result);
if ($count === 1) {
    
    $row = mysqli_fetch_assoc($result);
    
    if ($row['email'] === $username && $row['password'] = $password){
        if ($row['type']  == 'admin')
        {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['clubname'] = $row['clubname'];
            header("Location: admin.php");
            exit();
        }
        else if ($row['type']  == 'superadmin')
        {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("Location: superadmin.php");
            exit();
        }
        else if ($row['type']  == 'member')
        {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            
            header("Location: member.php");
            exit();
        }
        // echo "LOGGED IN!";
    }
    else {
        header("Location: login.php?error=Incorrect Credentials");
        exit();
    }
    // echo "<h1> Login failed. Invalid username or password.</h1>";
    // echo "<h1><center> Login successful </center></h1>";
}
else {
    header("Location: login.php?error=Incorrect Credentials");
    exit();
    // echo "<h1> Login failed. Invalid username or password.</h1>";
}
?>
