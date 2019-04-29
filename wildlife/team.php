<?php
include("SQLConnection.php");
include("loginheader.php");
include("outreachClass.php");
include("animalCareClass.php");
include("treatmentClass.php");
include("transportClass.php");

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
        if (strtolower($apStatus[$i]) == 'active') {
            $anCare = 1;
        }
    } else if (strtolower($teamName[$i]) == 'front desk') {
        if (strtolower($apStatus[$i]) == 'active') {
            $ftDesk = 1;
        }
    } else if (strtolower($teamName[$i]) == 'outreach') {
        if (strtolower($apStatus[$i]) == 'active') {
            $outreach = 1;
        }
    } else if (strtolower($teamName[$i]) == 'transporter') {
        if (strtolower($apStatus[$i]) == 'active') {
            $trans = 1;
        }
    } else if (strtolower($teamName[$i]) == 'treatment') {
        if (strtolower($apStatus[$i]) == 'active') {
            $treat = 1;
        }
    }
}
?>

<h1>Team Page</h1>
<div class="row">

    <!--<p>
    123 Main Street<br>
    Harrisonburg, VA<br>
    22801<br>
    <a href="mailto:someone@example.com?Subject=Hello%20again\" target=\"_top\">jimsemail@email.com</a></p>-->

    <!--Second column-->
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
                              <p>' . $teamLead . '</p>
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




                      echo "<h1>Outreach Fields</h1>
                      Number of times shadowed:</br>
                      <p> Date of first shadow: " . $newOutreach->getShadowed1Date() . "<br>
                          Date of second shadow: " . $newOutreach->getShadowed2Date() . "<br>
                          Date of third shadow: " . $newOutreach->getShadowed3Date() . "<br></p>
                      Introduction: ";
                      if ($newOutreach->getIntro() == 1) { echo "Yes"; } else { echo "No"; }
                      echo "<br>Lead tour alone: ";
                      if ($newOutreach->getLeadAlone() == 1) { echo "Yes"; } else { echo "No"; }
                      echo "<br>Offsite:";
                      if ($newOutreach->getOffsite() == 1) { echo "Yes"; } else { echo "No"; }
                      echo "<br><br>Notes:</br>" . $newOutreach->getNotes() . "
                  </div>
                </div>
            </div>"; }
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

        $sqlSelect = "SELECT concat(tl.firstname, ' ', tl.lastname) AS 'name' FROM teamlead tl INNER JOIN "
            . "team t ON tl.teamLeadid = t.teamleadid INNER JOIN teamstatus ts ON t.teamid = ts.teamid INNER JOIN "
            . "person p ON ts.personid = p.personid WHERE teamname = 'animal care' AND p.personid = " . $profileID;
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

                      Reptile Room: ' . $newAnCare->getReptileRoom() . '<br>' .
            'Reptile Room Soak Day: ' . $newAnCare->getReptileSoak() . '<br>' .
            'Education Snake Feeding Day: ' . $newAnCare->getSnakeFeed() . '<br>' .
            'ICU: ' . $newAnCare->getICU() . '<br>' .
            'Expanded ICU: ' . $newAnCare->getExICU() . '<br>' .
            'Aviary: ' . $newAnCare->getAviary() . '<br>' .
            'Mammals: ' . $newAnCare->getMammals() . '<br>' .
            'PU & E: ' . $newAnCare->getPUE() . '<br>' .
            'PU & E Weigh Day: ' . $newAnCare->getPUEweigh() . '<br>' .
            'Fawns: ' . $newAnCare->getFawns() . '<br>' .
            'Formula: ' . $newAnCare->getFormulas() . '<br>' .
            'Meals: ' . $newAnCare->getMeals() . '<br>' .
            'Raptor Feed: ' . $newAnCare->getRaptorFeed() . '<br>' .
            'ISO: ' . $newAnCare->getISO() . '<br><br>' .
            'Notes:<br>'
            . $newAnCare->getNotes() . '
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

                      Capture and Restraint class: ';
                      if ($newTransport->getCaptureRestraint() == 1) { echo "Yes"; } else { echo "No"; }
                      echo '</br>
                      Distance limits: ' . $newTransport->getDistanceLimits() . '</br>' .
                      'Animal Limitations:</br>' .
                      $newTransport->getAnimalLimitsSA() . '<br><br>' .
                      'Notes:</br>' .
                      $newTransport->getNotes() .
                  '</div>
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

    $sqlSelect = "SELECT concat(tl.firstname, ' ', tl.lastname) AS 'name' FROM teamlead tl INNER JOIN "
        . "team t ON tl.teamLeadid = t.teamleadid INNER JOIN teamstatus ts ON t.teamid = ts.teamid INNER JOIN "
        . "person p ON ts.personid = p.personid WHERE teamname = 'treatment team' AND p.personid = " . $profileID;
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

                      <b>Handling Skills:</b><br>
                      Small Mammals: ';
                      if ($newTreatment->getSmMam() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Large Mammals: ';
                      if ($newTreatment->getLrgMam() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      RVS: ';
                      if ($newTreatment->getRVS() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Eagles: ';
                      if ($newTreatment->getEagle() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Small Raptors: ';
                      if ($newTreatment->getSmRaptor() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Large Raptors: ';
                      if ($newTreatment->getLrgRaptor() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Reptiles: ';
                      if ($newTreatment->getReptile() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Veterinarian: ';
                      if ($newTreatment->getVet() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Technician: ';
                      if ($newTreatment->getTech() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Veterinarian Student: ';
                      if ($newTreatment->getVetStudent() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Technician Student: ';
                      if ($newTreatment->getTechStudent() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Veterinarian Assistant: ';
                      if ($newTreatment->getVetAssistant() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Medicating: ';
                      if ($newTreatment->getMedicating() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Bandaging: ';
                      if ($newTreatment->getBandaging() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Wound Care: ';
                      if ($newTreatment->getWoundCare() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Diagostics: ';
                      if ($newTreatment->getDiag() == 1) { echo "Yes"; } else { echo "No"; } echo '</br>
                      Anesthesia: ';
                      if ($newTreatment->getAnesthesia() == 1) { echo "Yes"; } else { echo "No"; } echo '</br></br>

                      Notes:</br>' .
                      $newTreatment->getNotes() .
                  '</div>
                </div>
            </div>';
}
if ($ftDesk == 1) {
            echo '<div class="team">
                <div class="panel-heading" role="tab" id="headingFive">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      Front Desk
                    </a>
                  </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                  <div class="panel-body">';
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

                      echo '<div>
                          <h3>Team Leader</h3>
                          <div class="infoblock">
                              <p>' . $teamLead . '</p>
                          </div>
                      </div>';

                      $sqlSelect = "select notes from frontDesk where frntdskid = " . $profileID;
                      $result = $conn->query($sqlSelect);
                      $frntDskNotes = null;
                      if ($result->num_rows > 0) {
                          // output data of each row
                          while ($row = $result->fetch_assoc()) {
                              $frntDskNotes = $row["notes"];
                          }
                      }

                      echo '<h1>Front Desk Fields</h1>
                      Notes:</br>'
                      . $frntDskNotes .
                  '</div>
                </div>
            </div>
          </div>';
}?>
</div><!--End row-->