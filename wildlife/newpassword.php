<html>
<head>
    <title>Enter New Password</title>
</head>
<body>
<form action="newpassword.php" method="post">
    Email <input  title="Email" type="text" name="email"> <br/>
    Enter New Password: <input  title= "NewPassword" type="text" name="password"> <br/>
    <input type="submit" name="submit">
</form>

<?php
include 'SQLConnection.php';
include 'Email.php';

if (isset($_POST["submit"]))
{
    //Gets the inputted fields
    $email = (isset($_POST['email']) ? $_POST['email'] : null);
    $password = (isset($_POST['password']) ? $_POST['password'] : null);

    //Defines variables
    $firstName = "";
    $lastName = "";
    $name = "";

    //SQL connection
    $newSQL = new SQLConnection();
    $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());
    $newSQL->checkConnection();

    $password = (isset($_POST["password"]) ? $_POST["password"] : null);

    echo "Email: " . $email;
    echo "<br/>" . "Password: " . $password;

    $hash = password_hash($password, PASSWORD_DEFAULT);

    echo "<br/>Hash: " . $hash;

    $correct = password_verify($password, $hash);
    echo "<br/>Verify: " . password_verify($password, PASSWORD_DEFAULT);

    //Creates the query
    $query = "UPDATE wcv.login SET passwd= ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss",$hash,$email);


    //Sends the query
    if ($stmt->execute()) {

        //Creates a query for getting the name
        $query = "SELECT firstname, lastname FROM wcv.person INNER JOIN wcv.login on person.personid = 
            login.personid WHERE login.email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s",$email);

        //Sends the new query
        if ($stmt->execute()) {

            //Retains the results
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $firstName = $row["firstname"];
                $lastName = $row["lastname"];
            }

            $name = $firstName . " ". $lastName;
        }
        //Creates a new email and sets values
        $newEmail = new Email();
        $newEmail ->setRecieverEmail($email);
        $newEmail ->setRecieverName($name);
        $newEmail ->emailPassChangeSuccess();
        header("Location: login.php");
        exit;
    }

}

?>