<?php
$filename = './admin/dbconfig.php';
$login = 0;
if (file_exists($filename)) {
    require_once './admin/dbconfig.php';


    session_start();
    $wifi = "Yes";
    $pool = "NO";
    $parking = "NO";
    $bar = "NO";
    $spa = "NO";
    $gym = "NO";
    function initialFacilities()
    {
        global $wifi, $pool, $parking, $bar, $spa, $gym;
        $wifi = "NO";
        $pool = "NO";
        $parking = "NO";
        $bar = "NO";
        $spa = "NO";
        $gym = "NO";
    }

    function printFacilities()
    {
        echo '<p><Strong>WiFi:</Strong> ' . $wifi . '<br></p>';
        echo '<p><Strong>Swimming Pool:</Strong> ' . $pool . '<br></p>';
        echo '<p><Strong>Parking:</Strong> ' . $parking . '<br></p>';
        echo '<p><Strong>Bar:</Strong> ' . $bar . '<br></p>';
        echo '<p><Strong>Spa:</Strong> ' . $spa . '<br></p>';
        echo '<p><Strong>Gym:</Strong> ' . $gym . '<br></p>';
    }


    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (isset($_SESSION['username'])) {

        $username = $_SESSION['username'];
        date_default_timezone_set("UTC");
        $query = "Select users.username, users.typecode, user_type.type_code, user_type.type_name from users join user_type on users.typecode=user_type.type_code where md5(users.username) = '$username'";
        $result = mysqli_query($conn, ("Select users.*, user_type.* from users join user_type on users.typecode=user_type.type_code where md5(username) = '$username'")) or die("Failed to Retrive Database");
        $row = mysqli_fetch_assoc($result);
        $user_type = $row['type_name'];
        $login = 1;
    }

    $result2 = mysqli_query($conn, ("Select room_desc.*, beds.*, room_type.* from room_desc join beds on room_desc.bed_code=beds.bed_code right join room_type on room_desc.room_code=room_type.room_code where room_desc.room_code='1'")) or die("Failed to Retrive Database");
    $row2 = mysqli_fetch_assoc($result2);
    $result3 = mysqli_query($conn, ("Select room_desc.*, beds.*, room_type.* from room_desc join beds on room_desc.bed_code=beds.bed_code right join room_type on room_desc.room_code=room_type.room_code where room_desc.room_code='2'")) or die("Failed to Retrive Database");
    $row3 = mysqli_fetch_assoc($result3);
    $result4 = mysqli_query($conn, ("Select room_desc.*, beds.*, room_type.* from room_desc join beds on room_desc.bed_code=beds.bed_code right join room_type on room_desc.room_code=room_type.room_code where room_desc.room_code='3'")) or die("Failed to Retrive Database");
    $row4 = mysqli_fetch_assoc($result4);
}
else{
    header("Location: install.php");
}
$title = "Book Hotel Room";
include 'header.php';
?>
<body>
<div class="topnav navshadow" id="nav">
    <a href="./index.php" class="logo">Hotel Booking</a>
    <?php
    if($login==1){
        echo '<a href="dashboard.php" title="Dashboard"><i class="dripicons-briefcase"></i></a>
    <div class="navbar-right">
        <a href="logout.php" title="Logout"><i class="dripicons-exit"></i></a>
    </div>';
    }
    else{
        echo '<a href="signup.php" title="Registration"><i class="dripicons-user"></i></a>';
        echo '<div class="navbar-right">
        <a href="login.php" title="Login"><i class="dripicons-enter"></i></a>
    </div>';
    }
    ?>

