<?php

    // Funtion to delete post
    function delete($table, $colName, $id) {
        global $connection;
        $query = mysqli_query($connection, "DELETE FROM $table WHERE $colName = $id");
        if($query) {
            return true;
        } else {
            return false;
        }
    }

    //approve or unapprove post

    function confirm($id) {
        //function to approve or unapprove comments
        global $connection;
        $query = mysqli_query($connection, "SELECT comment_status FROM comments WHERE id=$id");
        if(mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_array($query);
            //get the status
            $status = $result['comment_status'];

            // check the value of status
            if($status == 'unapproved') {
                $sql = mysqli_query($connection, "UPDATE comments SET comment_status = 'Approved' WHERE id='$id'");
            } else {
                $sql = mysqli_query($connection, "UPDATE comments SET comment_status='unapproved' WHERE id='$id'");
            }
            return true;
        }else {
            return false;
        }
    }

    //redirecting function
    function redirect($page = 'index.php') {
        header("Location: ".$page." ");
    }
    
    ?>