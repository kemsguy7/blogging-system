<?php
// This script contains the functionality of the comment. 


(isset($_SESSION['userLogged'])) ? $user = $_SESSION['userLogged'] : $user = "user";
$sql = mysqli_query($connection, "SELECT * FROM users WHERE email='$user'");
$row = mysqli_fetch_array($sql);
$username = $row['username'];
$profile = $row['profile_pic'];
$role = $row['role'];


	class Comment {
		private $con;

		public function __construct($con) {
			$this->con = $con;
		}
		public function addComments($id, $name, $email, $body) {
			if(!empty($body)) {
				$query = mysqli_query($this->con, "INSERT INTO `comments`(comment_name, comment_email, body, comment_status, post_id) VALUES('$name', '$email','$body','unapproved','$id');");
				if(!$query) {
					die("Failed " . mysqli_error($this->con));
				}
			}else{
				return false;
			}
		}

		public function getApprovedComments($id) {
			$query = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id=$id AND comment_status='Approved'");
			$str = "";
			while($row = mysqli_fetch_assoc($query)) {
				$id = $row['id'];
				$post_id = $row['post_id'];
				$name = $row['comment_name'];
				$body = $row['body'];
?>
				<h3><?php echo $name; ?></h3>
                        <p><?php echo $body; ?></</p>
                        <p><a href="#" class="reply rounded">Reply</a></p>
		<?php	}

		}

		public function getComments()
		{
			global $role;
			$query = mysqli_query($this->con, "SELECT * FROM comments ORDER BY id DESC LIMIT 20");
			$str = "";
			if (mysqli_num_rows($query) > 0) {
				while ($row = mysqli_fetch_array($query))
			{
				$id = $row['id'];
				$name = $row['comment_name'];
				$body = $row['body'];
				$email = $row['comment_email'];
				$status = $row['comment_status'];
				$post_id = $row['post_id'];
				// Restricting this functionality to the admin alone
				if($role !== "Admin"){
				$str .= "<tr>
									<td>$id</td>
									<td>$name</td>
									<td>$email</td>
									<td>$body</td>
									<td>$status</td>
									<td>$post_id</td>
								</tr>";
					} else {
						//Call to action buttons for admin to work on comment
						$str .= "<tr>
											<td>$id</td>
											<td>$name</td>
											<td>$email</td>
											<td>$body</td>
											<td>$status</td>
											<td>$post_id</td>
											<td><a href='comment.php?app=$id' class='btn btn-primary'>Change status</a></td>
											<td><a href='comment.php?del_com=$id' class='btn btn-danger'>Delete</a></td>
										</tr>";
					}
			}
			}
			echo $str;
		}
}
