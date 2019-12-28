<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 

if(!empty($_GET['id'])) {

    $id = $_GET['id'];
    $photo = Photo::find_by_id($id);
    

} else {
    redirect("photos.php");
}

    $mess = "";

    if(isset($_POST['delete'])) {
        if(!empty($_GET['id'])) {

            $id = $_GET['id'];
            $photo = Photo::find_by_id($id);
            if($photo) {
                $photo->delete_photo();
                redirect("photos.php");
            }else {
                redirect("photos.php");
            }

        } else {
            redirect("photos.php");
        }
    }

    if(isset($_POST['update'])) {
        $new_title = $_POST['title'];
        $new_desc  = $_POST['desc'];

        if(!empty($new_title) && !empty($new_desc)) {
            $photo->title = $database->escape_string($new_title);
            $photo->description = $database->escape_string($new_desc);
            if($photo->update()){
                $mess = "<b style='color:green'>Image contents updated successfully!</b><br><br>";
            }
            else {
                $mess = "<b style='color:red'>Server Error: Please try again later!</b><br><br>";
            }
        }else {
            $mess = "<b>Fields cannot be empty!</b><br>";
        }
    }

    //$photos = Photo::find_all();

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
            <h3><b> Edit Photo </b></h3>
            <hr>
            <div class="row">

                <form action ="" method="post">
                    <div class="col-md-4">
                        <img src="<?php echo $photo->picture_path();  ?>" alt="photo" style="width:100%;" />
                        <br>
                    </div>
                    <div class="col-lg-5" style="background-color:#EFE8E8;">
                        <br>
                        <h4>Image Attributes</h4>
                        <?php echo $mess; ?>
                        <div class="form-group">
                            <label>Image Title :</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>" />
                        </div>
                        
                        <div class="form-group">
                            <label>Image Description :</label>
                            <input type="text" name="desc" class="form-control" value="<?php echo $photo->description; ?>" />
                        </div>

                        <!-- <div class="form-group">
                            <label>Image File :</label>
                            <input type="file" name="file_upload" class="form-control" />
                        </div><br /> -->
                        <a href="photos.php" class="btn btn-warning btn-lg btn-block" style="color:black;">Go Back to the Album</a> <br/>
                    </div>
                    <div class="col-md-3">
                        <div  class="photo-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="glyphicon glyphicon-calendar"></span> Uploaded on: yesterday @ 5:26
                                    </p>
                                    <p class="text ">
                                        Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                    </p>
                                    <p class="text">
                                        Filename: <span class="data"><?php echo $photo->filename; ?></span>
                                    </p>
                                    <p class="text">
                                        File Type: <span class="data"><?php echo $photo->type; ?></span>
                                    </p>
                                    <p class="text">
                                        File Size: <span class="data"><?php echo $photo->size; ?></span>
                                    </p>
                                </div><br />
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