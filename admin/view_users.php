<?php session_start();   ?>
<?php include 'includes/header.php'; 
//This script displays the users in the Admin section in view_users.php page

function showusers() {
    global $connection;
    $user = $_SESSION['userLoggedIn'];
    $sql = mysqli_query($connection, "SELECT * FROM users WHERE email='$user'");
    $row = mysqli_fetch_array($sql);
    $role = $row['role'];
    $query = mysqli_query($connection, "SELECT * FROM users ORDER BY id DESC");
    while($row = mysqli_fetch_array($query)) {
        $str = "";
        $username = $row['username'];
        $id = $row['id'];
        $email = $row['email'];
        if($role === "Admin") {
            echo  "<tr>" 
                    ."<td>$username </td>"
                    ."<td>$email </td>"
                    ."<td><a href='?duid=$id' class='btn btn-danger'>Delete</a></td>"
                    ."</tr>";
        } else {
            echo "<tr>" 
                    ."<td>$username </td>"
                    ."<td>$email </td>"
                    ."</tr>";
        } 
    } 
}


//Call to action (Delete button)
if(isset($_GET['duid'])) {
    $duid = $_GET['duid'];
    $sql = mysqli_query($connection, "DELETE FROM users WHERE id=$duid");
    if($sql) {
        header("Location: view_users.php");
    } else {
        die("Failed".mysqli_error($connection));
    }
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
					<div class="table-header"> 
                        <table class="table table-bordered table-hover table-stripped table-success">
                            <thead> 
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                            </thead>
                            <tbody> 
                    <?php showusers(); ?>
                            </tbody>
                        </table>
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
