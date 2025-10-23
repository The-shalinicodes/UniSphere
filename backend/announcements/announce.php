<?php
include('connection.php');
// session_start();
$announcement = $_POST['announcement'];

$sql = "INSERT INTO announcements VALUES ('admin', 'superadmin', '$announcement', CURDATE())";

if ($announcement !== ""){
    if ($con->query($sql) === TRUE) {
        // header("Location: superadmin.php?error=Announcement Done!");
        // $_SESSION['error'] = "Announcement Done!";
        // echo "<script>showDialog();</script>";
        echo "<script>alert('Annoucement Made! No error');</script>";
    }
    else {
        // header("Location: superadmin.php?error=Announcement Not Done!. Please fill all fields.");
        // $_SESSION['error'] = "Announcement Not Done!. Please fill all fields.";
        echo "<script>alert('Annoucement Not Made!');</script>";
    }
} else {
    // header("Location: superadmin.php?error=Announcement Not Done! Error occured.");
    // header("Location: superadmin.php?error=Error posting announcement:  '$con->error'");
    // $_SESSION['error'] = "Announcement Not Done! Error occurred.";
    echo "<script>alert('Annoucement Not Made!');</script>";
}
header("Location: superadmin.php");
exit();
?>
