<?php include("includes/init.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php

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


?>