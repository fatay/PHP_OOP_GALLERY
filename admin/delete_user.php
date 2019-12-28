<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 
$get_values = $_POST['getid'];

if(is_array($get_values) && !empty($get_values)) {

    foreach ($get_values as $userid) {
        if($userid==1){
            redirect("users.php");
        } else {
            $user = User::find_by_id($userid);
            $user->delete();
            redirect("users.php");
        }
    }


} else {
    redirect("users.php");
}

?>