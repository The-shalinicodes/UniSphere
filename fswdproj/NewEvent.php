<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event | Together4U</title>
    <link rel="stylesheet" href="NewEvent.css">
    <link href="image/mainlogo2.png" rel="icon" type="image/icon type">
</head>
<body>
    <div class="event-form">
        <h1>Add New Event</h1>
        <form id="event-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <input type="hidden" id="clubname" name="clubname" value="<?php echo $_SESSION['clubname']; ?>">

            <label for="event-name">Event Name:</label>
            <input type="text" id="event-name" name="event-name" required>

            <label for="event-type">Event Type:</label>
            <input type="text" id="event-type" name="event-type" required>

            <label for="venue">Venue:</label>
            <input type="text" id="venue" name="venue" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <label for="open-for-all">Open for all?</label>
            <select id="open-for-all" name="open-for-all" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>

            <label for="guest-performer">Guest/Performer:</label>
            <input type="text" id="guest-performer" name="guest-performer" required>

            <label for="registration-fees">Registration Fees:</label>
            <input type="text" id="registration-fees" name="registration-fees">

            <label for="registration-open-till">Registrations Open till:</label>
            <input type="date" id="registration-open-till" name="registration-open-till">

            <div class="post-event" id="post-event">
                <button type="submit" name="submit">Post Event</button>
            </div>
        </form>
    </div>

    <?php
    
    session_start();
    include('connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $clubname = $_SESSION['clubname'];

        $event_name = mysqli_real_escape_string($con, $_POST['event-name']);
        $event_type = mysqli_real_escape_string($con, $_POST['event-type']);
        $venue = mysqli_real_escape_string($con, $_POST['venue']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $time = mysqli_real_escape_string($con, $_POST['time']);
        $open_for_all = mysqli_real_escape_string($con, $_POST['open-for-all']);
        $guest_performer = mysqli_real_escape_string($con, $_POST['guest-performer']);
        $registration_fees = mysqli_real_escape_string($con, $_POST['registration-fees']);
        $registration_open_till = mysqli_real_escape_string($con, $_POST['registration-open-till']);

        $stmt = $con->prepare("INSERT INTO event_det (clubname, ename, etype, evenue, city, date, time, openforall, guest, reg_fees, reg_open) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $clubname, $event_name, $event_type, $venue, $city, $date, $time, $open_for_all, $guest_performer, $registration_fees, $registration_open_till);

        if ($stmt->execute()) {
            echo "<script>alert('New event added successfully');</script>";
            header("Location: admin.php");
            exit(); 
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }

    $con->close();
    ?>
</body>
</html>
