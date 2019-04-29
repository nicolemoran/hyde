






<?php
include("loginheader.php");
require("SQLConnection.php");
include("documentClass.php");

$newSQL = new SQLConnection();
$conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());
/**
 * Created by PhpStorm.
 * User: Zoe
 * Date: 4/5/2017
 * Time: 7:54 PM
 */


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

    <title>View Application | Wildlife Center Volunteers</title>

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
<?php
$personid=$_GET['$personid'];
$teamname=$_GET['$teamname'];

global $firstname,$lastname,$rabiesshot,$rabiesdate,$rabiesowncost,$rehabpermit,$permittype,$carpentryskills;

$sql = "Select firstname, lastname, rabiesshot, rabiesdate, rabiesowncost, rehabpermit, permittype, carpentryskills from person where personid=".$personid;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        if($row['rabiesshot'] = 1){
            $rabiesshot = "Yes";
        }else{$rabiesshot = "No";}
        $rabiesdate = $row['rabiesdate'];
        if($row['rabiesowncost'] =1){
            $rabiesowncost = "Yes";
        }else{$rabiesowncost = "No";}
        if($row['rehabpermit'] =1){
            $rehabpermit = "Yes";
        }else{$rehabpermit = "No";}
        $permittype= $row['permittype'];
        if($row['carpentryskills'] =1){
            $carpentryskills = "Yes";
        }else{$carpentryskills = "No";}

    }
}
?>


