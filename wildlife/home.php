<?php
include ('loginheader.php');
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
    
    <title>Home | Wildlife Center Volunteers</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arimo|Caveat+Brush" rel="stylesheet">
   
    <!--Leave this area commented!-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 <body>
 <?php include("navHeader.php");?>
<div class="container">
  <div class="row">
    <div class="col-sm-1">
    <!--Spacer-->
    </div> 
    <div class="col-xs-12 col-sm-10 vellum">
      <div class="row">
        <div class="col-sm-4">
          <h3>WILDLIFE CENTER OF VIRGINIA</h3>
          <img src="images/nature.png" alt="Logo" class="logo img-responsive">
        </div>
      </div><!--End row-->

    <!--This is the standard user's view of the homepage.-->
        <div id="userview" class="">
            <?php
            if ($_SESSION['permission'] == 1) {
                echo "<h1>Volunteer</h1>";
            } elseif ($_SESSION['permission'] == 0) {
                echo "<h1>Applicant</h1>";
            }
            ?>
          <div class="row">

            <!--Profile icon-->
            <div class="col-sm-4">
              <div class="thumbnail 1">
                <a href="profile.php">
                    <span class="glyphicon glyphicon-user homeicon" aria-hidden="true"></span>
                    <div class="caption">
                        <p>My Profile</p>
                    </div>
                  </a>
              </div>
            
                  <div class="thumbnail 2">
                      <a href="apply-specific.php">
                          <span class="glyphicon glyphicon-check homeicon" aria-hidden="true"></span>
                          <div class="caption">
                              <p>Apply</p>
                          </div>
                      </a>
                  </div>
          
<?php

if ($_SESSION['permission'] >= 1) {
	
    echo '
            <!--Calendar icon-->
            
              <div class="thumbnail 3" >
                <a href = "calendar.php" >
                    <span class="glyphicon glyphicon-calendar homeicon" aria - hidden = "true" ></span >
                    <div class="caption" >
                        <p > Calendar</p >
                    </div >
                  </a >
              </div >
            

            <!--Clock in / out icon-->
            
              <div class="thumbnail 4" >
                <a href = "clockTime.php" >
                  <!--Instead of being a link, this icon changes from "in" to "out" or vice versa depending on your current status-->
                    <span id = "clock_icon" class="glyphicon glyphicon-time homeicon" aria - hidden = "true" ></span >
                    <div class="caption" >
                        <!--Use the span with id = "in_out" to change the word from in to out-->
                        <p > Clock <span id = "in_out" > In</span ></p >
                    </div >
                </a >
              </div >
        ';
        
}
?>

	</div> <!--End column-->

        <div class="col-sm-8 home-info">
          <h2>Welcome!</h2>
          <!--Applicant paragraph-->
          <p>(Applicant paragraph)Thank you for your interest in volunteering with the Wildlife Center. If you haven't already, please fill out an application for a specific volunteer type. You'll be able to log back in and see the status of your application. Best of luck!</p>

          <!--Volunteer paragraph-->
          <p>(Volunteer paragraph)This is your Wildlife Center homepage. Make changes to your profile, update your hours, check the calendar, and sign up for shifts. If you have any questions, contact your team lead!</p>

          <!--Admin paragraph-->
          <p>(Admin paragraph)This is your dashboard for everything you need to handle volunteers at the Wildlife Center. Search the database, review applications, add events to the calendar, and get in contact with everyone easily.</p>

          <h2>Today's Events</h2>
          <p>Feed of the day's events will go here</p>
        </div>

        </div><!--End row-->
        </div> <!--End user view-->
    </div><!--End vellum column-->
  </div><!--End row-->

    <footer>
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
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/customscript.js"></script>
    <!--This is the animation-->
    <script>
        $(document).ready(function() {
            $(".4").hide().delay(1500).fadeIn(1200);
        });

        $(document).ready(function() {
            $(".3").hide().delay(1000).fadeIn(1200);
        });

        $(document).ready(function() {
            $(".2").hide().delay(500).fadeIn(1200);
        });

        $(document).ready(function() {
            $(".1").hide().fadeIn(1200);
        });
    </script>
  </body>
</html>