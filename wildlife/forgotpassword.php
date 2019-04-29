<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
<form action="forgotpassword.php" method="post">
    Email <input  title= "Forgot Password" type="text" name="email"> <br/>
    Enter Code: <input  title= "Forgot Password" type="text" name="code"> <br/>
    <input type="submit" name="submit">
</form>

<?php
include 'SQLConnection.php';
if (isset($_POST["submit"]))
{
    //Gets variables
    $databaseCode = "";
    $code = (isset($_POST["code"]) ? $_POST["code"] : null);
    $email = (isset($_POST["email"]) ? $_POST["email"] : null);

    //SQL connection
    $newSQL = new SQLConnection();
    $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());
    $newSQL->checkConnection();

    //Creates the query
    $query = "SELECT randompass FROM wcv.login WHERE email = ?";

    //Prepares and executes the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s",$email);
    if ($stmt->execute()) {
        //Retains the results
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $databaseCode = $row["randompass"];
        }
    }
    else
    {
        echo "
		<script type=\"text/javascript\">					
	    alert(\"Email address does not match our records\");
		</script>;";
    }

    //Evaluates the code
    if($databaseCode === $code)
    {
        header("Location: newpassword.php");
        exit;
    }
    else
    {
        echo "
		<script type=\"text/javascript\">					
	    alert(\"Recovery code does not match\");
		</script>;";
    }
}
?>