<?php
    session_start() ;
    include('connection.php');

    if(isset($_POST['save']))
    {
        $id=$_SESSION['id'];
        $uname=$_POST['username'];
        $phone=$_POST['phone'];
        
        $email=$_POST['email'];
        $select= "select * from login_det where id='$id'";
        $sql = mysqli_query($con,$select);
        $row = mysqli_fetch_assoc($sql);
        $res = $row['id'];
        if($res === $id)
        {
            $nameToUpdate = !empty($uname) ? $uname : $row['name'];
            // echo "$nameToUpdate";
            $emailToUpdate = !empty($email) ? $email : $row['email'];
            $phoneToUpdate = !empty($phone) ? $phone : $row['phone'];
            $update = "UPDATE login_det SET name='$nameToUpdate', email='$emailToUpdate', phone='$phoneToUpdate' WHERE id='$id'";
            $sql2=mysqli_query($con,$update);
            if($sql2)
            {
                $_SESSION['email'] = $emailToUpdate;
                $_SESSION['name'] = $nameToUpdate;
                $_SESSION['id'] = $id;
                header('location:superadmin.php');
                exit();
            }
            else {
                // Error handling
                echo "Error: " . mysqli_error($con);
            }
        }
        else
        {
            header('location:settings.php');
            exit();
        }
    }
?>