
<!DOCTYPE html>
<?php
include("SQLConnection.php");
include("PersonClass.php");
include("EmergContactClass.php");
include("loginheader.php");
?>
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
    
    <title>User Profile | Wildlife Center Volunteers</title>

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

  <div class="row">
    <div class="col-sm-1">
    <!--Spacer-->
    </div> 
    <div class="col-sm-10 vellum">
      <div class="row">
        <div class="col-sm-4">
          <h3>WILDLIFE CENTER OF VIRGINIA</h3>
          <img src="images/nature.png" alt="Logo" class="logo img-responsive">
        </div>
      </div><!--End row-->


        <form action="edit-profile.php" method="post">
        <h1>My Profile <span><small><input type="submit" name="edit" value="edit"></button></small></span></h1>
        </form>

        <div class="row profpic">
            <div class="col-xs-4">
                <?php
                $newSQL = new SQLConnection();
                $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());

                $profileID = $_SESSION["personid"];

                if (isset($_GET["name"]))
                {
                    $_SESSION["adminSearch"] = $_GET["name"];
                    $profileID = $_SESSION["adminSearch"];
                }

                $sqlSelect = "select firstname, middlename, lastname, passwd, email, phone, housenumber, street, citycounty, " .
                    "stateabb, countryabb, zipcode, dob, rabiesowncost, rabiesshot, rabiesdate, rehabpermit, permittype, " .
                    "clocked, lastinDate, lastinTime, lastoutDate, lastoutTime, carpentryskills from person p inner join login l on p.personid = l.personid " .
                    "where p.personid = " . $profileID;
                $result = $conn->query($sqlSelect);

                $newPerson = new Person();

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $newPerson->setFirstName($row["firstname"]);
                        $newPerson->setMiddleInitial($row["middlename"]);
                        $newPerson->setLastName($row["lastname"]);
                        $newPerson->setPassword($row["passwd"]);
                        $newPerson->setEmail($row["email"]);
                        $newPerson->setPhone($row["phone"]);
                        $newPerson->setHouseNumber($row["housenumber"]);
                        $newPerson->setStreet($row["street"]);
                        $newPerson->setCityCounty($row["citycounty"]);
                        $newPerson->setStateAbb($row["stateabb"]);
                        $newPerson->setCountryAbb($row["countryabb"]);
                        $newPerson->setZip($row["zipcode"]);
                        $newPerson->setDOB($row["dob"]);
                        $newPerson->setRabiesOwnCost($row["rabiesowncost"]);
                        $newPerson->setRabiesShot($row["rabiesshot"]);
                        $newPerson->setRabiesDate($row["rabiesdate"]);
                        $newPerson->setRehabilitationPermit($row["rehabpermit"]);
                        $newPerson->setPermitType($row["permittype"]);
                        $newPerson->setClocked($row["clocked"]);
                        $newPerson->setLastInDate($row["lastinDate"]);
                        $newPerson->setLastInTime($row["lastinTime"]);
                        $newPerson->setLastOutDate($row["lastoutDate"]);
                        $newPerson->setLastOutTime($row["lastoutTime"]);
                        $newPerson->setCarpentrySkills($row["carpentryskills"]);

                    }
                }

                $newEmergContact = new EmergContact();
                $sqlSelect = "SELECT * from wcv.emergcontact where personid = " . $profileID;
                $result = $conn->query($sqlSelect);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        $newEmergContact->setFirstName($row["firstname"]);
                        $newEmergContact->setLastName($row["lastname"]);
                        $newEmergContact->setPhone($row["phone"]);
                        $newEmergContact->setRelationship($row["relationship"]);
                    }
                }

                $apStatus = array();
                $sqlSelect = "select apstatus from teamstatus ts inner join person p on ts.personid = p.personid where p.personid = " . $profileID;
                $result = $conn->query($sqlSelect);
                if ($result) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $apStatus[] = $row["apstatus"];
                    }
                }

                $sqlSelect = "select filelocation from documents where personid = " . $profileID . " and docname = 'profilepicture'";
                $result = $conn->query($sqlSelect);
                $picLocation = "profilePictures/profile.jpg";
                if ($result) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $picLocation = $row["filelocation"];
                    }
                }
                ?>
                <img src="<?php echo $picLocation; ?>" class="img-responsive" alt="Profile picture"/>
            </div>
            <div class="col-xs-8">
                <script>
                    function resizeTextBox(txt) {
                        txt.style.width = "1px";
                        txt.style.width = (1 + txt.scrollWidth) + "px";
                    }
                </script>
                <h1>
                    <?php echo $newPerson->getFirstName(); ?>
                    <?php echo $newPerson->getMiddleInitial(); ?>
                    <?php echo $newPerson->getLastName(); ?>
                </h1>
                <h3>
                <?php
                $apStatDisplay = "Inactive";
                if (in_array('active', $apStatus)) {
                    $apStatDisplay = "Active";
                } else if (in_array('pending', $apStatus)) {
                    $apStatDisplay = "Pending";
                } else if (in_array('denied', $apStatus)) {
                    $apStatDisplay = "Denied";
                }
                echo $apStatDisplay . " Volunteer<br>";
                ?>
                </h3>
            </div>

            <!--First column-->
            <div class="col-xs-4">
                <div>
                    <h3>Contact Info</h3>
                    <div class="infoblock">
                        <p>
                            <?php
                            echo $newPerson->getHouseNumber() . " " . ucwords($newPerson->getStreet()) . "</br>" .
                                ucwords($newPerson->getCityCounty()) . " " . strtoupper($newPerson->getStateAbb()) . " " . $newPerson->getZip() . "</br>" .
                                $newPerson->getPhone() . "</br>" .
                                $newPerson->getEmail();
                            ?>

                            <!--<a href=\"mailto:someone@example.com?Subject=Hello%20again\" target=\"_top\">emailexample@example.com</a></p>-->
                        </p>
                    </div>
                </div>
            </div><!--End column-->

            <!--second column-->
            <div class="col-xs-4">
                <div>
                    <h3>Emergency Contact</h3>
                    <div class="infoblock">
                        <p>
                            <?php
                            echo ucwords($newEmergContact->getFirstName()) . " " . ucwords($newEmergContact->getLastName()) . "</br>" .
                                ucwords($newEmergContact->getRelationship()) . "</br>" .
                                $newEmergContact->getPhone();
                            ?>

                        </p>
                    </div>
                </div>
            </div><!--End column-->
        </div> <!--End row-->
    <br>
        <ul class="nav nav-tabs">
            <li id="profile" role="presentation"><button id="button1" class="btn tab active">General</button></li>
            <li id="team" role="presentation"><button id="button2" class="btn tab">Team</button></li>
            <li id="hours" role="presentation"><button id="button3" class="btn tab">Hours/Miles</button></li>
            <li id="documents" role="presentation"><button id="button4" class="btn tab">Documents</button></li>
            <li id="availability" role="presentation" class=""><button id="button5" class="btn tab">Availability</button></li>
        </ul>

        <div id="tab_stuff">
                <!--Profile info from the tabs will go here-->
        </div>
    </div><!--End vellum box-->
</div><!--End row-->

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
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/customscript.js"></script>
  </body>
</html>