</div>




    <div>
        <div class="displaybox dropshadow1">
            <h2>Single Room</h2>
            <img src="assets/images/single.jpg" alt="Single Room" height="250" width="400">
            <h3>Facilities</h3>
            <?php

            $bedtype = $row2['bed_name'];
            $bedcode = $row2['bed_code'];
            if($row2['free_wifi']=="y"){
                $wifi = "YES";
            }
            if($row2['swimming_pool']=="y"){
                $pool = "YES";
            }
            if($row2['parking']=="y"){
                $parking = "YES";
            }
            if($row2['bar']=="y"){
                $bar = "YES";
            }
            if($row2['spa']=="y"){
                $spa = "YES";
            }
            if($row2['gym']=="y"){
                $gym = "YES";
            }
            echo '<p><Strong>Room Type:</Strong> '.$row2['room_name'].'<br></p>';
            echo '<p><Strong>Bed Type:</Strong> '.$row2['bed_name'].'<br></p>';
            echo '<p><Strong>Bed Count:</Strong> '.$row2['bed_count'].'<br></p>';
            echo '<p><Strong>WiFi:</Strong> '.$wifi.'<br></p>';
            echo '<p><Strong>Swimming Pool:</Strong> '.$pool.'<br></p>';
            echo '<p><Strong>Parking:</Strong> '.$parking.'<br></p>';
            echo '<p><Strong>Bar:</Strong> '.$bar.'<br></p>';
            echo '<p><Strong>Spa:</Strong> '.$spa.'<br></p>';
            echo '<p><Strong>Gym:</Strong> '.$gym.'<br></p>';
            initialFacilities();
            ?>
            <a href="book.php"><button class="bookButton">Book Now</button></a>
        </div>
        <div class="displaybox dropshadow1">
            <h2>Double Room</h2>
            <img src="assets/images/double.jpg" alt="Single Room" height="250" width="400">
            <h3>Facilities</h3>
            <?php

            $bedtype = $row3['bed_name'];
            $bedcode = $row3['bed_code'];
            if($row3['free_wifi']=="y"){
                $wifi = "YES";
            }
            if($row3['swimming_pool']=="y"){
                $pool = "YES";
            }
            if($row3['parking']=="y"){
                $parking = "YES";
            }
            if($row3['bar']=="y"){
                $bar = "YES";
            }
            if($row3['spa']=="y"){
                $spa = "YES";
            }
            if($row3['gym']=="y"){
                $gym = "YES";
            }
            echo '<p><Strong>Room Type:</Strong> '.$row3['room_name'].'<br></p>';
            echo '<p><Strong>Bed Type:</Strong> '.$row3['bed_name'].'<br></p>';
            echo '<p><Strong>Bed Count:</Strong> '.$row3['bed_count'].'<br></p>';
            echo '<p><Strong>WiFi:</Strong> '.$wifi.'<br></p>';
            echo '<p><Strong>Swimming Pool:</Strong> '.$pool.'<br></p>';
            echo '<p><Strong>Parking:</Strong> '.$parking.'<br></p>';
            echo '<p><Strong>Bar:</Strong> '.$bar.'<br></p>';
            echo '<p><Strong>Spa:</Strong> '.$spa.'<br></p>';
            echo '<p><Strong>Gym:</Strong> '.$gym.'<br></p>';
            initialFacilities();
            ?>
            <a href="book.php"><button class="bookButton">Book Now</button></a>
        </div>
        <div class="displaybox dropshadow1">
            <h2>Family Room</h2>
            <img src="assets/images/family.jpg" alt="Single Room" height="250" width="400">
            <h3>Facilities</h3>
            <?php

            $bedtype = $row4['bed_name'];
            $bedcode = $row4['bed_code'];
            if($row4['free_wifi']=="y"){
                $wifi = "YES";
            }
            if($row4['swimming_pool']=="y"){
                $pool = "YES";
            }
            if($row4['parking']=="y"){
                $parking = "YES";
            }
            if($row4['bar']=="y"){
                $bar = "YES";
            }
            if($row4['spa']=="y"){
                $spa = "YES";
            }
            if($row4['gym']=="y"){
                $gym = "YES";
            }
            echo '<p><Strong>Room Type:</Strong> '.$row4['room_name'].'<br></p>';
            echo '<p><Strong>Bed Type:</Strong> '.$row4['bed_name'].'<br></p>';
            echo '<p><Strong>Bed Count:</Strong> '.$row4['bed_count'].'<br></p>';
            echo '<p><Strong>WiFi:</Strong> '.$wifi.'<br></p>';
            echo '<p><Strong>Swimming Pool:</Strong> '.$pool.'<br></p>';
            echo '<p><Strong>Parking:</Strong> '.$parking.'<br></p>';
            echo '<p><Strong>Bar:</Strong> '.$bar.'<br></p>';
            echo '<p><Strong>Spa:</Strong> '.$spa.'<br></p>';
            echo '<p><Strong>Gym:</Strong> '.$gym.'<br></p>';
            initialFacilities();
            mysqli_close($conn);
            ?>
            <a href="book.php"><button class="bookButton">Book Now</button></a>
        </div>

    </div>


</body>
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</footer>
</html>
