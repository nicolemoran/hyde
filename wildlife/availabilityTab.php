<h1>Availability</h1>

<form action="availability-edit.php" method="post">
    <?php
    require("SQLConnection.php");
    include("loginheader.php");

    $newSQL = new SQLConnection();
    $conn = new mysqli($newSQL->getServerName(), $newSQL->getUserName(), $newSQL->getPassword(), $newSQL->getDB());

    global $personid, $dow, $season, $starttime, $endtime, $dayOfWeek, $dayOfWeek2;

    $personid = $_SESSION['personid'];


    $sql = "select dow, season, starttime, endtime from availability where personid = ".$personid." and season like '%win%'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dayOfWeek2 = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $dayOfWeek = "";
            $dow = $row['dow'];
            $season = $row['season'];
            $starttime = $row['starttime'];
            $endtime = $row['endtime'];

                if (strpos($dow, 'mon') !== false) {
                    if ($dayOfWeek == "") {
                        $dayOfWeek .= "Monday's";
                    } elseif ($dayOfWeek !== "") {
                        $dayOfWeek .= " and Monday's";
                    }
                }
                if (strpos($dow, 'tue') !== false) {
                    if ($dayOfWeek == "") {
                        $dayOfWeek .= "Tuesday's";
                    } elseif ($dayOfWeek !== "") {
                        $dayOfWeek .= " and Tuesday's";
                    }
                }
                if (strpos($dow, 'wed') !== false) {
                    if ($dayOfWeek == "") {
                        $dayOfWeek .= "Wednesday's";
                    } elseif ($dayOfWeek !== "") {
                        $dayOfWeek .= " and Wednesday's";
                    }
                }
                if (strpos($dow, 'thu') !== false) {
                    if ($dayOfWeek == "") {
                        $dayOfWeek .= "Thursday's";
                    } elseif ($dayOfWeek !== "") {
                        $dayOfWeek .= " and Thursday's";
                    }
                }
                if (strpos($dow, 'fri') !== false) {
                    if ($dayOfWeek == "") {
                        $dayOfWeek .= "Friday's";
                    } elseif ($dayOfWeek !== "") {
                        $dayOfWeek .= " and Friday's";
                    }
                }
                if (strpos($dow, 'sat') !== false) {
                    if ($dayOfWeek == "") {
                        $dayOfWeek .= "Saturday's";
                    } elseif ($dayOfWeek !== "") {
                        $dayOfWeek .= " and Saturday's";
                    }
                }
                if (strpos($dow, 'sun') !== false) {
                    if ($dayOfWeek == "") {
                        $dayOfWeek .= "Sunday's";
                    } elseif ($dayOfWeek !== "") {
                        $dayOfWeek .= " and Sunday's";
                    }
                }
            $dayOfWeek2 .= "<br />".$dayOfWeek." between ".$starttime." and ".$endtime;
        }

        echo "<br /><br /><b>Winter: </b>".$dayOfWeek2;
    }

    $sql = "select dow, season, starttime, endtime from availability where personid = ".$personid." and season like '%spr%'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dayOfWeek2 = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $dayOfWeek = "";
            $dow = $row['dow'];
            $season = $row['season'];
            $starttime = $row['starttime'];
            $endtime = $row['endtime'];

            if (strpos($dow, 'mon') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Monday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Monday's";
                }
            }
            if (strpos($dow, 'tue') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Tuesday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Tuesday's";
                }
            }
            if (strpos($dow, 'wed') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Wednesday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Wednesday's";
                }
            }
            if (strpos($dow, 'thu') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Thursday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Thursday's";
                }
            }
            if (strpos($dow, 'fri') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Friday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Friday's";
                }
            }
            if (strpos($dow, 'sat') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Saturday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Saturday's";
                }
            }
            if (strpos($dow, 'sun') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Sunday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Sunday's";
                }
            }
            $dayOfWeek2 .= "<br />".$dayOfWeek." between ".$starttime." and ".$endtime;
        }

        echo "<br /><br /><b>Spring: </b>".$dayOfWeek2;

    }

    $sql = "select dow, season, starttime, endtime from availability where personid = ".$personid." and season like '%sum%'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dayOfWeek2 = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $dayOfWeek = "";
            $dow = $row['dow'];
            $season = $row['season'];
            $starttime = $row['starttime'];
            $endtime = $row['endtime'];

            if (strpos($dow, 'mon') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Monday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Monday's";
                }
            }
            if (strpos($dow, 'tue') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Tuesday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Tuesday's";
                }
            }
            if (strpos($dow, 'wed') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Wednesday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Wednesday's";
                }
            }
            if (strpos($dow, 'thu') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Thursday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Thursday's";
                }
            }
            if (strpos($dow, 'fri') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Friday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Friday's";
                }
            }
            if (strpos($dow, 'sat') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Saturday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Saturday's";
                }
            }
            if (strpos($dow, 'sun') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Sunday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Sunday's";
                }
            }
            $dayOfWeek2 .= "<br />".$dayOfWeek." between ".$starttime." and ".$endtime;
        }

        echo "<br /><br /><b>Summer: </b>".$dayOfWeek2;
    }

    $sql = "select dow, season, starttime, endtime from availability where personid = ".$personid." and season like '%fall%'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dayOfWeek2 = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $dayOfWeek = "";
            $dow = $row['dow'];
            $season = $row['season'];
            $starttime = $row['starttime'];
            $endtime = $row['endtime'];

            if (strpos($dow, 'mon') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Monday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Monday's";
                }
            }
            if (strpos($dow, 'tue') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Tuesday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Tuesday's";
                }
            }
            if (strpos($dow, 'wed') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Wednesday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Wednesday's";
                }
            }
            if (strpos($dow, 'thu') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Thursday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Thursday's";
                }
            }
            if (strpos($dow, 'fri') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Friday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Friday's";
                }
            }
            if (strpos($dow, 'sat') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Saturday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Saturday's";
                }
            }
            if (strpos($dow, 'sun') !== false) {
                if ($dayOfWeek == "") {
                    $dayOfWeek .= "Sunday's";
                } elseif ($dayOfWeek !== "") {
                    $dayOfWeek .= " and Sunday's";
                }
            }
            $dayOfWeek2 .= "<br />".$dayOfWeek." between ".$starttime." and ".$endtime;
        }

        echo "<br /><br /><b>Fall: </b>".$dayOfWeek2;
    }
    ?>
    <br /><br /><br />
    <button type="submit" name="edit" href="availability-edit.php">Edit Availability</button></br></br>
</form>