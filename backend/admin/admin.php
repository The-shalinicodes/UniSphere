<?php
session_start();
include('connection.php');
if (isset($_SESSION['event_posted'])) {
    echo "<script>alert('{$_SESSION['event_posted']}');</script>";
    unset($_SESSION['event_posted']);
}
if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['clubname'])) {

    // $admin_id = $_SESSION['id'];
    // $query = "SELECT type FROM login_det WHERE id = $admin_id";
    // $result = mysqli_query($con, $query);
    // $row = mysqli_fetch_assoc($result);
    // $admin_type = $row['type'];
    // $query = "SELECT * FROM announcements WHERE ann_to = '$admin_type' ORDER BY ann_date DESC";
    // $result = mysqli_query($con, $query);

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Together4U</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="image/mainlogo2.png" rel="icon" type="image/icon type" />
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="superadmin.css" />

</head>

<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <img id='logo' src="" />
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#" onclick="showContent('dashboard')">
                    <i class="bx bxs-dashboard"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('usersubscription')">
                    <i class='bx bxs-user-account'></i>
                    <span class="text">User Subscription</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('memberlist')">
                    <i class="bx bxs-user-detail"></i>
                    <span class="text">Member List</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('makeannouncements')">
                    <i class='bx bxs-megaphone'></i>
                    <span class="text">Make Announcements</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('events')">
                    <i class='bx bxs-category-alt'></i>
                    <span class="text">Event Management</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('messages')">
                    <i class='bx bxs-message-rounded-error'></i>
                    <span class="text">Messages</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" onclick="showContent('settings')">
                    <i class="bx bxs-cog"></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="logout">
                    <i class='bx bx-log-out'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- NAVBAR -->
    <section id="content">
        <nav>
            <i class="bx bx-menu"></i>
            <input type="checkbox" id="switch-mode" hidden />
            <label for="switch-mode" class="switch-mode"></label>
            <h5 style="margin-bottom: 0;">Welcome to
                <?php 
                if (isset($_SESSION['name'])) {
                    echo $_SESSION['clubname'];
                    echo ", ";
                    echo $_SESSION['name'];
                } else {
                    echo '';
                }
            ?>
            </h5>
            <a href="#" class="notification">
                <i class="bx bxs-bell"></i>
                <span class="num">8</span>
            </a>
        </nav>


        <div class="main">
            <div class="content" id="dashboardContent">
                <!-- <section id="content"> -->

                <!-- DASHBOARD -->
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>Dashboard</h1>
                        </div>
                    </div>

                    <ul class="box-info">
                        <li>
                            <i class="bx bxs-group"></i>
                            <span class="text">
                                <h3>
                                    <?php
                                    $club_name = $_SESSION['clubname'];
                                    $result = $con->query("SELECT COUNT(*) AS count_users FROM event_det WHERE clubname = '$club_name'");
                                    if ($result) {
                                        $row = $result->fetch_assoc();

                                        if ($row) {
                                            $count_users = $row['count_users'];
                                            echo $count_users;
                                        }
                                    }
                                    ?>
                                </h3>
                                <p>Total Users</p>
                            </span>
                        </li>
                        <li>
                            <i class="bx bxs-calendar-check"></i>
                            <span class="text">
                                <h3>
                                    <?php
                                    $club_name = $_SESSION['clubname'];
                                    $result = $con->query("SELECT COUNT(*) AS count_events FROM event_det WHERE clubname = '$club_name'");
                                    if($result){
                                        $row = $result->fetch_assoc();

                                        if($row){
                                            $count_events = $row['count_events'];
                                            echo $count_events;
                                        }

                                    }
                                ?>
                                </h3>
                                <p>Events</p>
                            </span>
                        </li>
                        <li>
                            <i class='bx bx-layer'></i>
                            <span class="text">
                                <h3>
                                    <?php
                                        $club_name = $_SESSION['clubname'];
                                        $result = $con->query("SELECT COUNT(*) AS count_subs FROM subs_type WHERE clubname = '$club_name'");
                                        if($result)
                                        {
                                            $row = $result->fetch_assoc();

                                            if($row)
                                            {
                                                $count_subs = $row['count_subs'];
                                                echo $count_subs;
                                            }
                                        }
                                    ?>
                                </h3>
                                <p>Packages</p>
                            </span>
                        </li>
                    </ul>

                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Recent Events</h3>
                                <i class="bx bx-search"></i>
                                <i class="bx bx-filter"></i>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Event Date</th>
                                        <th>Event Time</th>
                                        <th>Event Type</th>
                                        <th>Event Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $clubname = $_SESSION['clubname'];
                                        $events = $con->query("SELECT *, CURDATE() as today FROM event_det WHERE clubname='$clubname' LIMIT 4");

                                        if ($events->num_rows > 0) {
                                            while ($row = $events->fetch_assoc()) {
                                                echo "<tr> <td> <p>";
                                                echo $row['ename']; 
                                                echo "</p></td>";
                                                echo "<td>";
                                                echo $row['date'];
                                                echo "</td><td>";
                                                echo $row['time'];
                                                echo "</td><td>";
                                                echo $row['etype'];
                                                echo "</td><td>";
                                                if ($row['date'] > $row['today'])
                                                {
                                                    echo "<span class=\"status pending\">Pending</span>";
                                                }
                                                else if (($row['date'] < $row['today']))
                                                {
                                                    echo "<span class=\"status completed\">Completed</span>";
                                                }
                                                else {
                                                    echo "<span class=\"status process\">Live</span>";
                                                }
                                                echo "</td></tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                </main>
            </div>
            <div class="content" id="usersubscriptionContent">

                <!-- User-Subscription -->
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>User Subscription Management</h1>
                        </div>
                    </div>

                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Entries</h3>
                                <i class="bx bx-search"></i>
                                <i class="bx bx-filter"></i>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Subscription Name</th>
                                        <th>Subscription Price</th>
                                        <th>Created on</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $club_name = $_SESSION['clubname'];
                                        $query = $con->query("SELECT * FROM subs_type WHERE clubname = '$club_name' ORDER BY sub_id");

                                        if ($query->num_rows > 0)
                                        {
                                            while ($row = $query->fetch_assoc()) {
                                                echo "<tr> <td><p>"; 
                                                echo $row['sub_id'];
                                                echo "</p></td>";
                                                echo "<td>";
                                                echo $row['sname'];
                                                echo "</td> <td>";
                                                echo $row['sprice'];
                                                echo "</td> <td>";
                                                echo $row['create_date'];
                                                echo "</td> </tr>";
                                            }
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                </main>
                <!-- </section> -->
            </div>
            <div class="content" id="memberlistContent">
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>Member List</h1>
                        </div>
                    </div>

                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Details</h3>
                                <i class="bx bx-search"></i>
                                <i class="bx bx-filter"></i>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
                                        <th>Subscription</th>
                                        <th>Sub Start</th>
                                        <th>Sub End</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $club_name = $_SESSION['clubname'];
                                        $query = "SELECT * FROM member_list WHERE clubname = '$club_name'";
                                        $result = mysqli_query($con, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr><td>";
                                                echo $row['mname'];
                                                echo "</td><td>";
                                                echo $row['memail'];
                                                echo "</td> <td>";
                                                echo $row['mphone'];
                                                echo "</td><td>";
                                                echo $row['msubtype'];
                                                echo "</td><td>";
                                                echo $row['msubstart'];
                                                echo "</td><td>";
                                                echo $row['msubend'];
                                                echo "</td><td>";
                                                echo $row['mcreated_at'];
                                                echo "</td></tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                </main>
            </div>
            <div class="content" id="makeannouncementsContent">
                <div class="announcement-container">
                    <h1>Announcement Page</h1>
                    <form id="announcement-form">
                        <label for="announcement">Enter Announcement:</label>
                        <textarea id="announcement" name="announcement" rows="5" required></textarea>
                        <button type="submit" id="post-btn">Post</button>
                    </form>
                </div>
            </div>
            <div class="content" id="eventsContent">

                <!-- Event Management -->
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>Event Management</h1>
                        </div>
                    </div>

                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Entries</h3>
                                <i class="bx bx-search"></i>
                                <i class="bx bx-filter"></i>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Event Name</th>
                                        <th>Event Type</th>
                                        <th>Venue</th>
                                        <th>City</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Open for all?</th>
                                        <th>Guest/<br>Performer</th>
                                        <th>Reg. Fees</th>
                                        <th>Reg. Open till</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $club_name = $_SESSION['clubname'];
                                    $query = "SELECT * FROM event_det WHERE clubname = '$club_name'";
                                    $result = mysqli_query($con, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $sr_no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr><td>";
                                            echo $sr_no++;
                                            echo "</td><td>";
                                            echo $row['ename'];
                                            echo "</td><td>";
                                            echo $row['etype'];
                                            echo "</td><td>";
                                            echo $row['evenue'];
                                            echo "</td><td>";
                                            echo $row['city'];
                                            echo "</td><td>";
                                            echo $row['date'];
                                            echo "</td><td>";
                                            echo $row['time'];
                                            echo "</td><td>";
                                            echo $row['openforall'];
                                            echo "</td><td>";
                                            echo $row['guest'];
                                            echo "</td><td>";
                                            echo $row['reg_fees'];
                                            echo "</td><td>";
                                            echo $row['reg_open'];
                                            echo "</td></tr>";
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                </main>
                <a href="NewEvent.php" class="statuscomplete" id="add-new-event">Add New Event</a>
                <!-- </section> -->
            </div>
            <div class="content" id="messagesContent">
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>Messages</h1>
                        </div>
                    </div>
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Recent Messages</h3>
                                <i class="bx bx-search"></i>
                                <i class="bx bx-filter"></i>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>From</th>
                                        <th>Description</th>
                                        <th>Received on</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                    <td>
                                        <p>1</p>
                                    </td>
                                    <td>Together4U Super Admin</td>
                                    <td>Stay in your limits</td>
                                    <td>2023-12-19 14:22:34</td>
                                    <td><span class="status pending">Mark as read</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>2</p>
                                    </td>
                                    <td>Together4U Super Admin</td>
                                    <td>Stay in your limits</td>
                                    <td>2023-12-19 14:22:34</td>
                                    <td><span class="status pending">Mark as read</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>3</p>
                                    </td>
                                    <td>Together4U Super Admin</td>
                                    <td>Stay in your limits</td>
                                    <td>2023-12-19 14:22:34</td>
                                    <td><span class="status pending">Mark as read</span></td>
                                </tr> -->



                                </tbody>
                            </table>
                        </div>
                </main>
            </div>
        </div>

    </section>
    <!-- MAIN CONTENT -->


    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="superadmin.js"></script>
</body>

</html>


<?php
}
else{
    header("Location: login.php");
}
?>