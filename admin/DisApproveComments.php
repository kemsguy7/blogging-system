<?php 
include 'includes/db.php';
if(isset($_GET['id'])) {
    $IdFromUrl = $_GET['id'];
    global $connection;
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE id = ' $IdFromUrl' ";
    $Execute = mysqli_query($connection, $query);
    if($Execute) {
        echo "<script> alert('Comment approved Succesfully') </script>";
        header("Location: comment.php");
        
    } else {
        echo "Something went wrong".mysqli_error($connection);
        header("Location: comment.php");
    }
}
?>