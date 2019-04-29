
<?php
include ('loginheader.php');
include ('SQLConnection.php');
global $hoursArray;
global $milesArray;
global $hoursDateArray;
global $milesDateArray;

$profileID = $_SESSION["personid"];

if (isset($_SESSION["adminSearch"]))
{
    $profileID = $_SESSION["adminSearch"];
}

//SQL connection and variables
$newSQL = new SQLConnection();
$conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());
?>
<html>
<head>
    <title>Miles and Hours</title>
</head>
<h1>Hours Page</h1>
<body>
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

Total Hours: <?php echo $totalHours; ?><br>
Total Miles: <?php echo $totalMiles; ?><br><br>

<form action="hours.php" method="post">
    Miles and Hours<br/>
    <input type="submit" value="Add" name="add"><br/>
    <input type="submit" value="Edit" name="edit"><br/>
    Add Hours and Miles<br/>
    Hours:<input title= "Enter Hours" type="text" name="hours" placeholder="0.00"><br/>
    Miles:<input title="Enter Miles" type="text" name="miles" placeholder="0.00"><br/>
    Date:<input title="Enter Date" type="date" name="date"><br/>
    Current Hours <br/><br/>
</form>
    <?php
    //Displays the users hours
    $milesArray=array();
    $hoursArray=array();
    $milesDateArray=array();
    $hoursDateArray=array();

    //When the Add button is pressed
    if(isset($_POST["add"])){
        $hours = (isset($_POST["hours"]) ? $_POST["hours"] : null);
        $miles = (isset($_POST["miles"]) ? $_POST["miles"] : null);
        $date = (isset($_POST["date"]) ? $_POST["date"] : null);

        //Creates queries
        if($hours != null)
        {
            $query = "INSERT into wcv.hours (dateAdded, hours, personid) values (?,?," . $profileID." )";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sd",$date, $hours);
            $stmt->execute();
        }
        if($miles != null)
        {
            $query = "INSERT into wcv.miles (dateAdded, miles, personid) values (?,?," . $profileID." )";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sd",$date, $miles);
            $stmt->execute();
        }
        header('Location: hours.php');
        exit;
    }

    //Displays total hours
    $totalMeasure = 0.0;

    $query = "SELECT dateAdded, hours from wcv.hours where personid =" . $profileID. " ORDER BY dateAdded";
    $stmt = $conn->prepare($query);

    //Executes and captures the query
    $stmt->execute();
    //Retains the results
    $result = $stmt->get_result();
    $count = 0;
    //Shows the results
    while ($row = $result->fetch_assoc()) {
        $date = $row['dateAdded'];
        $hours = $row['hours'];
        $totalMeasure += $hours;
        echo "On: $date You Clocked: $hours hours ". "<br/>";
        $hoursArray[$count] = $hours;
        $hoursDateArray[$count] =$date;
        $count++;
    }
    echo "Total Hours: $totalMeasure ". "<br/>";
    echo '<br/>';
    echo 'Current Miles<br/><br/>';

    //Displays total miles
    $totalMeasure = 0.0;

    $query = "SELECT dateAdded, miles from wcv.miles where personid =" . $profileID." ORDER BY dateAdded";
    $stmt = $conn->prepare($query);

    //Executes and captures the query
    $stmt->execute();
    //Retains the results
    $result = $stmt->get_result();
    $count = 0;
    //Shows the results
    while ($row = $result->fetch_assoc()) {
        $date = $row['dateAdded'];
        $miles = $row['miles'];
        $totalMeasure += $miles;
        echo "On: $date You Clocked: $miles miles ". "<br/>";
        $milesDateArray[$count] = $date;
        $milesArray[$count] = $miles;
        $count++;
    }
    echo "Total Hours: $totalMeasure ". "<br/>";


    //When the edit button is pressed
    if(isset($_POST["edit"])){
        header('Location: edit-hours.php');
        exit;
    }
    ?>


</body>
</html>

