<?php
include ('personclass.php');
//require("SQLConnection.php");
include ("navHeader.php");
global $email, $clocked, $status, $lastIn, $lastOut, $lastInDate, $lastOutDate;
$status = "";
$lastIn = "";
$lastOut = "";

if (isset($_POST["clockTime"]))
{

    $email = $_POST["email"];
    $miles = "";
    if(isset($_POST["miles"])) {
        $miles = $_POST["miles"];
    }

    $person = new Person();
    $clocked = $person->clockTime($email,$miles);

    $newSQL = new SQLConnection();
    $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());

    $sql = "select lastintime, lastouttime, lastindate, lastoutdate from person p inner join login l on p.personid = l.personid where email = '".$email."'";
    $result = $conn->query($sql);
    if($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $lastIn = $row['lastintime'];
            $lastOut = $row['lastouttime'];
            $lastInDate = $row['lastindate'];
            $lastOutDate = $row['lastoutdate'];
        }
    }else{echo 'SQL ERROR';}

    if ($clocked == 0) {
        $status = "Clocked in: ".$lastIn." on ".$lastInDate;
    }
    else{
        $status = "Clocked in: ".$lastIn." on ".$lastInDate."<br />Clocked out: ".$lastOut." on ".$lastInDate;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="The website for Wildlife Center volunteers">
    <meta name="keywords" content="wildlife, volunteer, virginia">
    <meta name="author" content="Shanice McCormick and Nicole Moran">

    <title>clockin</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arimo|Caveat+Brush" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="row">
    <div class="col-sm-3">
        <!--Spacer-->
    </div>
    <div class="col-xs-12 col-sm-6 vellum">
        <div class="row">
            <div class="col-sm-6">
              <h3>WILDLIFE CENTER OF VIRGINIA</h3>
              <img src="images/nature.png" alt="Logo" class="logo img-responsive">
            </div>
        </div><!--End row-->

        <div class="row">
            <div class="col-sm-2">
                <!--Spacer-->
            </div>
            <div class="col-sm-8">
                <h1>Clock In / Clock Out</h1>
                <form action="clockTime.php" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="name" type="text" class="form-control" name="email" placeholder="E-mail">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="mileage">
                    </div>
                    <h5><?php echo $status; ?></h5>
                    <button type="submit" name="clockTime" class="btn btn-default">Clock In/Out
                    </button></a>
                    <a href="home.php"> <button type="button" class="btn btn-default">Back</button></a>


                </form>
            </div><!--End centered collumn-->
        </div><!--End row-->
    </div> <!--End column-->
</div><!--End rowr-->

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-xlarge">
    <i class="fa fa-facebook-official w3-hover-opacity" onclick="window.location='https://www.facebook.com/wildlifecenter/'"></i>
    <i class="fa fa-instagram w3-hover-opacity" onclick="window.location='https://www.instagram.com/explore/locations/292750036/'"></i>
    <i class="fa fa-youtube w3-hover-opacity" onclick="window.location='https://www.youtube.com/user/WildlifeCenterVA'"></i>
    <i class="fa fa-twitter w3-hover-opacity" onclick="window.location='https://twitter.com/WCVtweets'"></i>
    <i class="fa fa-linkedin w3-hover-opacity" onclick="window.location='https://www.linkedin.com/company/wildlife-center-of-va'"></i>
    <p class="w3-medium">Visit us at <a href="http://wildlifecenter.org/" target="_blank">WildLifeCenter.org</a></p>
    <p class="w3-medium">© 2017 The Wildlife Center of Virginia. All Rights Reserved.</p>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>