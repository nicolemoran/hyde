<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <?php
            if ($_SESSION["permission"] == 3) {
                echo '<li class="active"><a href="adminhome.php">Home</a></li>';
                echo '<li><a href="application-review.php">Application Review</a></li>';
            }else{
                echo '<li class="active"><li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="#">My Applications</a></li>
                <li><a href="apply-specific.php">Apply</a></li>';
            }

            if ($_SESSION["permission"] >= 1){
                echo '<li><a href="calendar.php">Calendar</a></li>
                      <li><a href="map.php">Map</a></li>';
            }
            ?>

            <!--Why do we need contact?-->

            <!--<li><a href="#">Contact</a></li>-->

            <?php if ($_SESSION["permission"] == 3){
                echo '<li><a href="search.php">Search</a></li>';
            } ?>
        </ul>
        <a href="logout.php">
            <button type="button" class="btn btn-link">Log Out</button>
        </a>
    </div>
</nav>