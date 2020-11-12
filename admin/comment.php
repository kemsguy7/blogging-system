<!-- This script serves to display the comments  on the admin dashboard-->
<?php
include 'includes/header.php';
include 'includes/helper.php'; 
//Beggining of delete comment



?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                          <h1 class="page-header">
                           Un-Approved Comments
                        </h1>
                        <div class="table-responsive">
                          <table class="table table-striped table-hover table-bordered">
                            <tr>
                              <th>No.</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Body</th>
                              <th>Status</th>
                              <th>Post ID</th>
                              <th>Approve</th>
                              <th>Delete Comment</th>
                              <th>Details</th>
                                </tr>
                                <?php 
                                  global $connection;
                                  $query = "SELECT * FROM comments WHERE comment_status='unapproved' ORDER BY datetime desc ";
                                  $Execute = mysqli_query($connection, $query);
                                  $SrNo = 0;
                                  while ($row = mysqli_fetch_Array($Execute)) {
                                    $CommentId = $row['id'];
                                    $DateTimeofComment = $row['datetime'];
                                    $PersonName = $row['comment_name'];
                                    $email = $row['comment_email'];
                                    $PersonComment = $row['body'];
                                    $status = $row['comment_status'];
                                    $CommentedPostId = $row['post_table_id'];
                                    $SrNo++;
                                   // if(strlen($PersonComment) > 18) { $PersonComment = substr($PersonComment, 0, 18).'...';}
                                   // if(strlen($PersonName) > 10) { $PersonName = substr($PersonName, 0, 10).'...';}
                                ?>
                                <tr> 
                                <td><?php echo htmlentities($SrNo); ?> </td> 
                                    <td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?> </td>
                                    <td><?php echo htmlentities($email); ?> </td>
                                    <td><?php echo htmlentities($PersonComment); ?> </td>
                                    <td><?php echo htmlentities($status); ?> </td>
                                    <td><?php echo htmlentities($CommentedPostId); ?> </td>
                                    <td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span> </a> </td>
                                    <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span> </a> </td>
                                    <td><a href="../single.php?post=<?php echo $CommentedPostId; ?>"><span class="btn btn-primary">Live Preview</span> </a> </td>

                                </tr>
                              <?php } ?>                                        
                          </table>
                        </div>


                        <h1 class="page-header">
                           Approved Comments
                        </h1>
                        <div class="table-responsive">
                          <table class="table table-striped table-hover table-bordered">
                            <tr>
                              <th>No.</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th> Comment</th>
                              <th>Approved By </th>
                              <th>Status</th>
                              <th>Post ID</th>
                              <th>Revert Approved Comments</th>
                              <th>Delete Comment</th>
                              <th>Details</th>
                                </tr>
                                <?php 
                                  global $connection;
                                  $query = "SELECT * FROM comments WHERE comment_status='approved' ORDER BY datetime desc ";
                                  $Execute = mysqli_query($connection, $query);
                                  $SrNo = 0;
                                  while ($row = mysqli_fetch_Array($Execute)) {
                                      $CommentId = $row['id'];
                                      $DateTimeofComment = $row['datetime'];
                                      $PersonName = $row['comment_name'];
                                      $email = $row['comment_email'];
                                      $PersonComment = $row['body'];
                                      $status = $row['comment_status'];
                                      $CommentedPostId = $row['post_table_id']; //id that relates the comments to the specific post
                                      $SrNo++;
                                      $Admin = 'Matthew Idungafa';
                                    //  if(strlen($PersonComment) > 18) { $PersonComment = substr($PersonComment, 0, 18).'...';}
                                     // if(strlen($PersonName) > 10) { $PersonName = substr($PersonName, 0, 10).'...';}

                                ?>
                                <tr> 
                                <td><?php echo htmlentities($SrNo); ?> </td> 
                                    <td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?> </td>
                                    <td><?php echo htmlentities($email); ?> </td>
                                    <td><?php echo htmlentities($PersonComment); ?> </td>
                                    <td><?php echo htmlentities($Admin); ?> </td>
                                    <td><?php echo htmlentities($status); ?> </td>
                                    <td><?php echo htmlentities($CommentedPostId); ?> </td>
                                    <td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-warning">DisApprove</span> </a> </td>
                                    <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span> </a> </td>
                                    <td><a href="../single.php?post=<?php echo $CommentedPostId; ?>"><span class="btn btn-primary">Live Preview</span> </a> </td>
                                </tr>
                              <?php } ?>                                        
                          </table>
                        </div>


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
