<?php 
    require_once("init.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="./css/styles.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        <?php 

            $sql = 'SELECT * from photos';
            $result = mysqli_query($connection, $sql);
            $photo_say = mysqli_num_rows($result);

            $sql2 = 'SELECT * from users';
            $result2 = mysqli_query($connection, $sql2);
            $user_say = mysqli_num_rows($result2);
        ?>
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Photos',     <?php echo $photo_say; ?>],
          ['Users',      <?php echo $user_say; ?>]
        ]);

        var options = {
          title: 'Photo / User Index'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <style>
    
      #page-wrapper{
        background:#4b5267;
        color:#cfdbd5;
        height:93vh;
      }

      h1{
        color:#c4cbca;
      }

      hr{
        border-color:#4b5267;
      }

      small{
        color:#222222 !important;
      }
    
    </style>
</head>

<body>

    <div id="wrapper">