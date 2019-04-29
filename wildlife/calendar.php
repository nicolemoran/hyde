

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
    
    <title>Calendar | Wildlife Center Volunteers</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arimo|Caveat+Brush" rel="stylesheet">


    <!--Leave this area commented!-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

      <link rel='stylesheet' href='calendar/fullcalendar.css' />
      <script src='calendar/lib/jquery.min.js'></script>
      <script src='calendar/lib/moment.min.js'></script>
      <script src='calendar/fullcalendar.js'></script>


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

        <h1>Calendar</h1>
        <a href="home.php" class="back">Back to homepage</a>
            <div id="events-calendar"></div>
        <div id="eventdetails"></div>




    </div><!--End vellum box-->
  </div><!--End row-->

<footer>
	<p>© 2017 The Wildlife Center of Virginia. All Rights Reserved.</p>
</footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/customscript.js"></script>
    <script src="calendar/lib/moment.min.js"></script>
    <script src="calendar/fullcalendar.js"></script>
    <script src="js/events.js"></script>
  </body>
</html>