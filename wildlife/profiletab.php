<?php
include("SQLConnection.php");
include("PersonClass.php");
include("EmergContactClass.php");
include("loginheader.php");
?>
<h1>General Info</h1>
<div class="col-xs-12">

            <?php
            $newSQL = new SQLConnection();
            $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());

            $profileID = $_SESSION["personid"];

            if (isset($_SESSION["adminSearch"]))
            {
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

                    $newPerson->setRabiesOwnCost($row["rabiesowncost"]);
                    $newPerson->setRabiesShot($row["rabiesshot"]);
                    $newPerson->setRabiesDate($row["rabiesdate"]);
                    $newPerson->setRehabilitationPermit($row["rehabpermit"]);
                    $newPerson->setPermitType($row["permittype"]);
                    $newPerson->setClocked($row["clocked"]);
                    $newPerson->setLastOutDate($row["lastoutDate"]);
                    $newPerson->setLastOutTime($row["lastoutTime"]);
                    $newPerson->setCarpentrySkills($row["carpentryskills"]);

                }
            }
            ?>

<div class="row">
    <!--First column-->
    <div class="col-xs-8">
        <div>
            <p>Shift Status (Clocked In/Clocked Out): <?php if($newPerson->getClocked() == 1) { echo "Clocked In"; } else { echo "Clocked Out"; } ?></p>
            <?php

            //display total hours and miles
            $sqlSelect = "select sum(hours) as 'hours' from hours where personid = " . $profileID;
            $result = $conn->query($sqlSelect);
            $totalHours = 0;
            if ($result) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $totalHours = $row["hours"];
                }
            }
            $sqlSelect = "select sum(miles) as 'miles' from miles where personid = " . $profileID;
            $result = $conn->query($sqlSelect);
            $totalMiles = 0;
            if ($result) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $totalMiles = $row["miles"];
                }
            }
            ?>
            <p>Last Shift: <?php
                if($newPerson->getLastOutDate() != '') { echo $newPerson->getLastOutDate() . " | " . $newPerson->getLastOutTime();
                } else { echo "No shifts worked to date"; } ?></p>
            <p>Total Hours: <?php echo $totalHours; ?></p>
            <p>Total Miles: <?php echo $totalMiles; ?></p>
            <p>Rabies Vaccinated: <?php if($newPerson->getRabiesShot() == 1) { echo "Completed on " . $newPerson->getRabiesDate(); } else { echo "No"; } ?></p>
            <P>Rehabilitation Permit: <?php if($newPerson->getRehabilitationPermit() == 1) { echo $newPerson->getPermitType(); } else { echo "No"; } ?></P>
            <p>Carpentry Skills: <?php if($newPerson->getCarpentrySkills() == 1) { echo "Yes"; } else { echo "No"; } ?></p>
        </div>
    </div>
</div><!--End column-->