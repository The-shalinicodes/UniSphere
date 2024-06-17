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
    <title>Super Admin | Together4U</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="image/mainlogo2.png" rel="icon" type="image/icon type" />
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="superadmin.css" />

</head>

<body>
    
    <section id="sidebar">
        <a href="#" class="brand">
            <img id="logo" src=""/>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#" onclick="showContent('dashboard')">
                    <i class="bx bxs-dashboard"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('rolemanagement')">
                    <i class="bx bx-group"></i>
                    <span class="text">Role Management</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('rolepermissionsmanagement')">
                    <i class="bx bxs-user-detail"></i>
                    <span class="text">Role Permissions Management</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('club')">
                    <i class="bx bxs-buildings"></i>
                    <span class="text">Club Management</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showContent('icardmanagement')">
                    <i class='bx bxs-id-card'></i>
                    <span class="text">IDcard Management</span>
                </a>
            </li>
            <li>
              <a href="#" onclick="showContent('announcements')">
                  <i class='bx bxs-megaphone'></i>
                  <span class="text">Make Announcements</span>
              </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="settings.php" onclick="showContent('settings')">
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
            <h5 style="margin-bottom: 0;">Welcome,
                <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>
            </h5>
            <a href="#" class="notification">
                <i class="bx bxs-bell"></i>
                <span class="num">8</span>
            </a>
        </nav>


        <div class="main">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?><i class="fa-solid fa-xmark"></i>
            </p>
            <?php
                }
            ?>
            <div class="content" id="dashboardContent">
                
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

                                    $result = $con->query("SELECT COUNT(*) AS count_roles FROM manage_roles");

                                    if ($result) {
                                        $row = $result->fetch_assoc();

                                        if ($row) {
                                            $count_roles = $row['count_roles'];
                                            echo $count_roles;
                                        }
                                    }

                                    ?>
                                </h3>
                                <p>Total Role</p>
                            </span>
                        </li>
                        <li>
                            <i class="bx bxs-calendar-check"></i>
                            <span class="text">
                                <h3>
                                <?php

                                $result = $con->query("SELECT COUNT(*) AS club_count FROM club_det");

                                if ($result) {
                                    $row = $result->fetch_assoc();

                                    if ($row) {
                                        $club_count = $row['club_count'];
                                        echo $club_count;
                                    } 
                                }

                                ?>
                                </h3>
                                <p>Clubs</p>
                            </span>
                        </li>
                        <!-- <li>
                            <i class='bx bx-user-plus'></i>
                            <span class="text">
                                <h3>2543</h3>
                                <p>Clients</p>
                            </span>
                        </li> -->
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
                                        <th>Club Name</th>
                                        <th>Event</th>
                                        <th>Event Date</th>
                                        <th>Event Time</th>
                                        <th>Event Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                        <td>
                                            <p>Karnavati Club</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td>7:00 PM to 10:00 PM</td>
                                        <td>DJ night</td>
                                        <td><span class="status completed">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Rajpath Club</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td>5:00 PM to 11:00 PM</td>
                                        <td>Live Concert</td>
                                        <td><span class="status pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>YMCA</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td>5:00 PM to 11:00 PM</td>
                                        <td>Business Meet</td>
                                        <td><span class="status process">Live</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Rajhans Club</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td>5:00 PM to 11:00 PM</td>
                                        <td>Live Dayro</td>
                                        <td><span class="status pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Avadh</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td>5:00 PM to 11:00 PM</td>
                                        <td>Dance X</td>
                                        <td><span class="status completed">Completed</span></td>
                                    </tr> -->

                                    <?php
                                    $events = $con->query("SELECT *, CURDATE() as today FROM event_det LIMIT 4");

                                    if ($events->num_rows > 0) {
	                                    while ($row = $events->fetch_assoc()) {
                                            echo "<tr> <td> <p>";
                                            echo $row['clubname'];
                                            echo "</p></td>";
                                            echo "<td>";
                                            echo $row['etype'];
                                            echo "</td><td>";
                                            echo $row['date'];
                                            echo "</td><td>";
                                            echo $row['time'];
                                            echo "</td><td>";
                                            if ($row['date'] > $row['today'])
                                            {
                                                echo "<span class=\"status pending\">Pending</span>";
                                            }
                                            else
                                            {
                                                echo "<span class=\"status completed\">Completed</span>";
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
            <div class="content" id="rolemanagementContent">

                <!-- Rolemngmnt -->
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>Role Management</h1>
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
                                        <th>Role Name</th>
                                        <th>Created on</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                    <?php
                                    $roles = $con->query("SELECT * FROM manage_roles");

                                    if ($roles->num_rows > 0) {
	                                    while ($row = $roles->fetch_assoc()) {
                                            echo "<tr> <td> <p>";
                                            echo $row['id'];
                                            echo "</p> </td>";
                                            echo "<td>";
                                            echo $row['name'];
                                            echo "</td><td>";
                                            echo $row['created_at'];
                                            echo "</td></tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                </main>
            </div>
            <div class="content" id="rolepermissionsmanagementContent">

                <!-- Role-permissions-mngmnt -->
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>Role Permissions</h1>
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
                                        <th>Role Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>1</p>
                                        </td>
                                        <td>Admin</td>
                                        <td><span class="status completed">Edit</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>2</p>
                                        </td>
                                        <td>Committee Member</td>
                                        <td><span class="status completed">Edit</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </main>
            </div>
            <div class="content" id="clubContent">

                <!-- Club-Content -->
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>Club Management</h1>
                        </div>
                    </div>

                    <ul class="box-info">
                        <li>
                            <i class="bx bxs-calendar-check"></i>
                            <span class="text">
                                <h3>
                                <?php

                                $result = $con->query("SELECT COUNT(*) AS club_count FROM club_det");

                                if ($result) {
                                    $row = $result->fetch_assoc();

                                    if ($row) {
                                        $club_count = $row['club_count'];
                                        echo $club_count;
                                    } 
                                }

                                ?>
                                </h3>
                                <p>Clubs</p>
                            </span>
                        </li>
                    </ul>

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
                                        <th>Admin Name</th>
                                        <th>Club Name</th>
                                        <th>Club Code</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
                                        <th>Subscription</th>
                                        <th>Created on</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $roles = $con->query("SELECT * FROM club_det");

                                    if ($roles->num_rows > 0) {
	                                    while ($row = $roles->fetch_assoc()) {
                                            echo "<tr> <td> <p>";
                                            echo $row['club_admin'];
                                            echo "</p> </td>";
                                            echo "<td>";
                                            echo $row['clubname'];
                                            echo "</td>";
                                            echo "<td>";
                                            echo $row['clubcode'];
                                            echo "</td>";
                                            echo "<td>";
                                            echo $row['email'];
                                            echo "</td><td>";
                                            echo $row['phone'];
                                            echo "</td>";
                                            echo "<td>";
                                            echo $row['subscription'];
                                            echo "</td><td>";
                                            echo $row['create_date'];
                                            echo "</td></tr>";
                                        }
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                </main>
            </div>
            <div class="content" id="icardmanagementContent">

                <!-- Role-permissions-mngmnt -->
                <main>
                    <div class="head-title">
                        <div class="left">
                            <h1>IDCard Management</h1>
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
                                        <th>Icard</th>
                                        <th>Club Name</th>
                                        <th>Type</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>1</p>
                                        </td>
                                        <td class="imgflex"><img alt="" src="image/IDcard.jpg" height="10px"></td>
                                        <td>YMCA</td>
                                        <td>Portrait</td>
                                        <td>2023-12-19 14:22:34</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>2</p>
                                        </td>
                                        <td class="imgflex"><img alt="" src="image/IDcard.jpg" height="10px"></td>
                                        <td>Karnavati</td>
                                        <td>Portrait</td>
                                        <td>2023-12-19 14:22:34</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>3</p>
                                        </td>
                                        <td class="imgflex"><img alt="" src="image/IDcard.jpg" height="10px"></td>
                                        <td>Avadh</td>
                                        <td>Portrait</td>
                                        <td>2023-12-19 14:22:34</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </main>
            </div>
            <div class="content" id="announcementsContent">
              <div class="announcement-container">
                <h1>Announcement Page</h1>
                
                <form id="announcement-form" method="post" action="announce.php">
                  <label for="announcement">Enter Announcement:</label>
                  <textarea id="announcement" name="announcement" rows="5" required></textarea>
                  <button type="submit" id="post-btn"onclick="makeann();">Post</button>
                </form>
              </div>
            </div>
        </div>

    </section>

                                                          
    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="superadmin.js"></script>
</body>
</html>

    <?php
    }
    else {
        header("Location: login.php");
    }
?>