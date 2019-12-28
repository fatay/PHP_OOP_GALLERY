<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 

    $users = User::find_all();
    if(isset($_POST['add_user'])) {
        $user_name  = $_POST['user_name'];
        $user_pass  = $_POST['user_pass'];
        $user_first = $_POST['user_first'];
        $user_last  = $_POST['user_last'];
        if(!empty($user_name) && !empty($user_pass) && !empty($user_first) && !empty($user_last)){
            $user = new User();
            $user->username     = $user_name;
            $user->password     = $user_pass;
            $user->first_name   = $user_first;
            $user->last_name    = $user_last;

            $sql = "SELECT * from users WHERE username='{$user_name}'";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) == 0) {
                $user->create();
                redirect("users.php");
            }
        }
    }

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            <?php include("includes/top_nav.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            
            <?php include("includes/side_nav.php"); ?>


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <!-- admin-content -->

            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users
                        <small>All users here.</small>
                    </h1>

                    <div class="col-md-12">
                    <button style="margin-left:16px;" name="add_user" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModal">Add User</button>

                        <form action="delete_user.php" method="post">
                            <table style="width: 100%; text-align:center;">
                                <thead>
                                    <tr>    
                                        <th><b>#</b></th>
                                        <th><b>Id</b></th>
                                        <th><b>Username</b></th>
                                        <th><b>Password</b></th>
                                        <th><b>First Name</b></th>
                                        <th><b>Last Name</b></th>
                                        <th><b>Update</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) :  ?>
                                        <tr>
                                            <td>
                                                <input name="getid[]" type="checkbox" value="<?php echo $user->id ?>">
                                            </td>
                                            <td><?php echo $user->id; ?></td>
                                            <td><?php echo $user->username; ?></td>
                                            <td><?php echo $user->password; ?></td>
                                            <td><?php echo $user->first_name; ?></td>
                                            <td><?php echo $user->last_name; ?></td>
                                            <td><a href="edit_user.php?id=<?php echo $user->id ?>  " class="btn btn-warning" style="color:black; padding:4px; font-size:12px;">Update</button</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <input style="margin-left:12px;"  type="submit" value="Delete Selected Users" class="btn btn-danger btn-block"/>
                        </form>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="unKnown">Username: </label>
                                            <input class="form-control" type="text" name="user_name" autocomplete="new-password" placeholder="Username" />
                                        </div>
                                        <div class="form-group">
                                            <label for="unKnown">Password: </label>
                                            <input class="form-control" type="text" name="user_pass" autocomplete="new-password" placeholder="Password" />
                                        </div>
                                        <div class="form-group">
                                            <label for="unKnown">First Name: </label>
                                            <input class="form-control" type="text" name="user_first" autocomplete="new-password" placeholder="First Name" />
                                        </div>
                                        <div class="form-group">
                                            <label for="unKnown">Last Name: </label>
                                            <input class="form-control" type="text" name="user_last" autocomplete="new-password" placeholder="Last Name" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input  type="submit" value="Add User" name="add_user" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <br /> <br />
    <!-- /.row -->

</div>
<!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>