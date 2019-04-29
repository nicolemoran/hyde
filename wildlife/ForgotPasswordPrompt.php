<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
<form action="ForgotPasswordPrompt.php" method="post">
    Email <input  title= "email" type="text" name="email"> <br/>
    <input type="submit" name="submit">
</form>

<?php

//File requires
require 'SQLConnection.php';
require 'Email.php';
require 'Server.php';

//On submit button click
if (isset($_POST["submit"]))
{
    $email = (isset($_POST['email']) ? $_POST['email'] : null);
    if($email == "")
    {
        echo "
		<script type=\"text/javascript\">					
	    alert(\"Enter an email and click again\");
		</script>;";
    }
    else
    {
        //Generates random recovery number
        $passwordRecoveryNumber = generatePasswordRecovery();

        //Makes sure the email matches and returns the account owner name
        $name = MatchEmailName($email, $passwordRecoveryNumber);

        //If name was found
        if($name != "")
        {
            //Sets the reset link
            $newServer = new Server();
            $newServer->discoverIPAddress();
            $server = $newServer->getServerIP();
            $actualLink = "http://$server/forgotPassword.php";
            $resetLink = "<a href=$actualLink>Change Password</a>";

            //Sends email
            $newEmail = new Email();
            $newEmail ->setRecieverEmail($email);
            $newEmail ->setRecieverName($name);
            $newEmail ->setResetLink($resetLink);
            $newEmail ->emailForgotPassword($resetLink, $passwordRecoveryNumber);
        }

    }
}

//Function to generate a password recovery code
function generatePasswordRecovery()
{
    $recoveryNumber = "";
    for($i = 0; $i < 6; $i++)
    {
        $recoveryNumber .= rand(1,9);
    }
    return $recoveryNumber;
}

//Function to make sure the email is valid and gets the email owners name
function MatchEmailName($email, $passwordRecoveryNumber)
{
    $newSQL = new SQLConnection();
    $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());
    $newSQL->checkConnection();
    $firstName = "";
    $lastName = "";
    $name = "";

    //Creates and prepares the query
    $query = "SELECT firstname, lastname FROM wcv.person INNER JOIN wcv.login on person.personid = 
            login.personid WHERE login.email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s",$email);

    //Sends the query
    if ($stmt->execute()) {
        //Retains the results
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $firstName = $row["firstname"];
            $lastName = $row["lastname"];
        }
        $name = $firstName . " ". $lastName;
    }

    //Creates and prepares the query
    $query = "UPDATE wcv.login SET randompass = $passwordRecoveryNumber WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);

    //Email validation
    if ($name == "") {
        echo "
		<script type=\"text/javascript\">					
	    alert(\"Email does not match records!\");
		</script>;";
    } else {
        //Sends the query
        if ($stmt->execute()) {
            echo "<script type=\"text/javascript\">					
	    alert(\"Check your email for password recovery!\");
		</script>;";
        }
        return $name;
    }
    return "";
}
?>

</body>
</html>