<div class="container">
    <div class="row">
        <div class="col-xs-3">
            <!--Spacer-->
        </div>
        <div class="col-xs-6 vellum">
            <h3>WILDLIFE CENTER OF VIRGINIA</h3>
            <img src="images/nature.png" alt="Logo" class="logo img-responsive">

            <h1><?php echo $firstname.' '.$lastname?>'s Application</h1>
            <a href="application-review.php" class="back">Back to Applicant Search</a>

            <div class="row">
                <form action="view-app.php" method="post">
                    <!--Sidebar with checkboxes-->
                    <div class="col-xs-10">
                        <h3><?php echo $teamname; ?> Application</h3>
                        <br />


                        <?php
                        global $handsOnSA,$deadAnimalsSA,$livePreySA,$workOutsideSA,$lifeWeightSA,$allergiesSA,$shiftCommit,$rightsGroupSA,
                               $hopeToLearnSA,$passionateIssuesSA,$anythingElseSA,$firstname,$lastname,$teamname,$personid, $pass, $whyint,
                               $pubspeak, $whatbring, $cap, $distance, $howfar, $animallimits, $teamid, $teamstatusid, $email;

                        if ($teamname == "Animal Care") {

                            $sql = "select handsonsa,deadanimalssa,livepreysa,workoutsidesa,liftweightsa,allergiessa,
                            shiftcommit,rightsgroupsa,hopetolearnsa,passionateissuessa,anythingelsesa from 
                            animalcare where ancareid = ".$personid;

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $handsOnSA = $row['handsonsa'];
                                    $deadAnimalsSA = $row['deadanimalssa'];
                                    $livePreySA = $row['livepreysa'];
                                    $workOutsideSA = $row['workoutsidesa'];
                                    $liftWeightSA = $row['liftweightsa'];
                                    $allergiesSA = $row['allergiessa'];
                                    $shiftCommit = $row['shiftcommit'];
                                    $rightsGroupSA = $row['rightsgroupsa'];
                                    $hopeToLearnSA = $row['hopetolearnsa'];
                                    $passionateIssuesSA = $row['passionateissuessa'];
                                    $anythingElseSA = $row['anythingelsesa'];

                                }
                            }
                        echo "<h5><b>Please briefly describe your relevant hands-on experience with animals, if any. What did you enjoy about the experience? What did you dislike?</b></h5>".$handsOnSA."<br />
                            <h5><b>Carnivorous patients are sometimes unable to eat food items whole due to their injuries; you may be required to cut and divide dead rodents, chicks, and fishes into smaller portions. Are you comfortable handling dead animals for this purpose?</b></h5>".$deadAnimalsSA."<br />
                            <h5><b>Prior to release from the Wildlife Center, many predatory birds are presented with live mice in order to evaluate their ability to capture prey in a controlled and measurable environment. What is your opinion on using live-prey for this purpose?</b></h5>".$livePreySA."<br />
                            <h5><b>Wildlife rehabilitation requires daily outdoor work -- year-round and regardless of weather conditions. Are you able to work outside during all seasons? If not, what are your limitations?</b></h5>".$workOutsideSA."<br />
                            <h5><b>Are you able to lift 40 pounds on potentially uneven surfaces with minimal assistance? </b></h5>".$liftWeightSA."<br />
                            <h5><b>Please list all food and animal allergies, if any: </b></h5>".$allergiesSA."<br />
                            <h5><b>Do you belong to any animal rights groups (PETA, The Humane Society, etc.)? If so, which ones? </b></h5>".$rightsGroupSA."<br />
                            <h5><b>What do you hope to learn or accomplish by volunteering at the Wildlife Center of Virginia? </b></h5>".$hopeToLearnSA."<br />
                            <h5><b>Please describe an environmental or wildlife-based issue you feel passionately about, and why:</b></h5>".$passionateIssuesSA."<br />
                            <h5><b>Is there anything else that you’d like us to know about yourself or your experience?</b></h5>".$anythingElseSA."<br />";

                        }


                        if ($teamname == "Outreach"){
                            $sql = "SELECT passionateIssuesSA, whyinterestedsa, publicspeakingsa, whatdoyoubringsa from outreach where outreachid = ".$personid;
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $pass = $row['passionateIssuesSA'];
                                    $whyint = $row['whyinterestedsa'];
                                    $pubspeak = $row['publicspeakingsa'];
                                    $whatbring = $row['whatdoyoubringsa'];
                                }
                            }

                            echo "<h5><b>Please describe an environmental or wildlife-based issue you feel passionately about, and why:</b></h5>".$pass."<br />
                                <h5><b>Why are you interested in volunteering as an outreach docent? </b></h5>".$whyint."<br />
                                <h5><b>Do you have prior experience speaking to the public? Please describe.</b></h5>".$pubspeak."<br />
                                <h5><b>What do you think you’d bring to the outreach volunteer team? </b></h5>".$whatbring."<br />";

                        }

                        if ($teamname == "Transporter"){
                            $sql = "SELECT capturerestraint,howfarwillingSA,animallimits FROM transport where transportid = ".$personid;
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $cap = $row['capturerestraint'];
                                    $howfar = $row['howfarwillingSA'];
                                    $animallimits = $row['animallimits'];
                                }
                            }

                            echo "<h5><b>Would you be willing to assist with capturing animals, if needed?</b></h5>".$cap."<br />
                                <h5><b>How far are you willing to travel for transport (i.e., 30-45 miles from your location, to a specific location, etc)?</b></h5>".$howfar."<br />
                                <h5><b>Do you have any limits on which animals you are willing to handle? </b></h5>".$animallimits."<br />";

                        }





                        echo "<h5><b>Are you vaccinated for Rabies?</b></h5>".$rabiesshot."<br />
                            <h5><b>If so, what date were you vaccinated?</b></h5>".$rabiesdate."<br />
                            <h5><b>If not, are you willing to become vaccinated at your own cost?</b></h5>".$rabiesowncost."<br />
                            <h5><b>Do you have a rehabilitation permit?</b></h5>".$rehabpermit."<br />
                            <h5><b>If so, what level?</b></h5>".$permittype."<br />";
                            


                        ?>




                    </div> <!--End list of volunteers-->
                </form>
            </div> <!--End row-->
            <div>
                <div class="col-xs-3">
                    <form method="post" action="view-app.php?$personid=<?php echo $personid; ?>&$teamname=<?php echo $teamname;?>">
                    <input type="submit" name="Accept" value="Accept">
                        <input type="submit" name="Deny" value="Deny">
                    <?php



                            $sql2 = "select teamid from team where teamname ='".$teamname."'";
                            $result2=$conn->query($sql2);

                            if($result2) {
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    $teamid=$row['teamid'];
                                }
                            }

                            $sql2 = "select teamstatusid from teamstatus where teamid='".$teamid."' and personid=".$personid;
                            $result2=$conn->query($sql2);

                            if($result2) {
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    $teamstatusid=$row['teamstatusid'];
                                }
                            }

                    if(isset($_POST['Accept'])){
                        echo "<h5>This Worked</h5>";

                            $sql3 = "update teamstatus set apstatus = 'active', datechanged = current_date() where teamstatusid =".$teamstatusid;
                            $result2=$conn->query($sql3);

                            echo "<h5>".$sql3."</h5>";

                            $sql2 = "select email from login where personid=".$personid;
                            $result2=$conn->query($sql2);

                            echo '<div>
                                  <span class="popuptext" id="myPopup">You have accepted '.$firstname.' '.$lastname.' as a(n) '.$teamname.' Volunteer!</span>
                                </div>';


                            if($result2) {
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    $email=$row['email'];
                                }
                            }

                            //send email to volunteer using $email that they have been ACCEPTED
                            //DO THIS HERE SEAN PLEASE THANK YOU

                        }

                    if(isset($_POST['Deny'])){
                        echo "<h5>This Worked</h5>";

                        $sql3 = "update teamstatus set apstatus = 'denied', datechanged = current_date() where teamstatusid =".$teamstatusid;
                        $result2=$conn->query($sql3);

                        echo "<h5>".$sql3."</h5>";

                        $sql2 = "select email from login where personid=".$personid;
                        $result2=$conn->query($sql2);

                        echo '<div>
                                  <span class="popuptext" id="myPopup">You have denied '.$firstname.' '.$lastname.' as a(n) '.$teamname.' Volunteer</span>
                                </div>';


                        if($result2) {
                            while ($row = mysqli_fetch_assoc($result2)) {
                                $email=$row['email'];
                            }
                        }

                        //send email to volunteer using $email that they have been DENIED
                        //DO THIS HERE SEAN PLEASE THANK YOU

                    }

                    $sqlSelect = "select documentid, personid, docname, doctype, filename, filelocation, apptype, dateadded from documents where personid = ".$personid;
                    $result = $conn->query($sqlSelect);

                    $count = 0;
                    $documents = array();
                    if ($result) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $documents[$count] = new Document();
                            $documents[$count]->setDocumentID($row["documentid"]);
                            $documents[$count]->setPersonID($row["personid"]);
                            $documents[$count]->setDocName($row["docname"]);
                            $documents[$count]->setDocType($row["doctype"]);
                            $documents[$count]->setFileName($row["filename"]);
                            $documents[$count]->setFileLocation($row["filelocation"]);
                            $documents[$count]->setAppType($row["apptype"]);
                            $documents[$count]->setDateAdded($row["dateadded"]);
                            $count++;

                        }
                    }

                    ?>
                        <div>
                            <h1>Documents</h1>
                            <?php
                            for($i = 0; $i < count($documents); $i++) {
                                //if($documents[$i]->getDocName() == 'resume') {
                                    echo ucwords($documents[$i]->getAppType()) . " | " . $documents[$i]->getDateAdded() . ': <a href="' . $documents[$i]->getFileLocation() . '" download="' . $documents[$i]->getFileName() . '" class="back">' . $documents[$i]->getFileName() . '</a></br>';
                               // }
                            }
                            ?>
                        </div>

                    </form>
                </div>
            </div>
        </div><!--End column-->
    </div><!--End row-->
</div>

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