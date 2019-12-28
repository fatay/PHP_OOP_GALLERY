<?php include("init.php"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard
                <small>All statistics here.</small>
            </h1>

        



            <?php

                $sql = 'SELECT * from photos';
                $result = mysqli_query($connection, $sql);
                $photo_say = mysqli_num_rows($result);

                $sql2 = 'SELECT * from users';
                $result2 = mysqli_query($connection, $sql2);
                $user_say = mysqli_num_rows($result2);

            ?>

            <div class="row">
                <div class="col-sm-4">
                    <div class="w3-panel w3-white"><br />
                    <div id="piechart" style="width: 100%;"></div><br>
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="w3-panel w3-blue-gray"><br />
                        <i class="fa fa-user fase" > <span class="ispan">Users</span></i><hr>
                        <h1><?php echo $user_say; ?></h1>
                        <p>There are <?php echo $user_say; ?> users in your gallery system.</p><br />
                        <div style="margin-top:12px;"></div>
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="w3-panel w3-blue-gray"><br />
                        <i class="fa fa-image fase" > <span class="ispan">Photos</span></i><hr>
                        <h1><?php echo $photo_say; ?></h1>
                        <p>There are <?php echo $photo_say; ?> photos in your gallery system.</p><br />
                        <div style="margin-top:12px;"></div>
                    </div> 
                </div>
            </div>



            <?php 
            
                

                /*
                $user = new User();
                $user->username     = "fatih06";
                $user->password     = "123456";
                $user->first_name   = "fatih";
                $user->last_name    = "aydin";

                $user->create();
                */

                /*
                $users = User::find_all();
                foreach ($users as $user) {
                    echo $user->username;
                }
                */

                //ctrl+k+c = comment on
                //ctrl+k+u = uncomment.
                //OR SHIFT ALT A MORE USEFUL

                /* $user = new User();
                $user->username = "NEW";
                $user->save(); */

                /* $photos = Photo::find_all();
                foreach ($photos as $photo) {
                    echo $photo->title;
                } */

                /* $photo = new Photo();
                $photo->title           = "My Car Photo";
                $photo->description     = "My New Ford Mustang";
                $photo->filename        = "car.png";
                $photo->type            = "PNG";
                $photo->size            = 2;

                $photo->create(); */

                /* echo INCLUDES_PATH ."<br>";
                echo SITE_ROOT; */


            ?>                                 
                                
        </div>
    </div>


    <!-- /.row -->

</div>
<!-- /.container-fluid -->
