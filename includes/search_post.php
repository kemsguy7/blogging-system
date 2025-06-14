<?php

 
if (isset($_POST['search'])) {
  $search = $_POST['search'];

  if(isset($_GET['page'])){ //Paginaiton algorithm
    $page = $_GET["page"];
    if($page == 0 || $page < 1) {
      $ShowPostFrom = 0;
    } else {
      $ShowPostFrom = ($page * 5) - 5;
      $ViewQuery ="SELECT * FROM posts ORDER By datetime desc LIMIT $ShowPostFrom, 5";
    }
  }

  $query = "SELECT * FROM posts WHERE post_tags OR post_title OR post_content OR post_category OR post_date LIKE '%$search%'";
  $result = mysqli_query($connection, $query);
  $found = mysqli_num_rows($result);


   if($found === 0){
    echo "<div class='alert alert-danger'>No search result found</div>";
  } 
  
  else{
      while($row = mysqli_fetch_assoc($result)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_category = $row['post_category'];
        $post_category_id = $row['post_category_id'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $date = $row['post_date'];
        $post_views = $row['post_views'];
        $post_comment_count = $row['post_comment_count'];

        ?>
        <div class="col-md-6">
          <a href="single.php" class="blog-entry element-animate" data-animate-effect="fadeIn">
            <img src="admin/images/<?php echo $post_image;?>" alt="Image placeholder">
            <div class="blog-content-body">
              <div class="post-meta">
                <span class="author mr-2"><?php echo $post_author;?></span>&bullet;
                <span class="mr-2"><?php echo $date;?> </span> &bullet;
                <span class="ml-2"><span class="fa fa-comments"></span> <?php echo $post_comment_count;?></span>
              </div>
              <h2><?php echo $post_title;?></h2>
            </div>
          </a>
        </div>

    <?php } //end of while loop
  } //end of else statement 
 
} //end of first if
 ?>
