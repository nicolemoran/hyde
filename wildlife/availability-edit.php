<h1>Availability Fields</h1>

<form action="availability-edit.php" method="post">
    Day of Week: <input type="checkbox" name="monday" value="1"> Monday
    <input type="checkbox" name="tuesday" value="2"> Tuesday
    <input type="checkbox" name="wednesday" value="3"> Wednesday
    <input type="checkbox" name="thursday" value="4"> Thursday
    <input type="checkbox" name="friday" value="5"> Friday
    <input type="checkbox" name="saturday" value="6"> Saturday
    <input type="checkbox" name="sunday" value="7"> Sunday</br>
    Season: <input type="checkbox" name="spring" value="1"> Spring
    <input type="checkbox" name="summer" value="2"> Summer
    <input type="checkbox" name="fall" value="3"> Fall
    <input type="checkbox" name="winter" value="4"> Winter
    </br>
    Start Time: <input type="time" name="startTime" value=""></br>
    End Time: <input type="time" name="endTime" value=""></br></br>

    <input type="submit" name="add" value="Add">
    <input type="submit" name="remove" value="Remove"></br>

    <?php
    $dayOfWeek = "";
    $season = "";
    $time = "";
    $entry = "";

    if (isset($_POST["add"])) {
        if(!empty($_POST["monday"])) {
            $monday = $_POST["monday"];
            $dayOfWeek .= " Monday,";
        }
        if(!empty($_POST["tuesday"])) {
            $tuesday = $_POST["tuesday"];
            $dayOfWeek .= " Tuesday,";
        }
        if(!empty($_POST["wednesday"])) {
            $wednesday = $_POST["wednesday"];
            $dayOfWeek .= " Wednesday,";
        }
        if(!empty($_POST["thursday"])) {
            $thursday = $_POST["thursday"];
            $dayOfWeek .= " Thursday,";
        }
        if(!empty($_POST["friday"])) {
            $friday = $_POST["friday"];
            $dayOfWeek .= " Friday,";
        }
        if(!empty($_POST["saturday"])) {
            $saturday = $_POST["saturday"];
            $dayOfWeek .= " Saturday,";
        }

        if(!empty($_POST["sunday"])) {
            $sunday = $_POST["sunday"];
            $dayOfWeek .= " Sunday,";
        }


        //season
        if(!empty($_POST["spring"])) {
            $spring = $_POST["spring"];
            $season .= " Spring,";
        }
        if(!empty($_POST["summer"])) {
            $summer = $_POST["summer"];
            $season .= " Summer,";
        }
        if(!empty($_POST["fall"])) {
            $fall = $_POST["fall"];
            $season .= " Fall,";
        }
        if(!empty($_POST["winter"])) {
            $winter = $_POST["winter"];
            $season .= " Winter,";
        }

        $startTime = $_POST["startTime"];
        $endTime = $_POST["endTime"];
        $time = $startTime . " - " . $endTime;

        $entry = $season . " | " . $dayOfWeek . " | " . $time . "\n";

    }
    ?>

    <textarea rows="10" name="availabilityDisplay" cols="70" placeholder="Enter notes here."><?php echo $entry; ?></textarea></br>
    <input type="submit" name="submit" value="Submit"></br></br>

    <select name="avail" size="7" multiple>
        <option value="yo1">Numba 1</option>
        <option value="yo2">Numba 2</option>
        <option value="yo3">Numba 3</option>
    </select>

    <input type="submit" name="pick" value="Pick One">

    <?php
        if(isset($_POST['pick'])){
            echo $_POST['avail'];
        }
    ?>

</form>