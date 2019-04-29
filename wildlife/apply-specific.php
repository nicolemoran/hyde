<?php
include ("loginheader.php");
include ("SQLConnection.php");
include ("personclass.php");
include ("emergContactClass.php");
include ("documentClass.php");


$newSQL = new SQLConnection();
$conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());

$sql = "select firstname,lastname,email from person p
inner join login l on p.personid = l.personid
where p.personid = ".$_SESSION["personid"];

$result = $conn->query($sql);

if ($result)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $firstName = $row["firstname"];
        $lastName = $row["lastname"];
        $email = $row["email"];
    }
}




if (!empty($_POST)) {


    $houseNum = $_POST["houseNumber"];
    $street = $_POST["street"];
    $cityCounty = $_POST["cityCounty"];
    $stateAbb = $_POST["stateAbb"];
    $zipCode = $_POST["zipCode"];
    $rabiesOwnShot = null;
    $rehabPermit = 0;
    $permitType = null;
    $rabiesShotQuery = "";
    $permitTypeQuery = "";
    $emergencyFirstName = $_POST["emergencyFirstName"];
    $emergencyLastName = $_POST["emergencyLastName"];
    $emergencyPhone = $_POST["emergencyPhone"];
    $emergencyRelationship = $_POST["emergencyRelationship"];


    if ($_POST["rabiesShot"] == "Yes"){
        $rabiesShot = 1;
        $rabiesDocInput = "rabiesDoc";
        $rabiesDoc = new Document();
        $rabiesDoc->uploadDocument($_SESSION["personid"],$rabiesDocInput,"rabies document","na");
    }
    else{
        $rabiesShot = 0;
        $rabiesOwnShot = (($_POST["rabiesOwnShot"]) == "Yes")?1:0;
        $rabiesShotQuery = ",rabiesOwnCost =".$rabiesOwnShot;
    }

    if ($_POST["rehabPermit"] == "Yes" ){
        $rehabPermit = 1;
        $permitType = $_POST["permitType"];
        $permitTypeQuery = ",permittype = '".$permitType."'";
    }

    $newPerson = new Person();

    $newPerson->setHouseNumber($houseNum);
    $newPerson->setStreet($street);
    $newPerson->setCityCounty($cityCounty);
    $newPerson->setStateAbb($stateAbb);
    $newPerson->setZip($zipCode);

    $houseNum = $newPerson->getHouseNumber();
    $street = $newPerson->getStreet();
    $cityCounty = $newPerson->getCityCounty();
    $stateAbb = $newPerson->getStateAbb();
    $zipCode = $newPerson->getZip();

    $personUpdate = "update person set housenumber = ?, street = ?
    ,citycounty = ?,stateabb = ?,zipcode = ?, rabiesshot = ".$rabiesShot.$rabiesShotQuery.$permitTypeQuery."
    ,rehabpermit = ".$rehabPermit." where personid = ".$_SESSION["personid"];

    echo $personUpdate;

    $stmt = $conn->prepare($personUpdate);
    $stmt->bind_param("issss",$houseNum,$street,$cityCounty,$stateAbb,$zipCode);
    $stmt->execute();

/*
    $newEmergContact = new EmergContact();
    $newEmergContact->setFirstName($emergencyFirstName);
    $newEmergContact->setLastName($emergencyLastName);
    $newEmergContact->setPhone($emergencyPhone);
    $newEmergContact->setRelationship($emergencyRelationship);

    $emergencyFirstName = $newEmergContact->getFirstName();
    $emergencyLastName = $newEmergContact->getLastName();
    $emergencyPhone = $newEmergContact->getPhone();
    $emergencyRelationship = $newEmergContact->getRelationship();

    $insertEmergencyContact = "insert into emergcontact values (null,".$_SESSION["personid"].",?,?,?,?)";

    $stmt = $conn->prepare($insertEmergencyContact);
    $stmt->bind_param("ssss",$emergencyFirstName,$emergencyLastName,
        $emergencyPhone,$emergencyRelationship);
    $stmt->execute();
*/
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

    <title>Apply | Wildlife Center Volunteers</title>

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

        <h1>Volunteer Applications</h1>

        <div class="row">
            <form enctype="multipart/form-data" method="post" action="apply-specific.php">
            <div class="col-sm-6">
                

                <h2>Personal Information</h2>
                First name: <?php echo $firstName?><br>
                Last name: <?php echo $lastName?><br>
                Email: <?php echo $email ?><br>
                <br>
                
                Address:<br>
                House Number:<input name="houseNumber" type="text" ><br>
                Street:<input name="street" type="text" ><br>
                City:<input name="cityCounty" type="text" ><br>
                State:
                    <?php
                    
                    $sql = "select stateAbb,stateName from homestate";
                    $select = '<select name="stateAbb"';
                    $result = $conn->query($sql);

                    while ($row = mysqli_fetch_array($result))
                    {
                        $select.='<option value="'.$row["stateAbb"].'">'.$row["stateName"].'</option>';
                    }
                    $select.='</select>';
                    echo $select;
                    
                    ?>
                <br>
                Zipcode:<input name="zipCode" type="number">
                <br>
                Have you been vaccinated for rabies?<br>
                <input id="yesRabies" name="rabiesShot" type="radio" value="Yes" onclick="javascript:yesNoRabies();">Yes<br>
                <input name="rabiesShot" type="radio" value="No" onclick="javascript:yesNoRabies();">No<br>

                <div id="ifRabies" style="display:none">
                    <br>If yes, please upload your rabies form.<br>
                    <input name="rabiesDoc" type="file">
                </div>

                <div id="ifNoRabies" style="display:none;">
                    <br>If not, are you willing to become vaccinated at your own cost?<br>
                    <input name="rabiesOwnShot" value="Yes" type="radio">Yes<br>
                    <input name="rabiesOwnShot" value="No" type="radio">No<br>
                </div>

                <script type="text/javascript">
                    function yesNoRabies() {
                        if (document.getElementById('yesRabies').checked) {
                            document.getElementById('ifRabies').style.display = 'block';
                            document.getElementById('ifNoRabies').style.display = 'none'
                        }
                        else {
                            document.getElementById('ifRabies').style.display = 'none';
                            document.getElementById('ifNoRabies').style.display = 'block';
                        }
                    }

                    function yesNoRehab() {
                        if (document.getElementById('yesPermit').checked) {
                            document.getElementById('ifPermit').style.display = 'block';
                        }
                        else document.getElementById('ifPermit').style.display = 'none';
                    }
                </script>

                <br>Do you have a rehabilitation permit?<br>
                <input id="yesPermit" name="rehabPermit" type="radio" value="Yes" onclick="yesNoRehab()">Yes<br>
                <input name="rehabPermit" type="radio" value="No" onclick="yesNoRehab()">No<br>

                <div id="ifPermit" style="display:none">
                    <br>If so, please select the permit type below.<br>
                    <select name="permitType">
                        <option value="Cat 1">Category 1</option>
                        <option value="Cat 2">Category 2</option>
                        <option value="Cat 3">Category 3</option>
                        <option value="Cat 4">Category 4</option>
                    </select>
                </div>
                <h2>Emergency Contact</h2>
                First name:<br>
                <input name="emergencyFirstName" type="text" ><br>
                Last name:<br>
                <input name="emergencyLastName" type="text" ><br>
                Phone number:<br>
                <input name="emergencyPhone" type="text" ><br>
                Relationship:<br>
                <input name="emergencyRelationship" type="text" >
                <br>
            </div><!--End collumn-->

            <div class="col-sm-6">

            <!--This dropdown determines what application shows up below-->
            <h2>Choose a volunteer type:</h2>
            <select id="volunteer_type">
            <option value="1">Animal Care</option>
              <option value="2">Outreach</option>
              <option value="3">Transport</option>
              <option value="4">Veterinary</option>
            </select>
            <button id="volunteer_type_submit" onclick="vtype()">See application</button>
            <!--Application form for specific types of volunteers-->
            <!--Each type is in a div that appears/disappears depending on what you pick in the dropdown above.-->
                <!--Animal care application-->
                <div id="animal_care">
                    <h3>Animal Care Application</h3>
                    <p>Animal care volunteers work closely with the rehabilitation staff as they perform daily tasks including meal preparation and daily feeding/watering; monitoring progress of patients; recording weights and food intake; cage set-up and maintaining proper environment; daily exercise of raptor patients; assisting staff with capture and restraint of patients; hand-feeding orphaned birds; cleaning, hosing, and scrubbing pens of all animals housed in indoor and outdoor enclosures; and general cleaning including sweeping/mopping floors, washing dishes, disinfecting counters/sinks. Pre-exposure rabies vaccination is required to work with all juvenile and adult mammals. Responsibilities increase with experience and demonstrated commitment.</p>
                    <p>Requirements: Animal care volunteers must be at least 18 years of age and able to commit to a minimum of one shift per week for either six months or one year. Shifts run from 8:00 a.m. to 1:00 p.m., seven days per week. Space is limited to one volunteer per shift.</p>

                    Please briefly describe your relevant hands-on experience with animals, if any. What did you enjoy about the experience? What did you dislike?<br>
                    <textarea></textarea><br>
                    <br>
                    Carnivorous patients are sometimes unable to eat food items whole due to their injuries; you may be required to cut and divide dead rodents, chicks, and fishes into smaller portions. Are you comfortable handling dead animals for this purpose?<br>
                    <textarea></textarea><br>
                    <br>
                    Prior to release from the Wildlife Center, many predatory birds are presented with live mice in order to evaluate their ability to capture prey in a controlled and measurable environment. What is your opinion on using live-prey for this purpose?<br>
                    <textarea></textarea><br>
                    <br>
                    Wildlife rehabilitation requires daily outdoor work -- year-round and regardless of weather conditions. Are you able to work outside during all seasons? If not, what are your limitations?<br>
                    <textarea></textarea><br>
                    <br>
                    What days are you available, and at what times?<br>
                    <textarea></textarea><br>
                    <br>
                    Will you be able to commit to either a six-month or one-year schedule, with at least one shift (four hours) per week?<br>
                    <input type="radio">Yes<br>
                    <input type="radio">No<br>
                    <br>
                    Do you belong to any animal rights groups (PETA, The Humane Society, etc.)? If so, which ones?<br>
                    <input type="radio">Yes<br>
                    <input type="radio">No<br>
                    <br>
                    What do you hope to learn or accomplish by volunteering at the Wildlife Center of Virginia?<br>
                    <textarea></textarea><br>
                    <br>
                    Please describe an environmental or wildlife-based issue you feel passionately about, and why:<br>
                    <textarea></textarea><br>
                    <br>
                    Is there anything else that you’d like us to know about yourself or your experience?<br>
                    <textarea></textarea><br>
                    <br>
                    Please upload a resume or CV and a letter of recommendation.<br>
                    <button>Upload</button><br>
                    <br>
                    <input type="submit" name="animalCareSubmit" value="Submit Application">
                </div>
                <!--End animal care application-->

                <!--Outreach volunteer application-->
                <div id="outreach">
                    <h3>Outreach Application</h3>
                        Why are you interested in volunteering as an outreach docent?<br>
                        <textarea></textarea><br>
                        <br>
                        What’s an environmental or wildlife issue you feel passionately about, and why?<br>
                        <textarea></textarea><br>
                        <br>
                        What do you think you’d bring to the outreach volunteer team?<br>
                        <textarea></textarea><br>
                        <br>
                        Please upload a resume or CV and a letter of recommendation.<br>
                        <br>
                        <button>Upload</button><br>
                        <br>
                    <input type="submit" name="submit" value="Submit Application">
                </div>
                <!--End outreach application-->

                <!--Transporter application-->
                <div id="transport">
                    <h3>Transport Application</h3>
                    <p>Volunteer transporters provide a vital service to both the Wildlife Center of Virginia and the community by facilitating the rescue of wild animals. We appreciate that our volunteer transporters share the use of their vehicles, cost of gasoline, and valuable time to assist wildlife. Volunteer transporters provide a life-saving service.</p>

                    <p>If you’d like to join this pool of volunteers, please fill out this form. After we receive your application, we will send you an email with additional information. Unless you otherwise specify, we will add you to our active referral list immediately and you may be start receiving calls from the public for transport help right away, or you may not get any calls for six months or more.</p>
                    
                    How far are you willing to travel for transport (i.e., 30-45 miles from your location, to a specific location, etc)?<br>
                    <textarea></textarea><br>
                    <br>
                    Please upload a resume or CV and a letter of recommendation.<br>
                    <button>Upload</button><br>
                    <br>
                    <input type="submit" name="submit" value="Submit Application">
                </div>
                <!--End transporter application-->

                <!--Veterinary application-->
                <div id="veterinary">
                    <h3>Veterinary Application</h3>
                    <p>We do not have any open veterinary positions at this time.</p>
                    <input type="submit" name="submit" value="Submit Application">
                </div>
                <!--End veterinary application-->
            </div><!--End collumn-->
            </form>
        </div><!--End row-->
        </div><!--End column-->
  	</div><!--End row-->

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