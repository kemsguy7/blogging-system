<?php
 $sql = "SELECT * FROM categories";
 $res = mysqli_query($connection, $sql);
 ?>
 
<div class="container">
<div class="row">
  <h2>Add Post</h2>
  <div class="col-sm-12 col-lg-7">
    <form action="includes/functions.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="">Post title</label>
        <input type="text" name="title" placeholder="Post Title" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Post Author</label>
        <input type="text" value="<?php echo $_SESSION['username'];?>" name="author" placeholder="Post Author" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Post Category</label>
      <select class="form-control" name="category">
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
        <textarea name="content" rows="8" cols="80" class="form-control ckeditor" id="editor"></textarea>
      </div>
      <div class="form-group">
        <label for="">Post Tags</label>
        <input type="text" name="tags" placeholder="Seperate tags with a comma (,)" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Post Status</label>
      <select class="form-control" name="status">
        <option value="draft">Draft</option>
        <option value="published">Published</option>
      </select>
      </div>
      <div class="form-group">
        <label for="">Post Image</label>
        <input type="file" name="post_image"  class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="publish" value="Publish Post"  class="btn btn-primary">
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

