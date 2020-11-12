<?php
  include "db.php";
  include "sessions.php";

//Beginning of session messages 
/*
function ErrorMessage() {
    if(isset($_SESSION["ErrorMessage"])) {
        $Output = "<div class=\"alert alert-danger\">";
        $Output.=htmlentities($_SESSION["ErrorMessage"]);
        $Output.="</div>";
        $_SESSION["ErrorMessage"] = null; //This line clears the session and makes it null after the first attempt
        return $Output;
       
    }
}
function SuccessMessage() {
    if(isset($_SESSION["SuccessMessage"])) {
        $Output = "<div class=\"alert alert-success\">";
        $Output.=htmlentities($_SESSION["SuccessMessage"]);
        $Output.="</div>";
        $_SESSION["SuccessMessage"] = null; //This line clears the session and makes it null after the first attempt
        return $Output;
       
    }
}*/
//End of session messages

  function add_category() {
  global $connection;
  if (isset($_POST['cat_add'])) {
      if (empty($_POST['cat_title'])) {
        $_SESSION['ErrorMessage']="Category Field cannot be empty!";
        header("Location: ../categories.php?Field_cannot_be_empty");
        die();
      } else {
        $cat_title = $_POST['cat_title'];
        $query = "INSERT INTO categories(cat_title)VALUES('$cat_title')";
        $result = mysqli_query($connection, $query);

        if (!$result) { //If the query cpould not run
          die("Could not send data " . mysqli_error($connection));
        }
        else{
          $_SESSION['SuccessMessage'] = "Category Added Succesfully";
          header("Location: ../categories.php?category_added");
        }
      }
  }
}
add_category();

function show_category(){
  //This functions shows the category buttons and table data 
  global $connection;
 
  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete_cat={$cat_id}'>Delete</a></td>";
    echo "</tr>";
  }
}

function delete_category(){
  global $connection;
  if (isset($_GET['delete_cat'])) {
    $cat_id = $_GET['delete_cat'];
    $query = "DELETE FROM categories WHERE cat_id = $cat_id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Could not delete data " . mysqli_error($connection));
    }
    else{
      $_SESSION['SuccessMessage'] = "Category Deleted Succesfully";
      header("Location: categories.php?category_deleted");
    }
  }
}
delete_category();

function add_post(){
  global $connection;
  if (isset($_POST['publish'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category = $_POST['category'];

    //get the cat_id from the database
    $sql = mysqli_query($connection, "SELECT cat_id FROM categories WHERE cat_title='$post_category'");
    $row = mysqli_fetch_array($sql);
    $post_category_id = $row['cat_id'];
    $post_content = mysqli_real_escape_string($connection,$_POST['content']);
    $post_tags = $_POST['tags'];
    $post_status = $_POST['status'];

    $date = date("l d F Y");
    $post_views = 0;
    $post_comment_count = 0;

    if (isset($_FILES['post_image'])) {
      $dir = "../images/";
      $target_file = $dir.basename($_FILES['post_image']['name']);
      if (move_uploaded_file($_FILES['post_image']['tmp_name'],$target_file)) {
        echo "Image was uploaded";
      }else{
        echo "Something went wrong while uploading image";
      }
    }
    $query = "INSERT INTO posts (post_title,post_author,post_category,post_category_id,post_content,post_image,post_date,post_comment_count,post_views,post_tags,post_status) VALUES('$post_title','$post_author','$post_category','$post_category_id','$post_content','$target_file','$date','$post_comment_count','$post_views','$post_tags','$post_status')";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Could not send data " . mysqli_error($connection));
      header("Location: ../posts.php?source=add_new");
    }else{
      $_SESSION['SuccessMessage'] = "Post Added Succesfully";
      header("Location: ../posts.php?source=");
    }
  }
}
  add_post();

function show_posts(){
  global $connection;
  //Linking users to their posts  starts here
  $user = $_SESSION['userLoggedIn'];
  $sql = mysqli_query($connection, "SELECT * FROM users WHERE email = '$user'; ");
  $res = mysqli_fetch_array($sql);
  $username = $res['username'];
  $role = $res['role'];

   if ($role === 'Admin') {
     //if the Logged in user is an admin, show all the post
    $query = "SELECT * FROM posts";
   } else {
     // show the post according to the logged in user
     $query = "SELECT * FROM posts WHERE post_author='$username' ";
   }

  $query = "SELECT * FROM posts";
  $result = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category = $row['post_category'];
    $post_category_id = $row['post_category_id'];
    $post_content = substr($row['post_content'], 0, 50); //limits the content to 50 characters
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $date = $row['post_date'];
    //two below optional
    /*
    $post_views = $row['post_views'];
    $post_comment_count = $row['post_comment_count'];*/


    echo "<tr>";
    echo "<td>{$post_id}</td>";
    echo "<td>{$post_title}</td>";
    echo "<td>{$post_author}</td>";
    echo "<td>{$post_category}</td>";
    echo "<td>{$post_status}</td>";
    echo "<td><img src='images/{$post_image}' width='50px'></td>";
    echo "<td>{$post_content}</td>";
    echo "<td>{$date}</td>";
    echo "<td>{$post_tags}</td>";
    /*
    echo "<td>{$post_comment_count}</td>";
    echo "<td>{$post_views}</td>";*/
    echo "<td><a href='posts.php?approve_post=$post_id' class='btn btn-success'>Change Status</a></td>";
    echo "<td><a href='posts.php?source=edit&edit_post=$post_id' class='btn btn-primary'>Edit</a></td>";
    echo "<td><a href='posts.php?delete_post=$post_id' class='btn btn-danger'>Delete</a></td>";
    echo "</tr>";
  }
}

//publish or draft post
function modifyStatus($id) {
  global $connection; 
  $query = mysqli_query($connection, "SELECT post_status FROM posts WHERE post_id=$id");
  if(mysqli_num_rows($query) > 0){
    $result = mysqli_fetch_array($query);
    $status = $result['post_status'];

    if($status == 'draft') {
      $_SESSION['SuccessMessage'] = "Post status changed to published";
      $query = mysqli_query($connection, "UPDATE posts SET post_status='published' WHERE post_id=$id");
    } else {
      $_SESSION['SuccessMessage'] = "Post status chaged to draft";
      $query = mysqli_query($connection, "UPDATE posts SET post_status='draft' WHERE post_id=$id");
    }
    return true;
  }else {
    return false;
  }
}