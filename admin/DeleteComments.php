<?php 
include 'includes/db.php';
if(isset($_GET['id'])) {
    $IdFromUrl = $_GET['id'];
    global $connection;
    $query = "DELETE FROM comments WHERE id = ' $IdFromUrl' ";
    $Execute = mysqli_query($connection, $query);
    if($Execute) {
        echo "<script> alert('Comment Deleted Succesfully') </script>";
        header("Location: comment.php");
        
    } else {
        echo "Something went wrong".mysqli_error($connection);
        header("Location: comment.php");
    }
}
?>