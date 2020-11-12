<?php

//This script is used to edit posts, derived from add_post.php

//get categories
 $sql = "SELECT * FROM categories";
 $res = mysqli_query($connection, $sql);

 //get posts content by id
 if(isset($_GET['edit_post']) && $_GET['edit_post'] != "") {
    $edit_id = $_GET['edit_post'];
    $query = mysqli_query($connection, "SELECT * FROM posts WHERE post_id=$edit_id");
    if(mysqli_num_rows($query) > 0) {
      $data = mysqli_fetch_array($query);
      $title = $data['post_title'];
      $author = $data['post_author'];
      $category = $data['post_category'];
      $content = $data['post_content'];
      $tags = $data['post_tags'];
      $status = $data['post_status'];
      $image = $data['post_image'];
       
    } else {
      echo "error".mysqli_error($connection);
    }
 } else {
     die("failed"); 
 } 
 ?>
 
<div class="container">
<div class="row">
  <h2>Edit Post</h2>
  <div class="col-sm-12 col-lg-7">
    <form action="posts.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="">Post title</label>
        <input type="text" name="title" placeholder="Post Title" class="form-control" value="<?php echo $title; ?>" contenteditable="true">
      </div>
      <div class="form-group">
        <label for="">Post Author</label>
        <input type="text" value="<?php echo $_SESSION['username'];?>" name="author" placeholder="Post Author" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Post Category</label>
      <select class="form-control" name="category"  value="<?php echo $title; ?>">
      <option><?php echo $category; ?> <?php echo $category; ?> </option>
        <?php
          while ($row = mysqli_fetch_array($res)) {
            $cat_title = $row['cat_title'];
            echo "<option value='$cat_title'>$cat_title</option>";
          }
         ?>

      </select>
      </div>
      
      <div class="form-group">
        <label for="">Post Content</label>
        <textarea name="content" rows="8" cols="80" class="form-control" id="editor"  <?php echo $content; ?>> </textarea>
      </div>
      <div class="form-group">
        <label for="">Post Tags</label>
        <input type="text" name="tags" placeholder="Seperate tags with a comma (,)" class="form-control"  value="<?php echo $tags; ?>">
      </div>
      <div class="form-group">
        <label for="">Post Status</label> 
      <select class="form-control" name="status"  value="<?php echo $title; ?>">
      <?php  
        if($status == "draft") {
          //if the status is draft show draft first. 
         echo " <option value='draft'>Draft</option>
        <option value='published'>Published</option>";
        } else {
          //if status == published, show published first
       echo" <option value='published'>Published</option>
             <option value='draft'>Draft</option>";
        }
      ?>
        
      </select>
      </div>
      <div class="form-group">
        <label for="">Post Image</label>
        <input type="file" name="post_image" class="form-control">
        <br>
        <input type ="text" name="image" value="images/<?php echo $image; ?>" style="display: none;">
        <input type ="text" name="editID" value="<?php echo $edit_id; ?>" style="display: none;">
        <img src="<?php echo $image; ?>" style="width: 150px; height: 150px; border-radius:10px;">
      </div>
      <div class="form-group">
        <input type="submit" name="modify" value="Modify Post"  class="btn btn-primary">
      </div>
    </form>
  </div>
</div>

</div>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"> </script>
<script type="text/javascript"> 
  
	tinyMCE.init({
		
		// General options
		selector : "#editor",
		width : 800,
		height : 400,
		browser_spellcheck : true,
		
		//Identify the plug-ins to use: 
		plugins: "paste,searchreplace,fullscreen,hr,link,anchor,image,charmap,media,autoresize,autosave,contextmenu,wordcount",
		toolbar1: "cut,copy,paste,|,undo,redo,removeformat,|hr,|,link,unlink,anchor,image,|,charmap,media,|,search,replace,|,fullscreen",
		toolbar2:	"bold,italic,underline,strikethrough,|,alignleft,aligncenter,alignright,alignjustify,|,formatselect,|,bullist,numlist,|,outdent,indent,blockquote,",
		// Example content CSS (should be your site CSS)
		content_css : "css/bootstrap.min.css",

	});

</script>
