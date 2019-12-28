<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 

if(!empty($_GET['id'])) {

    $id = $_GET['id'];
    $usern = User::find_by_id($id);
    

} else {
    redirect("users.php");
}

    $mess = "";

    if(isset($_POST['delete'])) {
        if(!empty($_GET['id'])) {

            $id = $_GET['id'];
            $user = User::find_by_id($id);
            if($user) {
                $user->delete();
                redirect("users.php");
            }else {
                redirect("users.php");
            }

        } else {
            redirect("users.php");
        }
    }

    if(isset($_POST['update'])) {
        $user_name   = $_POST['user_name'];
        $user_pass   = $_POST['user_pass'];
        $first_name  = $_POST['first_name'];
        $last_name   = $_POST['last_name'];

        if(!empty($user_name) && !empty($user_pass) && !empty($first_name) && !empty($last_name)) {
            $usern->username   = $database->escape_string($user_name);
            $usern->password   = $database->escape_string($user_pass);
            $usern->first_name = $database->escape_string($first_name);
            $usern->last_name  = $database->escape_string($last_name);
            if($usern->update()){
                $mess = "<b style='color:green'>User contents updated successfully!</b><br><br>";
            }
            else {
                $mess = "<b style='color:red'>Server Error: Please try again later!</b><br><br>";
            }
        }else {
            $mess = "<b>Fields cannot be empty!</b><br>";
        }
    }

    //$users = user::find_all();

?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
        <?php include("includes/top_nav.php"); ?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
        <?php include("includes/side_nav.php"); ?>

        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <h3><b> Edit <?php echo $usern->username; ?> </b></h3>
            <div class="row">

                <form action ="" method="post">
                    <div class="col-md-4" align="center">
                        <i class="fa fa-user" style="font-size:320px;"></i>
                        <br><br><br>
                        <a href="users.php" class="btn btn-warning btn-lg btn-block" style="color:black;">Go Back to the Users</a> <br/>

                    </div>
                    <div class="col-lg-5" style="background-color:#222; border-radius:6px;">
                        <br>
                        <b>User Settings</b><hr>
                        <?php echo $mess; ?>
                        <div class="form-group">
                            <label>Username :</label>
                            <input type="text" name="user_name" class="form-control" value="<?php echo $usern->username; ?>" />
                        </div>
                        
                        <div class="form-group">
                            <label>Password :</label>
                            <input type="text" name="user_pass" class="form-control" value="<?php echo $usern->password; ?>" />
                        </div>

                        <div class="form-group">
                            <label>FirstName :</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $usern->first_name; ?>" />
                        </div>

                        <div class="form-group">
                            <label>LastName :</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $usern->last_name; ?>" />
                        </div><br>

                        <!-- <div class="form-group">
                            <label>Image File :</label>
                            <input type="file" name="file_upload" class="form-control" />
                        </div><br /> -->
                    </div>
                    <div class="col-md-3">
                        <div  class="user-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="glyphicon glyphicon-calendar"></span> Uploaded on: yesterday @ 5:26
                                    </p>
                                    <p class="text ">
                                        Id: <span class="data user_id_box"><?php echo $usern->id; ?></span>
                                    </p>
                                    <p class="text">
                                        Username: <span class="data"><?php echo $usern->username; ?></span>
                                    </p>
                                    <p class="text">
                                        Password: <span class="data"><?php echo $usern->password; ?></span>
                                    </p>
                                    <p class="text">
                                        FirstName: <span class="data"><?php echo $usern->first_name; ?></span>
                                    </p>
                                    <p class="text">
                                        LastName: <span class="data"><?php echo $usern->last_name; ?></span>
                                    </p>
                                </div><br>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-lg ">
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>   
                                </div>
                            </div>          
                        </div>
                    </div>
                </form> <br /> <br />
            </div>
        </div><br>

    </div>

  <?php include("includes/footer.php"); ?>