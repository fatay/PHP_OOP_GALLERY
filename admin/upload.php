<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 
    $flag = false;
    $message = array();
    if(isset($_POST['submit'])) {
        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->description = $_POST['desc'];
        $photo->set_file($_FILES['file_upload']);

        if($photo->save()) {
            $flag = true;
        }else {
            $message[] = $photo->errors;
            $flag = false;
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
                        Upload
                        <small>Upload image here.</small>
                    </h1>
                    
                    <?php
                    
                    echo "<b>";
                    if($flag == true) {
                        echo "Image Uploaded Successfully. <br>";
                    }else {
                        foreach ($message as $err=>$val) {
                            echo $val[$err]."<br >";
                        }
                    }

                    
                    echo "</b><br />"; ?>
                </div>
            </div>
    <!-- /.row -->
            
            <div class="col-md-6">
                <!-- form to uploading files UI  // if type is file enctype must be added -->
                <form action ="upload.php" enctype="multipart/form-data" method="post">

                    
                    <div class="form-group">
                        <label>Image Title :</label>
                        <input type="text" name="title" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                        <label>Image Description :</label>
                        <input type="text" name="desc" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Image File :</label>
                        <input type="file" name="file_upload" class="form-control" />
                    </div><br />
                    
                    <input type="submit" name="submit" value="Upload" class="btn btn-info" />
                </form><br /><br />
            </div> 

</div>
<!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>