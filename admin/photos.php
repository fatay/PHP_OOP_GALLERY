<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 

    $photos = Photo::find_all();

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            <?php include("includes/top_nav.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            
            <?php include("includes/side_nav.php"); ?>


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" style="overflow-y:scroll;">

            <!-- admin-content -->

            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Photos
                        <small>All photos here.</small>
                    </h1>

                    <div class="col-md-12">
                        <table style="width: 100%; text-align:center;">
                            <thead>
                                <tr>
                                    <th><b>Id</b></th>
                                    <th><b>Photo</b></th>
                                    <th><b>FileName</b></th>
                                    <th><b>Title</b></th>
                                    <th><b>Description</b></th>
                                    <th><b>Size</b></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($photos as $photo) :  ?>

                                    <tr>
                                        <td><?php echo $photo->id; ?></td>
                                        <td>
                                            <img class="boxp" src="<?php echo $photo->picture_path();  ?>" style="width:120px;" alt="photo" />
                                            <div class="pictures_link">
                                                <a class="men" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                                <a class="men" href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                                <a class="men" target="_blank" href="view_photo.php?id=<?php echo $photo->id; ?>">View</a>                                                                                                                               
                                            </div>    
                                        </td>
                                        <td><?php echo $photo->filename; ?></td>
                                        <td><?php echo $photo->title; ?></td>
                                        <td><?php echo $photo->description; ?></td>
                                        <td><?php echo $photo->size. " Bytes"; ?></td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table><br><br>
                    </div>



                </div>
            </div> 
    <!-- /.row -->

</div>
<!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>