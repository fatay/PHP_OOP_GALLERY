<?php include("includes/header.php"); ?>
<?php include("admin/includes/init.php"); ?>
<?php
    $photos = Photo::find_all();
?>
<br><br>

<div class="w3-container w3-indigo w3-grayscale-max" align="center" style="height:340px; background:url('elephant.jpg'); background-repeat:no-repeat; border-radius:4px;">
    <br><br><br>
    <form>
    <h1 style="font-weight:bold; background:black; width:30%;">PHP OOP Gallery</h1>
    <input type="text" style="border-radius:6px; width:44%; height:32px; color:black; padding:4px; font-size:16px;" /> &nbsp; <button class="btn btn-primary">Search</button>
    </form>
</div>


<br>
            <!-- Blog Entries Column -->
                    <?php foreach ($photos as $photo) :  ?>
                    <div class="responsive" >
                        <div class="gallery">
                            <a target="_blank" href="">
                            <img src='<?php echo "admin/".$photo->picture_path();  ?>'  alt="photo" width="600" height="400" class="w3-hover-sepia">
                            </a>
                            <div class="desc">
                            <b><?php echo $photo->title; ?></b><br>
                            <small><?php echo $photo->description  ?></small>
                            </div>
                        </div><br>
                    </div>
                    <?php endforeach; ?>
                    
                    <div class="clearfix"></div>


            <!-- Blog Sidebar Widgets Column -->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
