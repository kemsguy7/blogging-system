<?php 
include 'includes/header.php'; 
include "includes/helper.php";

//Delete posts
if(isset($_GET['delete_post']) && $_GET['delete_post'] !== '') {
  $dlt = $_GET['delete_post'];
  if(delete('posts','post_id',$dlt)) {
	$_SESSION['SuccessMessage'] = "Post Deleted Succesfully";
    redirect('posts.php?source=');
  } else {
	  die('FAILED');
  }
}
//approve post
if(isset($_GET['approve_post']) && $_GET['approve_post'] !== "") {
	$app_id = $_GET['approve_post'];
	if(modifyStatus($app_id)) {
		$_SESSION['SuccessMessage'] = "Post Approved Succesfully";
		redirect('posts.php?source=');
	} else {
		die("Failed");
	}
}
//unapprove post
if(isset($_GET['unapprove_post']) && $_GET['unapprove_post'] !== "") {
	$app_id = $_GET['unapprove_post'];
	if(modifyStatus($app_id)) {
		$_SESSION['SuccessMessage'] = "Post Unapproved Succesfully";
		redirect('posts.php?source=');
	} else {
		die("Failed");
	}
}

//Edit, Update, modify post
global $connection;
if (isset($_POST['modify'])) {
	$eid = $_POST['editID'];
	$title = $_POST['title'];
	$category = $_POST['category'];
	$author = $_POST['author'];
	$content = $_POST['content'];
	$tags = $_POST['tags'];
	$status = $_POST['status'];
	$img = $_POST['image']; //image to be displayed from the database
	$post_image = $_FILES['post_image']['name']; //Image to be displayed from the user
	$image = "";

	//get post_cat_id
	$sql = mysqli_query($connection, "SELECT cat_id FROM categories WHERE cat_title='$category'");
	$record = mysqli_fetch_array($sql);
	$post_cat_id = $record['cat_id'];

	// Check if user is uploading a new image
	if(isset($_FILES['post_image']) && $post_image != "") {
		$dir = "";
		$filename = $_FILES['post_image']['name'];
		$fileSize = $_FILES['post_image']['size'];
		$fileTmpName = $_FILES['post_image']['tmp_name'];
		$allowed = ['png', 'jpg', 'jpeg', 'gif'];
		$fileExt = explode('.', $filename); //The file Extension
		$fileActExt = strtolower(end($fileExt)); //The file actual extension
		//Check if imag is allowed
		if(!in_array($fileActExt, $allowed)) { //needle and haystack
			echo "<script>alert('File type not allowed!')</script>";
		} else if ($fileSize > 10000000) { //if the filesize is greater thatn 10 mb
			echo "<script>alert('File is too large!') </script>";
		} else {
			$newImage =/* uniqid("pastTimeReviews",true) . "." .*/ $fileActExt; //Addinng extra encoding to the image
			$target = $dir . basename($newImage);
			if(move_uploaded_file($fileTmpName, $target)) {
				$image = $target;
				echo "image moved"; 
			//ASSIGNMENT FIGURE OUT ERROR HANDLING LIKE EMPTY ERRORS	
			} else {
				echo "Image cannot be moved";
			}
		}
	} else {
		$image = $img;
	} 
	//Query to update the posts
	$query = mysqli_query($connection, "UPDATE posts SET post_title='$title', post_author='$author', post_category='$category',post_content='$content', post_status='$status', post_tags='$tags', post_image='$image' WHERE post_id='$eid' ");
	if($query) {
		$_SESSION['SuccessMessage'] = "Post Edited Succesfully Succesfully";
		header("Location: posts.php");
	} else {
		$_SESSION['ErrorMessage'] = "Cannot Edit Post";
		echo  'failed'.mysqli_error($connection);
	}
	//echo "<script>alert('$eid');</script>";

}


?>
<div id="wrapper">

	<!-- Navigation -->
	<?php include 'includes/navigation.php'; ?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
							
					<h1 class="page-header">
						Welcome to the Administration Panel
					</h1>


					<?php
						if (isset($_GET['source'])) {
								$source = $_GET['source'];

						switch ($source) {
							case 'add_new':
								include "includes/add_post.php";
								break;
							case 'edit':
								include "includes/edit_post.php";
								break;
							default:
								include "includes/view_post.php";
								break;
						}
		}else {
			include "includes/view_post.php";
		}
					 ?>
</div>
				</div>


			</div>

			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="bootstrap/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
