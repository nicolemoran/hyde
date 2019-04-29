<!DOCTYPE html>
<?php
include("SQLConnection.php");
include("PersonClass.php");
include("EmergContactClass.php");
include("loginheader.php");
include("outreachClass.php");
include("animalCareClass.php");
include("transportClass.php");
include("treatmentClass.php");

$profileID = $_SESSION["personid"];

if (isset($_SESSION["adminSearch"]))
{
    $profileID = $_SESSION["adminSearch"];
}

$newSQL = new SQLConnection();
$conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());

//determine which types of volunteers the user is and then display the relevant information
$teamName = array();
$apStatus = array();
$sqlSelect = "select teamname, apstatus from team t inner join teamstatus ts on t.teamid = ts.teamid inner join person p "
    . "on ts.personid = p.personid where p.personid = " . $profileID;
$result = $conn->query($sqlSelect);
if ($result) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $teamName[] = $row["teamname"];
        $apStatus[] = $row["apstatus"];
    }
}

$anCare = 0;
$ftDesk = 0;
$outreach = 0;
$trans = 0;
$treat = 0;

for ($i = 0; $i < count($teamName); $i++) {
    if (strtolower($teamName[$i]) == 'animal care') {
        if (strtolower($apStatus[$i]) == 'active' || strtolower($apStatus[$i]) == 'inactive') {
            $anCare = 1;
        }
    } else if (strtolower($teamName[$i]) == 'front desk') {
        if (strtolower($apStatus[$i]) == 'active' || strtolower($apStatus[$i]) == 'inactive') {
            $ftDesk = 1;
        }
    } else if (strtolower($teamName[$i]) == 'outreach') {
        if (strtolower($apStatus[$i]) == 'active' || strtolower($apStatus[$i]) == 'inactive') {
            $outreach = 1;
        }
    } else if (strtolower($teamName[$i]) == 'transporter') {
        if (strtolower($apStatus[$i]) == 'active' || strtolower($apStatus[$i]) == 'inactive') {
            $trans = 1;
        }
    } else if (strtolower($teamName[$i]) == 'treatment') {
        if (strtolower($apStatus[$i]) == 'active' || strtolower($apStatus[$i]) == 'inactive') {
            $treat = 1;
        }
    }
}
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
<form action="edit-profile.php" method="post" enctype="multipart/form-data">

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

        <h1>My Profile <span><small><input type="submit" name="save" value="save"></button></small></span></h1>
        <a href="home.php" class="back">Back to homepage</a>

        <?php
        $sqlSelect = "select firstname, middlename, lastname, passwd, email, phone, housenumber, street, citycounty, " .
            "stateabb, countryabb, zipcode, dob, rabiesowncost, rabiesshot, rabiesdate, rehabpermit, permittype, " .
            "clocked, lastinDate, lastinTime, lastoutDate, lastoutTime, carpentryskills from person p inner join login l on p.personid = l.personid " .
            "where p.personid = " . $profileID;
        $result = $conn->query($sqlSelect);

        $newPerson = new Person();
        //echo $profileID;

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
        $sqlSelect = "SELECT firstname, lastname, phone, relationship from wcv.emergcontact where personid = " . $profileID;
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
        ?>
  		<div class="col-xs-12">
  			<div class="row profpic">
  				<div class="col-xs-4">
                    <?php

                        echo "Select image to upload:";
                        echo '<input type="file" name="fileToUpload" id="fileToUpload"></br>';
                        echo '<input type="submit" value="Upload Image" name="btnImage">';

                    // Check if image file is a actual image or fake image
                    if(isset($_POST["btnImage"]) && !empty($_FILES["fileToUpload"]["name"])) {
                        $query = "select max(documentID) as 'maxid' from documents";
                        $conn->query($query);
                        $result = $conn->query($query);
                        $pictureID = 0;
                        if ($result) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $pictureID = $row["maxid"] + 1;
                            }
                        }

                        $target_dir = "profilePictures/";
                        $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
                        $fileName = $pictureID . "." . $imageFileType;
                        $target_file = $target_dir . $fileName;

                        $query = "select fileLocation from documents where personid = " . $_SESSION['personid'] . " and docName = 'profilepicture';";
                        $conn->query($query);
                        $result = $conn->query($query);
                        $oldPictureID = "oldPicture";
                        if ($result) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $oldPictureID = $row["fileLocation"];
                            }
                        }

                        $query = "delete from documents where personid = " . $profileID . " and docname = 'profilepicture'";
                        $conn->query($query);

                        $todayDate = date("Y-m-d");
                        $query = "insert into documents values (null, " . $_SESSION['personid'] . ", 'profilepicture', '" . $imageFileType . "', '" . $fileName . "', '" . $target_file . "', null, '" .  $todayDate . "')";
                        $conn->query($query);

                        /*$record = $conn->affected_rows;
                        if ($record > 0) {
                            echo "New records created successfully";
                        }
                        if (mysqli_errno($conn) != 0) {
                            echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "</br>";
                        }*/

                        $uploadOk = 1;
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if ($check !== false) {
                            //echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }

                        // Check delete existing file
                        if (file_exists($oldPictureID) && $oldPictureID != 'profilepictures/profile.jpg')  {
                            unlink($oldPictureID);
                        }
                        // Check file size
                        if ($_FILES["fileToUpload"]["size"] > 500000) {
                            echo "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif") {
                            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } else {
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        }
                        echo "</br>";
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
                        <input <?php if(!isset($_POST['edit'])) { echo 'class="header" readonly'; } else { echo 'class="noBoarder"'; } ?> onkeyup="resizeTextBox(this)" name="firstName" type="text" value="<?php echo $newPerson->getFirstName(); ?>">
                        <input <?php if(!isset($_POST['edit'])) { echo 'class="header" readonly'; } else { echo 'class="noBoarder"'; } ?> onkeyup="resizeTextBox(this)" name="middleName" type="text" value="<?php echo $newPerson->getMiddleInitial(); ?>">
                        <input <?php if(!isset($_POST['edit'])) { echo 'class="header" readonly'; } else { echo 'class="noBoarder"'; } ?> onkeyup="resizeTextBox(this)" name="lastName" type="text" value="<?php echo $newPerson->getLastName(); ?>">
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
                                House Number: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="houseNumber" type="text" value="<?php echo $newPerson->getHouseNumber(); ?>"></br>
                                Street: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="street" type="text" value="<?php echo $newPerson->getStreet(); ?>"></br>
                                City/County: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="cityCounty" type="text" value="<?php echo $newPerson->getCityCounty(); ?>"></br>
                                State: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="stateAbb" type="text" value="<?php echo $newPerson->getStateAbb(); ?>"></br>
                                Zip Code: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="zipCode" type="text" value="<?php echo $newPerson->getZip(); ?>"></br>
                                Phone: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="phone" type="text" value="<?php echo $newPerson->getPhone(); ?>"></br>
                                Email: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="email" type="text" value="<?php echo $newPerson->getEmail(); ?>"></br>
                                <!--<a href=\"mailto:someone@example.com?Subject=Hello%20again\" target=\"_top\">emailexample@example.com</a></p>-->
                            </p>
                        </div>
                    </div>

                </div><!--End column-->

                <!--Second column-->
                <div class="col-xs-4">


                    <!-- here -->
                    <div>
                        <h3>Emergency Contact</h3>
                        <div class="infoblock">
                            <p>
                                First Name: <input <?php if(!isset($_POST['edit'])) { echo 'class="cboName" readonly'; } else { echo 'class="noBoarder"'; } ?> name="emergFirstName" type="text" value="<?php echo $newEmergContact->getFirstName(); ?>"></br>
                                Last Name: <input <?php if(!isset($_POST['edit'])) { echo 'class="cboName" readonly'; } else { echo 'class="noBoarder"'; } ?> name="emergLastName" type="text" value="<?php echo $newEmergContact->getLastName(); ?>"></br>
                                Relationship: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="emergRel" type="text" value="<?php echo $newEmergContact->getRelationship(); ?>"></br>
                                Phone: <input <?php if(!isset($_POST['edit'])) { echo 'class="textbox" readonly'; }  ?> name="emergPhone" type="text" value="<?php echo $newEmergContact->getPhone(); ?>"></br>
                            </p>
                        </div>
                    </div>

                </div><!--End column-->
  			</div> <!--End row-->
            <br>
<?php
if ($outreach == 1) {
    echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="team">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      Outreach
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">';
                                $sqlSelect = "select concat(tl.firstname, ' ', tl.lastname) as 'name' from teamlead tl inner join "
                                    . "team t on tl.teamLeadid = t.teamleadid inner join teamstatus ts on t.teamid = ts.teamid inner join "
                                    . "person p on ts.personid = p.personid where teamname = 'outreach' and p.personid = " . $profileID;
                                $result = $conn->query($sqlSelect);
                                $teamLead = "";
                                if ($result) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $teamLead = $row["name"];
                                    }
                                }
                                echo '<div>
                                    <h3>Team Leader</h3>
                                    <div class="infoblock">
                                        <p><?php echo $teamLead; ?></p>
                                    </div>
                                </div>';

                                $sqlSelect = "select outreachid, shadowed, shodowed1, shadowed2, shadowed3, intro, leadalone, "
                                                . "offsite, notes from outreach where outreachid = " . $profileID;
                                $result = $conn->query($sqlSelect);

                                $newOutreach = new outreach();

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $newOutreach->setNumShadows($row["shadowed"]);
                                        $newOutreach->setShadowed1Date($row["shodowed1"]);
                                        $newOutreach->setShadowed2Date($row["shadowed2"]);
                                        $newOutreach->setShadowed3Date($row["shadowed3"]);
                                        $newOutreach->setIntro($row["intro"]);
                                        $newOutreach->setLeadAlone($row["leadalone"]);
                                        $newOutreach->setOffsite($row["offsite"]);
                                        $newOutreach->setNotes($row["notes"]);
                                    }
                                }

                                echo '<h1>Outreach Fields</h1>

                                <b>Number of times shadowed:</b></br>
                                <p> Date of first shadow: <input type="date" name="dateShadow1" value="' . $newOutreach->getShadowed1Date(). '</br>' .
                                    'Date of second shadow: <input type="date" name="dateShadow2" value="' . $newOutreach->getShadowed2Date() . '</br>' .
                                    'Date of third shadow: <input type="date" name="dateShadow3" value="' . $newOutreach->getShadowed3Date() . '</br></p>' .
                                'Introduction:<input type="radio" name="intro" value="1" '; if ($newOutreach->getIntro() == 1) { echo "checked"; } echo '> Yes
                                <input type="radio" name="intro" value="0" '; if ($newOutreach->getIntro() == 0) { echo "checked"; } echo '> No</br>
                                Lead tour alone:<input type="radio" name="alone" value="1" '; if ($newOutreach->getLeadAlone() == 1) { echo "checked"; } echo '> Yes
                                <input type="radio" name="alone" value="0" '; if ($newOutreach->getLeadAlone() == 0) { echo "checked"; } echo '> No</br>
                                Offsite:<input type="radio" name="offsite" value="1" '; if ($newOutreach->getOffsite() == 1) { echo "checked"; } echo '> Yes
                                <input type="radio" name="offsite" value="0" '; if ($newOutreach->getOffsite() == 0) { echo "checked"; } echo '> No</br></br>
                                Notes:</br>
                                <textarea rows="4" name="outreachNotes" cols="50" maxlength="255" placeholder="Enter notes here.">' . $newOutreach->getNotes() . '</textarea>
                            </div>
                        </div>
                    </div>';
}
if ($anCare == 1) {
              echo '<div class="team">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Animal Care
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">';
                                $sqlSelect = "select concat(tl.firstname, ' ', tl.lastname) as 'name' from teamlead tl inner join "
                                    . "team t on tl.teamLeadid = t.teamleadid inner join teamstatus ts on t.teamid = ts.teamid inner join "
                                    . "person p on ts.personid = p.personid where teamname = 'animal care' and p.personid = " . $profileID;
                                $result = $conn->query($sqlSelect);
                                $teamLead = "";
                                if ($result) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $teamLead = $row["name"];
                                    }
                                }

                            echo '<div>
                                    <h3>Team Leader</h3>
                                    <div class="infoblock">
                                        <p>' . $teamLead . '</p>
                                    </div>
                                </div>';
                                $sqlSelect = "select shiftCommit, reptileRoom, reptileSoak, snakeFeed, ICU, exICU, aviary, "
                                    . "mammals, PUE, PUEweigh, fawns, formulas, meals, raptorFeed, ISO, notes from animalcare where ancareid = " . $profileID;
                                $result = $conn->query($sqlSelect);
                                $newAnCare = new animalCare();
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $newAnCare->setShiftCommit($row["shiftCommit"]);
                                        $newAnCare->setReptileRoom($row["reptileRoom"]);
                                        $newAnCare->setReptileSoak($row["reptileSoak"]);
                                        $newAnCare->setSnakeFeed($row["snakeFeed"]);
                                        $newAnCare->setICU($row["ICU"]);
                                        $newAnCare->setExICU($row["exICU"]);
                                        $newAnCare->setAviary($row["aviary"]);
                                        $newAnCare->setMammals($row["mammals"]);
                                        $newAnCare->setPUE($row["PUE"]);
                                        $newAnCare->setPUEweigh($row["PUEweigh"]);
                                        $newAnCare->setFawns($row["fawns"]);
                                        $newAnCare->setFormulas($row["formulas"]);
                                        $newAnCare->setMeals($row["meals"]);
                                        $newAnCare->setRaptorFeed($row["raptorFeed"]);
                                        $newAnCare->setISO($row["ISO"]);
                                        $newAnCare->setNotes($row["notes"]);
                                    }
                                }

                                echo '<h1>Animal Care Fields</h1>

                                Reptile Room: <input type="checkbox" name="rep1" '; if ($newAnCare->getReptileRoom() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="rep2" '; if ($newAnCare->getReptileRoom() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="rep3" '; if ($newAnCare->getReptileRoom() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Reptile Room Soak Day:<input type="checkbox" name="repRm1" '; if ($newAnCare->getReptileSoak() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="repRm2" '; if ($newAnCare->getReptileSoak() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="repRm3" '; if ($newAnCare->getReptileSoak() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Education Snake Feeding Day:<input type="checkbox" name="snake1" '; if ($newAnCare->getSnakeFeed() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="snake2" '; if ($newAnCare->getSnakeFeed() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="snake3" '; if ($newAnCare->getSnakeFeed() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                ICU:<input type="checkbox" name="icu1" '; if ($newAnCare->getICU() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="icu2" '; if ($newAnCare->getICU() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="icu3" '; if ($newAnCare->getICU() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Expanded ICU:<input type="checkbox" '; if ($newAnCare->getExICU() > 0) { echo "checked"; } echo ' name="eicu1" value="1"> 1
                                <input type="checkbox" name="eicu2" '; if ($newAnCare->getExICU() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="eicu3" '; if ($newAnCare->getExICU() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Aviary:<input type="checkbox" name="av1" '; if ($newAnCare->getAviary() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="av2" '; if ($newAnCare->getAviary() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="av3" '; if ($newAnCare->getAviary() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Mammals:<input type="checkbox" name="mam1" '; if ($newAnCare->getMammals() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="mam2" '; if ($newAnCare->getMammals() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="mam3" '; if ($newAnCare->getMammals() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                PU & E:<input type="checkbox" name="pue1" '; if ($newAnCare->getPUE() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="pue2" '; if ($newAnCare->getPUE() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="pue3" '; if ($newAnCare->getPUE() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                PU & E Weigh Day:<input type="checkbox" name="puew1" '; if ($newAnCare->getPUEweigh() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="puew2" '; if ($newAnCare->getPUEweigh() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="puew3" '; if ($newAnCare->getPUEweigh() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Fawns:<input type="checkbox" name="fawn1" '; if ($newAnCare->getFawns() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="fawn2" '; if ($newAnCare->getFawns() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="fawn3" '; if ($newAnCare->getFawns() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Formula:<input type="checkbox" name="for1" '; if ($newAnCare->getFormulas() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="for2" '; if ($newAnCare->getFormulas() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="for3" '; if ($newAnCare->getFormulas() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Meals:<input type="checkbox" name="meal1" '; if ($newAnCare->getMeals() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="meal2" '; if ($newAnCare->getMeals() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="meal3" '; if ($newAnCare->getMeals() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                Raptor Feed:<input type="checkbox" name="rapF1" '; if ($newAnCare->getRaptorFeed() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="rapF2" '; if ($newAnCare->getRaptorFeed() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="rapF3" '; if ($newAnCare->getRaptorFeed() > 2) { echo "checked"; } echo ' value="3"> 3<br>
                                ISO: <input type="checkbox" name="iso1" '; if ($newAnCare->getISO() > 0) { echo "checked"; } echo ' value="1"> 1
                                <input type="checkbox" name="iso2" '; if ($newAnCare->getISO() > 1) { echo "checked"; } echo ' value="2"> 2
                                <input type="checkbox" name="iso3" '; if ($newAnCare->getISO() > 2) { echo "checked"; } echo ' value="3"> 3</br></br>

                                Notes:</br>
                                <textarea rows="4" name="anCareNotes" cols="50" maxlength="255" placeholder="Enter notes here.">'; echo $newAnCare->getNotes(); echo '</textarea>
                            </div>
                        </div>
                    </div>';
}
if ($trans == 1) {
                echo '<div class="team">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Transport
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">';
                                $sqlSelect = "select concat(tl.firstname, ' ', tl.lastname) as 'name' from teamlead tl inner join "
                                    . "team t on tl.teamLeadid = t.teamleadid inner join teamstatus ts on t.teamid = ts.teamid inner join "
                                    . "person p on ts.personid = p.personid where teamname = 'transporter' and p.personid = " . $profileID;
                                $result = $conn->query($sqlSelect);
                                $teamLead = "";
                                if ($result) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $teamLead = $row["name"];
                                    }
                                }

                            echo '<div>
                                    <h3>Team Leader</h3>
                                    <div class="infoblock">
                                        <p>' . $teamLead . '</p>
                                    </div>
                                </div>';
                                $sqlSelect = "select capturerestraint, distancelimits, animallimits, notes from transport where transportid = " . $profileID;
                                $result = $conn->query($sqlSelect);
                                $newTransport = new transport();
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $newTransport->setCaptureRestraint($row["capturerestraint"]);
                                        $newTransport->setDistanceLimits($row["distancelimits"]);
                                        $newTransport->setAnimalLimitsSA($row["animallimits"]);
                                        $newTransport->setNotes($row["notes"]);
                                    }
                                }

                           echo '<h1>Transport Fields</h1>

                                Capture and Restraint class: <input type="radio" name="capR" '; if ($newTransport->getCaptureRestraint() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="capR" '; if ($newTransport->getCaptureRestraint() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Distance limits: <input type="number" name="distance" value="'; echo $newTransport->getDistanceLimits(); echo '"></br>
                                Animal Limitations:</br>
                                <textarea rows="4" name="anLimits" cols="50" maxlength="255" placeholder="Enter limitations here.">'; echo $newTransport->getAnimalLimitsSA(); echo '</textarea><br><br>
                                Notes:</br>
                                <textarea rows="4" name="transportNotes" cols="50" maxlength="255" placeholder="Enter notes here.">'; echo $newTransport->getNotes(); echo '</textarea>
                            </div>
                        </div>
                    </div>';
}
if ($treat == 1) {

                echo '<div class="team">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Treatment
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">';
                                $sqlSelect = "select concat(tl.firstname, ' ', tl.lastname) as 'name' from teamlead tl inner join "
                                    . "team t on tl.teamLeadid = t.teamleadid inner join teamstatus ts on t.teamid = ts.teamid inner join "
                                    . "person p on ts.personid = p.personid where teamname = 'treatment team' and p.personid = " . $profileID;
                                $result = $conn->query($sqlSelect);
                                $teamLead = "";
                                if ($result) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $teamLead = $row["name"];
                                    }
                                }

                           echo '<div>
                                    <h3>Team Leader</h3>
                                    <div class="infoblock">
                                        <p>' . $teamLead . '</p>
                                    </div>
                                </div>';

                                $sqlSelect = "select smMam, LrgMam, RVS, eagle, SmRaptor, LrgRaptor, reptile, vet, tech, vetstudent, techstudent, "
                                    . "vetassistant, medicating, bandaging, woundcare, diag, anesthesia, notes from treatment where treatmentid = " . $profileID;
                                $result = $conn->query($sqlSelect);

                                $newTreatment = new treatment();

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $newTreatment->setSmMam($row["smMam"]);
                                        $newTreatment->setLrgMam($row["LrgMam"]);
                                        $newTreatment->setRVS($row["RVS"]);
                                        $newTreatment->setEagle($row["eagle"]);
                                        $newTreatment->setSmRaptor($row["SmRaptor"]);
                                        $newTreatment->setLrgRaptor($row["LrgRaptor"]);
                                        $newTreatment->setReptile($row["reptile"]);
                                        $newTreatment->setVet($row["vet"]);
                                        $newTreatment->setTech($row["tech"]);
                                        $newTreatment->setVetStudent($row["vetstudent"]);
                                        $newTreatment->setTechStudent($row["techstudent"]);
                                        $newTreatment->setVetAssistant($row["vetassistant"]);
                                        $newTreatment->setMedicating($row["medicating"]);
                                        $newTreatment->setBandaging($row["bandaging"]);
                                        $newTreatment->setWoundCare($row["woundcare"]);
                                        $newTreatment->setDiag($row["diag"]);
                                        $newTreatment->setAnesthesia($row["anesthesia"]);
                                        $newTreatment->setNotes($row["notes"]);
                                    }
                                }

                           echo '<h1>Treatment Fields</h1>

                                Handling Skills:</br>
                                Small Mammals: <input type="radio" name="sMam" '; if ($newTreatment->getSmMam() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="sMam" '; if ($newTreatment->getSmMam() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Large Mammals: <input type="radio" name="lMam" '; if ($newTreatment->getLrgMam() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="lMam" '; if ($newTreatment->getLrgMam() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                RVS: <input type="radio" name="rvs" '; if ($newTreatment->getRVS() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="rvs" '; if ($newTreatment->getRVS() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Eagles: <input type="radio" name="eag" '; if ($newTreatment->getEagle() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="eag" '; if ($newTreatment->getEagle() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Small Raptors: <input type="radio" name="sRap" '; if ($newTreatment->getSmRaptor() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="sRap" '; if ($newTreatment->getSmRaptor() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Large Raptors: <input type="radio" name="lRap" '; if ($newTreatment->getLrgRaptor() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="lRap" '; if ($newTreatment->getLrgRaptor() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Reptiles: <input type="radio" name="rep" '; if ($newTreatment->getReptile() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="rep" '; if ($newTreatment->getReptile() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Veterinarian: <input type="radio" name="vet" '; if ($newTreatment->getVet() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="vet" '; if ($newTreatment->getVet() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Technician: <input type="radio" name="tech" '; if ($newTreatment->getTech() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="tech" '; if ($newTreatment->getTech() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Veterinarian Student: <input type="radio" name="vetStu" '; if ($newTreatment->getVetStudent() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="vetStu" '; if ($newTreatment->getVetStudent() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Technician Student: <input type="radio" name="techStu" '; if ($newTreatment->getTechStudent() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="techStu" '; if ($newTreatment->getTechStudent() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Veterinarian Assistant: <input type="radio" name="vetAs" '; if ($newTreatment->getVetAssistant() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="vetAs" '; if ($newTreatment->getVetAssistant() == 0) { echo "checked"; } echo 'value="0"> No</br>
                                Medicating: <input type="radio" name="med" '; if ($newTreatment->getMedicating() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="med" '; if ($newTreatment->getMedicating() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Bandaging: <input type="radio" name="band" '; if ($newTreatment->getBandaging() == 1) { echo "checked"; } echo 'value="1"> Yes
                                <input type="radio" name="band" '; if ($newTreatment->getBandaging() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Wound Care: <input type="radio" name="wCare" '; if ($newTreatment->getWoundCare() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="wCare" '; if ($newTreatment->getWoundCare() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Diagostics: <input type="radio" name="diag" '; if ($newTreatment->getDiag() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="diag" '; if ($newTreatment->getDiag() == 0) { echo "checked"; } echo ' value="0"> No</br>
                                Anesthesia: <input type="radio" name="anthe" '; if ($newTreatment->getAnesthesia() == 1) { echo "checked"; } echo ' value="1"> Yes
                                <input type="radio" name="anthe" '; if ($newTreatment->getAnesthesia() == 0) { echo "checked"; } echo ' value="0"> No</br></br>

                                Notes:</br>
                                <textarea rows="4" name="treatmentNotes" cols="50" maxlength="255" placeholder="Enter notes here.">'; echo $newTreatment->getNotes(); echo '</textarea>

                            </div>
                        </div>
                    </div>';
}?>
                    <div class="team">
                        <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Front Desk
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                            <div class="panel-body">
                                <?php
                                $sqlSelect = "select concat(tl.firstname, ' ', tl.lastname) as 'name' from teamlead tl inner join "
                                    . "team t on tl.teamLeadid = t.teamleadid inner join teamstatus ts on t.teamid = ts.teamid inner join "
                                    . "person p on ts.personid = p.personid where teamname = 'front desk' and p.personid = " . $profileID;
                                $result = $conn->query($sqlSelect);
                                $teamLead = "";
                                if ($result) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $teamLead = $row["name"];
                                    }
                                }
                                ?>
                                <div>
                                    <h3>Team Leader</h3>
                                    <div class="infoblock">
                                        <p><?php echo $teamLead; ?></p>
                                    </div>
                                </div>
                                <?php
                                $sqlSelect = "select notes from frontDesk where frntdskid = " . $profileID;
                                $result = $conn->query($sqlSelect);
                                $frntDskNotes = null;
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $frntDskNotes = $row["notes"];
                                    }
                                }
                                ?>

                                <h1>Front Desk Fields</h1>
                                Notes:</br>
                                <textarea rows="4" name="frontDeskNotes" cols="50" maxlength="255" placeholder="Enter notes here."><?php echo $frntDskNotes; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--End row-->

  		</div><!--End column-->
    </div><!--End row-->
  </div>


<?php
if(isset($_POST['save'])) {
    $newPerson->setFirstName($_POST["firstName"]);
    $newPerson->setMiddleInitial($_POST["middleName"]);
    $newPerson->setLastName($_POST["lastName"]);
    $newPerson->setEmail($_POST["email"]);
    $newPerson->setPhone($_POST["phone"]);
    $newPerson->setHouseNumber($_POST["houseNumber"]);
    $newPerson->setStreet($_POST["street"]);
    $newPerson->setCityCounty($_POST["cityCounty"]);
    $newPerson->setStateAbb($_POST["stateAbb"]);
    //$newPerson->setCountryAbb($_POST[""]);
    $newPerson->setZip($_POST["zipCode"]);

    $newEmergContact->setFirstName($_POST["emergFirstName"]);
    $newEmergContact->setLastName($_POST["emergLastName"]);
    $newEmergContact->setPhone($_POST["emergPhone"]);
    $newEmergContact->setRelationship($_POST["emergRel"]);

    $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());

    $firstName = $newPerson->getFirstName();
    $middleName = $newPerson->getMiddleInitial();
    $lastName = $newPerson->getLastName();
    $email = $newPerson->getEmail();
    $phone = $newPerson->getPhone();
    $houseNum = $newPerson->getHouseNumber();
    $street = $newPerson->getStreet();
    $cityCounty = $newPerson->getCityCounty();
    $state = $newPerson->getStateAbb();
    $zip = $newPerson->getZip();

    $emergFN = $newEmergContact->getFirstName();
    $emergLN = $newEmergContact->getLastName();
    $emergPhone = $newEmergContact->getPhone();
    $emergRelationship = $newEmergContact->getRelationship();

    $sqlUpdate = "UPDATE wcv.person set firstname = ?, middlename = ?, lastname = ?, phone = ?, housenumber = ?, street = ?, citycounty = ?, stateabb = ?, zipcode = ? where personid = " . $profileID;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssssissss", $firstName, $middleName, $lastName, $phone, $houseNum, $street, $cityCounty, $state, $zip);
    $stmt->execute();

    $record = $conn->affected_rows;
    if ($record > 0) {
        //echo "New records updated successfully";
    }
    if (mysqli_errno($conn) != 0) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "</br>";
    }

    $sqlUpdate = "update login set email = ? where personid = " . $profileID;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $record = $conn->affected_rows;
    if ($record > 0) {
        //echo "New records updated successfully";
    }
    if (mysqli_errno($conn) != 0) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "</br>";
    }

    $sqlUpdate = "update emergcontact set firstname = ?, lastname = ?, phone = ?, relationship = ? where personid = " . $profileID;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssss", $emergFN, $emergLN, $emergPhone, $emergRelationship);
    $stmt->execute();

    $record = $conn->affected_rows;
    if ($record > 0) {
        //echo "New records updated successfully";
    }
    if (mysqli_errno($conn) != 0) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "</br>";
    }

    if(isset($_POST["dateShadow1"])) {
        $newOutreach->setNumShadows(1);
    } else if (isset($_POST["dateShadow1"]) && isset($_POST["dateShadow2"])) {
        $newOutreach->setNumShadows(2);
    } else if (isset($_POST["dateShadow1"]) && isset($_POST["dateShadow2"]) && isset($_POST["dateShadow3"])) {
        $newOutreach->setNumShadows(3);
    }
    $newOutreach->setShadowed1Date($_POST["dateShadow1"]);
    $newOutreach->setShadowed2Date($_POST["dateShadow2"]);
    $newOutreach->setShadowed3Date($_POST["dateShadow3"]);
    if(isset($_POST["intro"])) {
        $newOutreach->setIntro($_POST["intro"]);
    }
    if(isset($_POST["alone"])) {
        $newOutreach->setLeadAlone($_POST["alone"]);
    }
    if(isset($_POST["offsite"])) {
        $newOutreach->setOffsite($_POST["offsite"]);
    }
    $newOutreach->setNotes($_POST["outreachNotes"]);

    $numShad = $newOutreach->getNumShadows();
    $shad1 = $newOutreach->getShadowed1Date() != '' ? $newOutreach->getShadowed1Date() : null;
    $shad2 = $newOutreach->getShadowed2Date() != '' ? $newOutreach->getShadowed2Date() : null;
    $shad3 = $newOutreach->getShadowed3Date() != '' ? $newOutreach->getShadowed3Date() : null;
    $intro = $newOutreach->getIntro();
    $lead = $newOutreach->getLeadAlone();
    $offsite = $newOutreach->getOffsite();
    $outNotes = $newOutreach->getNotes();

    $sqlUpdate = "update outreach set shadowed = ?, shodowed1 = ?, shadowed2 = ?, shadowed3 = ?, intro = ?, leadalone = ?, offsite = ?, notes = ? where outreachid = " . $profileID;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("isssiiis", $numShad, $shad1, $shad2, $shad3, $intro, $lead, $offsite, $outNotes);
    $stmt->execute();

    $record = $conn->affected_rows;
    if ($record > 0) {
        //echo "New records updated successfully";
    }
    if (mysqli_errno($conn) != 0) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "</br>";
    }

    //send animalcare fields into the database
    $repRoom = null;
    if(isset($_POST["rep1"])) { if ($_POST["rep1"] != '') { $repRoom = $_POST["rep1"]; } }
    if(isset($_POST["rep2"])) { if ($_POST["rep2"] != '') { $repRoom = $_POST["rep2"]; } }
    if(isset($_POST["rep3"])) { if ($_POST["rep3"] != '') { $repRoom = $_POST["rep3"]; } }
    $newAnCare->setReptileRoom($repRoom);
    $repSoak = null;
    if(isset($_POST["repRm1"])) { if ($_POST["repRm1"] != '') { $repSoak = $_POST["repRm1"]; } }
    if(isset($_POST["repRm2"])) { if ($_POST["repRm2"] != '') { $repSoak = $_POST["repRm2"]; } }
    if(isset($_POST["repRm3"])) { if ($_POST["repRm3"] != '') { $repSoak = $_POST["repRm3"]; } }
    $newAnCare->setReptileSoak($repSoak);
    $snakeFeed = null;
    if(isset($_POST["snake1"])) { if ($_POST["snake1"] != '') { $snakeFeed = $_POST["snake1"]; } }
    if(isset($_POST["snake2"])) { if ($_POST["snake2"] != '') { $snakeFeed = $_POST["snake2"]; } }
    if(isset($_POST["snake3"])) { if ($_POST["snake3"] != '') { $snakeFeed = $_POST["snake3"]; } }
    $newAnCare->setSnakeFeed($snakeFeed);
    $ICU = null;
    if(isset($_POST["icu1"])) { if ($_POST["icu1"] != '') { $ICU = $_POST["icu1"]; } }
    if(isset($_POST["icu2"])) { if ($_POST["icu2"] != '') { $ICU = $_POST["icu2"]; } }
    if(isset($_POST["icu3"])) { if ($_POST["icu3"] != '') { $ICU = $_POST["icu3"]; } }
    $newAnCare->setICU($ICU);
    $exICU = null;
    if(isset($_POST["eicu1"])) { if ($_POST["eicu1"] != '') { $exICU = $_POST["eicu1"]; } }
    if(isset($_POST["eicu2"])) { if ($_POST["eicu2"] != '') { $exICU = $_POST["eicu2"]; } }
    if(isset($_POST["eicu3"])) { if ($_POST["eicu3"] != '') { $exICU = $_POST["eicu3"]; } }
    $newAnCare->setExICU($exICU);
    $aviary = null;
    if(isset($_POST["av1"])) { if ($_POST["av1"] != '') { $aviary = $_POST["av1"]; } }
    if(isset($_POST["av2"])) { if ($_POST["av2"] != '') { $aviary = $_POST["av2"]; } }
    if(isset($_POST["av3"])) { if ($_POST["av3"] != '') { $aviary = $_POST["av3"]; } }
    $newAnCare->setAviary($aviary);
    $mammals = null;
    if(isset($_POST["mam1"])) { if ($_POST["mam1"] != '') { $mammals = $_POST["mam1"]; } }
    if(isset($_POST["mam2"])) { if ($_POST["mam2"] != '') { $mammals = $_POST["mam2"]; } }
    if(isset($_POST["mam3"])) { if ($_POST["mam3"] != '') { $mammals = $_POST["mam3"]; } }
    $newAnCare->setMammals($mammals);
    $PUE = null;
    if(isset($_POST["pue1"])) { if ($_POST["pue1"] != '') { $PUE = $_POST["pue1"]; } }
    if(isset($_POST["pue2"])) { if ($_POST["pue2"] != '') { $PUE = $_POST["pue2"]; } }
    if(isset($_POST["pue3"])) { if ($_POST["pue3"] != '') { $PUE = $_POST["pue3"]; } }
    $newAnCare->setPUE($PUE);
    $PUEW = null;
    if(isset($_POST["puew1"])) { if ($_POST["puew1"] != '') { $PUEW = $_POST["puew1"]; } }
    if(isset($_POST["puew2"])) { if ($_POST["puew2"] != '') { $PUEW = $_POST["puew2"]; } }
    if(isset($_POST["puew3"])) { if ($_POST["puew3"] != '') { $PUEW = $_POST["puew3"]; } }
    $newAnCare->setPUEweigh($PUEW);
    $fawns = null;
    if(isset($_POST["fawn1"])) { if ($_POST["fawn1"] != '') { $fawns = $_POST["fawn1"]; } }
    if(isset($_POST["fawn2"])) { if ($_POST["fawn2"] != '') { $fawns = $_POST["fawn2"]; } }
    if(isset($_POST["fawn3"])) { if ($_POST["fawn3"] != '') { $fawns = $_POST["fawn3"]; } }
    $newAnCare->setFawns($fawns);
    $formula = null;
    if(isset($_POST["for1"])) { if ($_POST["for1"] != '') { $formula = $_POST["for1"]; } }
    if(isset($_POST["for2"])) { if ($_POST["for2"] != '') { $formula = $_POST["for2"]; } }
    if(isset($_POST["for3"])) { if ($_POST["for3"] != '') { $formula = $_POST["for3"]; } }
    $newAnCare->setFormulas($formula);
    $meals = null;
    if(isset($_POST["meal1"])) { if ($_POST["meal1"] != '') { $meals = $_POST["meal1"]; } }
    if(isset($_POST["meal2"])) { if ($_POST["meal2"] != '') { $meals = $_POST["meal2"]; } }
    if(isset($_POST["meal3"])) { if ($_POST["meal3"] != '') { $meals = $_POST["meal3"]; } }
    $newAnCare->setMeals($meals);
    $rapFeed = null;
    if(isset($_POST["rapF1"])) { if ($_POST["rapF1"] != '') { $rapFeed = $_POST["rapF1"]; } }
    if(isset($_POST["rapF2"])) { if ($_POST["rapF2"] != '') { $rapFeed = $_POST["rapF2"]; } }
    if(isset($_POST["rapF3"])) { if ($_POST["rapF3"] != '') { $rapFeed = $_POST["rapF3"]; } }
    $newAnCare->setRaptorFeed($rapFeed);
    $ISO = null;
    if(isset($_POST["iso1"])) { if ($_POST["iso1"] != '') { $ISO = $_POST["iso1"]; } }
    if(isset($_POST["iso2"])) { if ($_POST["iso2"] != '') { $ISO = $_POST["iso2"]; } }
    if(isset($_POST["iso3"])) { if ($_POST["iso3"] != '') { $ISO = $_POST["iso3"]; } }
    $newAnCare->setISO($ISO);
    $newAnCare->setNotes($_POST["anCareNotes"]);

    $repRoom = $newAnCare->getReptileRoom();
    $repSoak = $newAnCare->getReptileSoak();
    $snakeFeed = $newAnCare->getSnakeFeed();
    $ICU = $newAnCare->getICU();
    $exICU = $newAnCare->getExICU();
    $aviary = $newAnCare->getAviary();
    $mammals = $newAnCare->getMammals();
    $PUE =  $newAnCare->getPUE();
    $PUEW = $newAnCare->getPUEweigh();
    $fawns = $newAnCare->getFawns();
    $formula = $newAnCare->getFormulas();
    $meals = $newAnCare->getMeals();
    $rapFeed = $newAnCare->getRaptorFeed();
    $ISO = $newAnCare->getISO();
    $anCareNote = $newAnCare->getNotes();

    $sqlUpdate = "update animalcare set reptileRoom = ?, reptileSoak = ?, snakeFeed = ?, ICU = ?, exICU = ?, aviary = ?, "
        . "mammals = ?, PUE = ?, PUEweigh = ?, fawns = ?, formulas = ?, meals = ?, raptorFeed = ?, ISO = ?, notes = ? where ancareid = " . $profileID;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("iiiiiiiiiiiiiis", $repRoom, $repSoak, $snakeFeed, $ICU, $exICU, $aviary, $mammals, $PUE, $PUEW, $fawns, $formula, $meals, $rapFeed, $ISO, $anCareNote);
    $stmt->execute();

    $record = $conn->affected_rows;
    if ($record > 0) {
        echo "New records updated successfully";
    }
    if (mysqli_errno($conn) != 0) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "</br>";
    }


    //send treatment fields into the database
    if(isset($_POST["sMam"])) {
        $newTreatment->setSmMam($_POST["sMam"]);
    }
    if(isset($_POST["lMam"])) {
        $newTreatment->setLrgMam($_POST["lMam"]);;
    }
    if(isset($_POST["rvs"])) {
        $newTreatment->setRVS($_POST["rvs"]);
    }
    if(isset($_POST["eag"])) {
        $newTreatment->setEagle($_POST["eag"]);
    }
    if(isset($_POST["sRap"])) {
        $newTreatment->setSmRaptor($_POST["sRap"]);
    }
    if(isset($_POST["lRap"])) {
        $newTreatment->setLrgRaptor($_POST["lRap"]);
    }
    if(isset($_POST["rep"])) {
        $newTreatment->setReptile($_POST["rep"]);
    }
    if(isset($_POST["vet"])) {
        $newTreatment->setVet($_POST["vet"]);
    }
    if(isset($_POST["tech"])) {
        $newTreatment->setTech($_POST["tech"]);
    }
    if(isset($_POST["vetStu"])) {
        $newTreatment->setVetStudent($_POST["vetStu"]);
    }
    if(isset($_POST["techStu"])) {
        $newTreatment->setTechStudent($_POST["techStu"]);
    }
    if(isset($_POST["vetAs"])) {
        $newTreatment->setVetAssistant($_POST["vetAs"]);
    }
    if(isset($_POST["med"])) {
        $newTreatment->setMedicating($_POST["med"]);
    }
    if(isset($_POST["band"])) {
        $newTreatment->setBandaging($_POST["band"]);
    }
    if(isset($_POST["wCare"])) {
        $newTreatment->setWoundCare($_POST["wCare"]);
    }
    if(isset($_POST["diag"])) {
        $newTreatment->setDiag($_POST["diag"]);
    }
    if(isset($_POST["anthe"])) {
        $newTreatment->setAnesthesia($_POST["anthe"]);
    }
    $newTreatment->setNotes($_POST["treatmentNotes"]);

    $smMam = $newTreatment->getSmMam();
    $lrgMam = $newTreatment->getLrgMam();
    $rVS = $newTreatment->getRVS();
    $eag = $newTreatment->getEagle();
    $smRap = $newTreatment->getSmRaptor();
    $lrgRap = $newTreatment->getLrgRaptor();
    $rep = $newTreatment->getReptile();
    $vet = $newTreatment->getVet();
    $tech = $newTreatment->getTech();
    $vetStu = $newTreatment->getVetStudent();
    $techStu = $newTreatment->getTechStudent();
    $vetAs = $newTreatment->getVetAssistant();
    $med = $newTreatment->getMedicating();
    $band = $newTreatment->getBandaging();
    $wound = $newTreatment->getWoundCare();
    $diag = $newTreatment->getDiag();
    $anthe = $newTreatment->getAnesthesia();
    $treatNote = $newTreatment->getNotes();

    $sqlUpdate = "update treatment set smMam = ?, LrgMam = ?, RVS = ?, eagle = ?, SmRaptor = ?, LrgRaptor = ?, reptile = ?, "
        . "vet = ?, tech = ?, vetstudent = ?, techstudent = ?, vetassistant = ?, medicating = ?, bandaging = ?, woundcare = ?, "
        . "diag = ?, anesthesia = ?, notes = ? where treatmentid = " . $profileID;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("iiiiiiiiiiiiiiiiis", $smMam, $lrgMam, $rVS, $eag, $smRap, $lrgRap, $rep, $vet, $tech, $vetStu, $techStu, $vetAs, $med, $band, $wound, $diag, $anthe, $treatNote);
    $stmt->execute();

    $record = $conn->affected_rows;
    if ($record > 0) {
        echo "New records updated successfully";
    }
    if (mysqli_errno($conn) != 0) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "</br>";
    }


    //send transport fields into the database
    if(isset($_POST["capR"])) {
        $newTransport->setCaptureRestraint($_POST["capR"]);
    }
    $newTransport->setDistanceLimits($_POST["distance"]);
    $newTransport->setAnimalLimitsSA($_POST["anLimits"]);
    $newTransport->setNotes($_POST["transportNotes"]);

    $capR = $newTransport->getCaptureRestraint();
    $distance = $newTransport->getDistanceLimits() != '' ? $newTransport->getDistanceLimits() : null;
    $anLimits = $newTransport->getAnimalLimitsSA();
    $transportNotes = $newTransport->getNotes();

    $sqlUpdate = "update transport set capturerestraint = ?, distancelimits = ?, animallimits = ?, notes = ? where transportid = " . $profileID;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("iiss", $capR, $distance, $anLimits, $transportNotes);
    $stmt->execute();


    //send front desk fields into the database
    $frntDskNotes = $_POST["frontDeskNotes"];

    $sqlUpdate = "update frontDesk set notes = ? where frntdskid = " . $profileID;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("s", $frntDskNotes);
    $stmt->execute();
}

?>
</form>

<?php
if(isset($_POST['save'])) {
    echo '<script>
        window.location = "/profile.php";
    </script>';
}
?>
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
  </body>
</html>