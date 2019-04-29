<?php
include("loginheader.php");
include("teamLeadHeader.php");
include ("navHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
<div class="container">
    <div class="row">
        <div class="col-sm-1">
            <!--Spacer-->
        </div>
        <div class="col-xs-12 col-sm-10 vellum">
            <a href="logout.php">
                <button type="button" class="btn btn-link">Log Out</button>
            </a>
            <div class="row">
                <div class="col-sm-4">
                  <h3>WILDLIFE CENTER OF VIRGINIA</h3>
                  <img src="images/nature.png" alt="Logo" class="logo img-responsive">
                </div>
            </div><!--End row-->

            <!--This is the admin view of the homepage-->
            <div id="adminview">
                <h1>Administrator</h1>
                <div class="row">

                    <!--Search icon-->
                    <div class="col-xs-4">
                        <div class="thumbnail">
                            <a href="search.php">
                                <span class="glyphicon glyphicon-search homeicon" aria-hidden="true"></span>
                                <div class="caption">
                                    <p>Search Volunteers</p>
                                </div>
                            </a>
                        </div>
                    

                    <!--Calendar icon-->
                    
                        <div class="thumbnail">
                            <a href="calendar.php">
                                <span class="glyphicon glyphicon-calendar homeicon" aria-hidden="true"></span>
                                <div class="caption">
                                    <p>Calendar</p>
                                </div>
                            </a>
                        </div>

                    <!--Map icon-->
                    
                        <div class="thumbnail">
                            <a href="map.php">
                                <span class="glyphicon glyphicon-map-marker homeicon" aria-hidden="true"></span>
                                <div class="caption">
                                    <p>Transporter Map</p>
                                </div>
                            </a>
                        </div>
                    

                    <!--Mail icon-->
                        <div class="thumbnail">
                            <a href="mail.php">
                                <span class="glyphicon glyphicon-envelope homeicon" aria-hidden="true"></span>
                                <div class="caption">
                                    <p>Mail</p>
                                </div>
                            </a>
                        </div>
                    </div><!--End column-->

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

                </div> <!--End row-->
            </div> <!--End admin view-->
        </div><!--End vellum column-->
    </div><!--End row-->

    <footer>
        <p>© 2017 The Wildlife Center of Virginia. All Rights Reserved.</p>
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
