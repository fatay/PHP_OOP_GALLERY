<?php include("includes/init.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php

$photo ="";

if(!empty($_GET['id'])) {

    $id = $_GET['id'];
    $photo = Photo::find_by_id($id);

}   

?>

<img src="<?php echo $photo->picture_path();  ?>" style="width:100%;" alt="photo" />