<?php  

//First function, get the number of posts
function getNumPosts(){ 
    global $connection;
    $query = mysqli_query($connection, "SELECT * FROM posts");
    if(mysqli_num_rows($query) > 0) {
        return mysqli_num_rows($query);
    }
    return "0"; //returns 0 incase nothing was found
}

function getNumComments(){ 
    global $connection;
    $query = mysqli_query($connection, "SELECT * FROM comments");
    if(mysqli_num_rows($query) > 0) {
        return mysqli_num_rows($query);
    }
    return "0";
}

function getNumUsers(){ 
    global $connection;
    $query = mysqli_query($connection, "SELECT * FROM users");
    if(mysqli_num_rows($query) > 0) {
        return mysqli_num_rows($query);
    }
    return "0";
}

function getNumCategories(){ 
    global $connection;
    $query = mysqli_query($connection, "SELECT * FROM categories");
    if(mysqli_num_rows($query) > 0) {
        return mysqli_num_rows($query);
    }
    return "0";
}