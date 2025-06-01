<?php
    session_start();
    include('db.php');
    $username=$_SESSION['username'];
    $query="SELECT user_id FROM users WHERE user_name='$username'";
    $result=mysqli_query($conn,$query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id']=$row['user_id'];
    }
?>