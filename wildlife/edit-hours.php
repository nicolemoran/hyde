<?php
include ('loginheader.php');
global $hoursArray;
global $milesArray;
global $hoursDateArray;
global $milesDateArray;

?>
    <h1>Hours Page</h1>
    <html>
    <head>
        <title>Miles and Hours</title>
    </head>
    <body>
    <form action="edit-hours.php" method="post">
        <input type="submit" value="Save" name="save"><br/>
        Edit Hours <br/>



<?php
include ('SQLConnection.php');
//SQL connection and variables
    $newSQL = new SQLConnection();
    $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());
    $newSQL->checkConnection();
    $milesArray=array();
    $hoursArray=array();
    $milesDateArray=array();
    $hoursDateArray=array();
    $mileIDArray=array();
    $hourIDArray=array();

$query = "SELECT hoursID, dateAdded, hours from wcv.hours where personid =" . $_SESSION["personid"]. " ORDER BY dateAdded";
$stmt = $conn->prepare($query);

//Executes and captures the query
$stmt->execute();
//Retains the results
$result = $stmt->get_result();
$count = 0;
//Captures the results
while ($row = $result->fetch_assoc()) {
    $date = $row['dateAdded'];
    $hours = $row['hours'];
    $hourID = $row['hoursID'];
    $hourIDArray[$count] = $hourID;
    $hoursArray[$count] = $hours;
    $hoursDateArray[$count] =$date;
    $count++;
}

$query = "SELECT milesID, dateAdded, miles from wcv.miles where personid =" . $_SESSION["personid"]." ORDER BY dateAdded";
$stmt = $conn->prepare($query);

//Executes and captures the query
$stmt->execute();
//Retains the results
$result = $stmt->get_result();
$count = 0;
//Captures the results
while ($row = $result->fetch_assoc()) {
    $date = $row['dateAdded'];
    $miles = $row['miles'];
    $mileID = $row['milesID'];
    $mileIDArray[$count] = $mileID;
    $milesDateArray[$count] = $date;
    $milesArray[$count] = $miles;
    $count++;
}

//Displays the database results in editable text boxes
$hourCount = 1;
$i =0;

foreach($hoursArray as $value)
{


    echo "Date: <input type='date' title='Date' name='$hourCount' value='$hoursDateArray[$i]'/>";

    $hourCount++;

    echo "Hours: <input type='text' title='Hours' name='$hourCount' value='$value'/>";

    echo "<br/>";
    $i++;
    $hourCount++;

}
$hourCount--;
$mileCount = $hourCount + 1;
$i=0;
echo "<br/><br/>Miles<br/>";
foreach($milesArray as $value)
{

    echo "Date: <input type='date' title='Date' name='$mileCount' value='$milesDateArray[$i]'/> ";
    $mileCount++;

    echo "Miles: <input type='text' title='Miles' name='$mileCount' value='$value'/> ";
    echo "<br/>";
    $i++;
    $mileCount++;
}

$mileCount--;

//When the save button is pressed
if(isset($_POST["save"]))
{
    $idMileCount = sizeof($mileIDArray);
    $idHourCount = sizeof($hourIDArray);
    $counter = $idMileCount;
    $idMileCount--;


    //Gets the updated values for mile
    for($y = $counter; $y > 0; $y--) {
        $miles = isset($_POST[$mileCount]) ? $_POST[$mileCount] : '';
        $mileCount--;
        $date = isset($_POST[$mileCount]) ? $_POST[$mileCount] : '';
        $mileCount--;
        $id = $mileIDArray[$idMileCount];
        $idMileCount--;

        echo $miles;
        //Sends those values to the database
        if($miles != '' && $date != '')
        {
            $query = "UPDATE wcv.miles SET miles = ?, dateAdded = ? WHERE milesID = $id";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ds",$miles, $date);

            $stmt->execute();
        }
        else
        {
            echo "
		<script type=\"text/javascript\">					
	    alert(\"Update not committed because date or miles is empty \");
		</script>;";
        }
    }
    $counter = $idHourCount;
    $idHourCount--;
    //Gets the updated values for hours
    for($c = $counter; $c > 0; $c--) {
        $hours = isset($_POST[$hourCount]) ? $_POST[$hourCount] : '';

        $hourCount--;
        $date = isset($_POST[$hourCount]) ? $_POST[$hourCount] : '';

        $hourCount--;
        $id = $hourIDArray[$idHourCount];
        $idHourCount--;
        echo "<br/>";

        //Sends those values to the database
        if($hours != '' && $date != '')
        {
            $query = "UPDATE wcv.hours SET hours = ?, dateAdded = ? WHERE hoursID = $id";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ds",$hours, $date);
            $stmt->execute();
        }
        else
        {
            echo "
		<script type=\"text/javascript\">					
	    alert(\"Update not committed because date or hours is empty \");
		</script>;";
        }

    }

    header('Location: profile.php');
    exit;
}
?>
    </form>
    </body>
    </html>
