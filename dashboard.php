<?php
date_default_timezone_set('UTC');
session_start();
$next_booking = "N/A";
$room_no = "N/A";
$room_type ="N/A";
if(isset($_SESSION['username'])){
    require_once './admin/dbconfig.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $username = $_SESSION['username'];
    date_default_timezone_set("UTC");
    $query="Select users.username, users.typecode, user_type.type_code, user_type.type_name from users join user_type on users.typecode=user_type.type_code where md5(users.username) = '$username'";
    $result = mysqli_query($conn,("Select users.*, user_type.* from users join user_type on users.typecode=user_type.type_code where md5(username) = '$username'")) or die("Failed to Retrive Database");
    $row = mysqli_fetch_assoc($result);
    $user_type=$row['type_name'];
    $current_date = date('Y-m-d h:i:s', time());
    $result2 = mysqli_query($conn,("Select book.*, hotel_rooms.*, room_type.* from book right outer join hotel_rooms on book.room_id=hotel_rooms.room_no right join room_type on hotel_rooms.room_code=room_type.room_code where md5(username)='$username' and book.from_date > '$current_date'")) or die("Failed to Retrive Database");

    if($user_type=="admin" or $user_type=="staff"){
        $result3 = mysqli_query($conn,("Select book.*, hotel_rooms.*, room_type.* from book right outer join hotel_rooms on book.room_id=hotel_rooms.room_no right join room_type on hotel_rooms.room_code=room_type.room_code where room_no<>'null'")) or die("Failed to Retrive Database");
        $result4 = mysqli_query($conn,("Select count(*) as total from book")) or die("Failed to Retrive Database");
    }
    else{
        $result3 = mysqli_query($conn,("Select book.*, hotel_rooms.*, room_type.* from book right outer join hotel_rooms on book.room_id=hotel_rooms.room_no right join room_type on hotel_rooms.room_code=room_type.room_code where md5(username)='$username'")) or die("Failed to Retrive Database");
        $result4 = mysqli_query($conn,("Select count(*) as total from book where md5(username)= '$username'")) or die("Failed to Retrive Database");
    }
    $row4=mysqli_fetch_assoc($result4);
}
else{
    header("Location: login.php");
}
$title = "Book Hotel Room";
include 'header.php';
include 'navbar.php';
?>
<div id="main">

    <div>
        <div class="roundbox1 dropshadow1" style="margin: 20px;"><h2>Dashboard</h2></div>
        <div class="dropshadow1 roundbox1" style="margin: 50px;">


            <?php
            $total = $row4['total'];
            if($user_type=="customer") {

                if ($row2 = mysqli_fetch_assoc($result2)) {

                    //$row2 = mysqli_fetch_assoc($result2);
                        $next_booking = date("m-d-Y H:i:s", strtotime($row2['from_date']));
                        $room_no = strtoupper($row2['room_id']);
                        $room_type = strtoupper($row2['room_name']);

                    echo '<h4>Next Booking: ' . $next_booking . '</h4>
                        <h4>Room No: ' . $room_no . '</h4>
                        <h4>Room Type: ' . $room_type . '</h4>';
                } else {
                    echo '<h4>No Upcoming Booking!</h4>';
                }
            }
echo '<h4>All Time Bookings: '.$total.'</h4>';
            ?>

        </div>

        <div class="dropshadow1 roundbox1" style="margin: 50px;">
<h3>All Bookings Including Past and Future!</h3>
            <table id="example" class="table1 display" style="width:100%">
                <thead>
                <tr>
                    <th style="width: 6%">Sl</th>
                    <?php
                    if($user_type!="customer"){
                    echo '<th style="width: 12%">Username</th>';} ?>
                    <th style="width: 12%">Room No</th>
                    <th>Room Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th style="width: 8%">Booked By</th>
                </tr>
                </thead>


                <tbody>
                <?php

                $serial = 1;
                if ($row3=mysqli_num_rows($result3)){
                    while($row3=mysqli_fetch_assoc($result3)) {

                        $from = $row3['from_date'];
                        $to = $row3['to_date'];
                        $room_name= strtoupper($row3['room_name']);
                        $room_number = strtoupper($row3['room_id']);
                        $booked_by=$row3['bookedby'];
                        $user=$row3['username'];
                        if($room_number!=null) {
                            if ($user_type != "customer") {
                                echo "<tr><td>" . $serial . "</td><td>" . $user . "</td><td>" . $room_number . "</td><td>" . $room_name . "</td><td>" . $from . "</td><td>" . $to . "</td><td>" . $booked_by . "</td></tr>";
                            } else {
                                echo "<tr><td>" . $serial . "</td><td>" . $room_number . "</td><td>" . $room_name . "</td><td>" . $from . "</td><td>" . $to . "</td><td>" . $booked_by . "</td></tr>";
                            }
                            $serial++;
                        }
                    }
                }

                mysqli_close($conn);
                ?>


                </tbody>
            </table>


        </div>

    </div>
</div>

</body>
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>$(document).ready(function() {
            $('#example').DataTable();
        } );</script>
    <script>
        var openSidebar=0;
        var windowSize = window.matchMedia("(max-width: 700px)")

        function sidebarOpener(){
            if(windowSize.matches){
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                openSidebar=0;
            }
            else{
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                openSidebar=1;
            }
        }
        var openSidebar=0;
        var windowSize = window.matchMedia("(max-width: 700px)")

        function sidebarOpener(){
            if(windowSize.matches){
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                openSidebar=0;
            }
            else{
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                openSidebar=1;
            }
        }

        function openNav() {

            if(openSidebar==0){
                openSidebar=1;
                document.getElementById("mySidebar").style.width = "250px";
                if(windowSize.matches){
                    document.getElementById("main").style.marginLeft= "0";
                }
                else{
                    document.getElementById("main").style.marginLeft = "250px";
                }
            }
            else{
                openSidebar=0;
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";

            }

        }
    </script>
</footer>
</html>