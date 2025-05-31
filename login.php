<?php 
include('db.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT password FROM login WHERE username='$username';";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if($row['password'] === $password){
                session_start();
                $_SESSION['username'] = $username;
                header('Location: home.html');
                exit;
            } else {
                header('Location: login.html?error=wrongpassword');
                exit;
            }
        } else {
            header('Location: login.html?error=usernotfound');
            exit;
        }
    }
}
?>