<?php 
include '../includes/db.php';

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $image = "users/profile_pic/defaults/head_" . rand(1, 3) . ".png"; //Making each user have a random profile pic
    $msg = "";
    $class = "alert alert";
     
    //Error Handling
    if(empty($username)) {
        $msg = "<b> Username is required</b>";
        echo "<div class='$class-da nger'>$msg </div>";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<b>Email is invalid </b>";
        echo "<div class='$class-danger'> </div>";
    } else if (strlen($password) < 6) {
        $msg = "<b>Password should be at least 6 characters </b>";
        echo "<div class='$class-danger'>$msg</div>";
    } else {
        $password = md5($password);
        $query = mysqli_query($connection, "INSERT INTO users(username,email,password,is_active,role,profile_pic) VALUES('$username', '$email','$password','yes','$role','$image')");
        if(!$query) {
            $msg = "Could not add User";
            echo "<div class='$class-danger'>$msg</div>";
        } else {
            ?>
            <script> 
                window.location.assign("view_users.php");
            </script>
            <?php
        }
    }
}  