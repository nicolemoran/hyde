<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="The website for Wildlife Center volunteers">
    <meta name="keywords" content="wildlife, volunteer, virginia">
    <meta name="author" content="Shanice McCormick and Nicole Moran">

    <title>Create Account | Wildlife Center Volunteers</title>

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
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <!--Spacer-->
        </div>
        <!--Logo-->
        <div class="col-xs-12 col-sm-6 vellum">
            <div class="row">
                <div class="col-sm-6">
                    <h3>WILDLIFE CENTER OF VIRGINIA</h3>
                    <img src="images/nature.png" alt="Logo" class="logo img-responsive">
                </div>
            </div><!--End row-->


            <div class="row">
                <div class="col-sm-2">
                    <!--Spacer-->
                </div>
                <div class="col-sm-8">

                    <h1>Create an Account</h1>

                    <!--Basic application form-->
                    <form id="apply" method="post" action="apply-main.php">
                    First name:<br>
                    <input class="apply-main name" type="text" name="firstName" required><br>
                    Middle name:<br>
                    <input class="apply-main name" type="text" name="middleName"><br>
                    Last name:<br>
                    <input class="apply-main name" type="text" name="lastName" required><br>
                    <br>
                    Email(Username):<br>
                    <input class="apply-main name" type="email" name="email" required><br>
                    <br>
                    Password:<br>
                    <input class="apply-main" type="password" name="pass" required><br>
                    Re-enter Password:<br>
                    <input class="apply-main" type="password" name="pass2" required><br>
                    <br>
                    Date of birth:<br>
                    <input class="apply-main" type="date" name="DOB" required><br>
                    <?php
                    include('SQLConnection.php');
                    include('Email.php');

                    $firstName = "";
                    $middleName = "";
                    $lastName = "";
                    $email = "";
                    $password = "";
                    $DOB = "";

                    if(isset($_POST["submitButton"])){
                        if($_POST['pass']!=$_POST['pass2']){
                            echo "<h5>Please make sure both password entries are the same</h5>";
                        }
                        else{
                            $firstName = array_key_exists('firstName', $_POST) ? $_POST['firstName']:null;
                            $lastName = array_key_exists('lastName', $_POST) ? $_POST['lastName']:null;
                            $DOB = array_key_exists('DOB', $_POST) ? $_POST['DOB']:null;
                            $password = array_key_exists('pass', $_POST) ? $_POST['pass']:null;

                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                            if (!empty($_POST['middleName'])){
                                $middleName = array_key_exists('middleName', $_POST) ? $_POST['middleName']:null;
                            }
                            if (!empty($_POST['email'])){
                                $email = array_key_exists('email', $_POST) ? $_POST['email']:null;
                            }
                            if (!empty($_POST['DOB'])){
                                $DOB = array_key_exists('DOB', $_POST) ? $_POST['DOB']:null;
                            }
                            if (!empty($_POST['phone'])){
                                $phone = array_key_exists('$phone', $_POST) ? $_POST['$phone']:null;
                            }

                            insertPerson($firstName, $middleName, $lastName, $email, $passwordHash, $DOB);

                            echo "<a href='home.php'></a>";
                        }

                    }

                    //Inserts a person into the appropriate tables
                    function insertPerson($firstName, $middleInitial, $lastName, $email, $passwordHash, $DOB){

                        //Variables
                        $personid = "";

                        //sql connection
                        $newSQL = new SQLConnection();
                        $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());

                        //Error connecting
                        if (!$conn) {
                            die("<h5>Connection failed: " . mysqli_connect_error() . "</h5>");
                        }

                        //Creates query
                        $query = "INSERT into wcv.person (firstname, middlename, lastname, DOB) values (?,?,?,?)";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ssss",$firstName, $middleInitial, $lastName, $DOB);

                        //Sends query
                        if ($stmt->execute()){
                            echo "Person created successfully.";

                            //Creates query to get the newly added person's personid
                            $query = "SELECT personid FROM wcv.person WHERE firstname = ? AND middlename = ? AND lastname = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("sss",$firstName, $middleInitial, $lastName);

                            //Executes and captures the query
                            $stmt->execute();
                            //Retains the results
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {
                                $personid = $row["personid"];
                                echo $personid;
                            }

                            //Inserts into login table
                            $query = "INSERT INTO wcv.login(email, passwd, personid, permissionLevel) VALUES (?,?,$personid,0)";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("ss",$email, $passwordHash);
                            $stmt->execute();

                            //Account creation email
                            $name = $firstName . " " . $lastName;
                            $newEmail = new Email();
                            $newEmail ->setRecieverEmail($email);
                            $newEmail ->setRecieverName($name);
                            $newEmail ->sendAccountSuccess();

                            $query = "insert into emergcontact (emergid, personid) values (null, " . $personid . ")";
                            $conn->query($query);

                            $todayDate = date("Y-m-d");
                            $query = "insert into documents values (null, " . $personid . ", 'profilepicture', 'jpg', 'profile.jpg', 'profilepictures/profile.jpg', null, '" .  $todayDate . "')";
                            $conn->query($query);

                            //To login page
                            header("Location: login.php");
                            exit;
                        }else{
                            echo "Error: ".$query."<br>".mysqli_error($conn);
                        }
                    }

                    ?>
                    <input type="submit" class="btn btn-default" value="Submit" name="submitButton"/>
                    </form>
                </div><!--End centered collumn-->
            </div><!--End row-->
        </div><!--End column-->
    </div><!--End row-->



</div>
</div>
</body>


<footer>
    <p>© 2017 The Wildlife Center of Virginia. All Rights Reserved.</p>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>



