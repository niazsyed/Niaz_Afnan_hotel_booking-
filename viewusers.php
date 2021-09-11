<?php
date_default_timezone_set('UTC');
session_start();
if(isset($_SESSION['username'])){
    require_once './admin/dbconfig.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $username = $_SESSION['username'];
    date_default_timezone_set("UTC");
    $query="Select users.username, users.typecode, user_type.type_code, user_type.type_name from users join user_type on users.typecode=user_type.type_code where md5(users.username) = '$username'";
    $result = mysqli_query($conn,("Select users.*, user_type.* from users join user_type on users.typecode=user_type.type_code where md5(username) = '$username'")) or die("Failed to Retrive Database");
    $row = mysqli_fetch_assoc($result);
    $user_type=$row['type_name'];
    if($user_type=="admin"||$user_type=="staff"){
        $permission=1;
    }
    else{
        header("Location: dashboard.php");
    }
    $current_date = date('Y-m-d h:i:s', time());
    $result2 = mysqli_query($conn,("Select * from users_info")) or die("Failed to Retrive Database");

}
else{
    header("Location: login.php");
}
$title = "Book Hotel Room";
include 'header.php';
include 'navbar.php';
?>
<div id="main">



        <div class="dropshadow1 roundbox1" style="margin: 50px;">
            <h3>All Bookings Including Past and Future!</h3>
            <table id="example" class="table1 display" style="width:100%">
                <thead>
                <tr>
                    <th style="width: 6%">Sl</th>
                    <th style="width: 12%">Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <?php if($user_type=="admin"){
                        echo '<th style="width: 8%">Action</th>';
                    } ?>

                </tr>
                </thead>


                <tbody>
                <?php

                $serial = 1;
                if (mysqli_num_rows($result2) > 0){
                    while($row2=mysqli_fetch_assoc($result2)) {

                        $username = $row2['username'];
                        $firstname = $row2['firstname'];
                        $lastname= strtoupper($row2['lastname']);
                        $phone = strtoupper($row2['phone']);
                        $address=$row2['address'];

                        $delete='<form  id="ajaxform" class="ajax-form" method="post">
                <input type="hidden" name="deluser" id="deluser" value="'.$username.'" required>
                <input type="submit" value="Delete" name="submit" id="submit" class="deletebutton"><br>
            </form>';
                        $fullname=$firstname." ".$lastname;
                        $email=$row2['email'];

                        if($user_type=="admin"){
                            echo "<tr><td>".$serial."</td><td>".$username."</td><td>".$fullname."</td><td>".$email."</td><td>".$phone."</td><td>".$address."</td><td>".$delete."</td></tr>";
                        }
                        else{
                            echo "<tr><td>".$serial."</td><td>".$username."</td><td>".$fullname."</td><td>".$email."</td><td>".$phone."</td><td>".$address."</td></tr>";
                        }


                        $serial++;
                    }
                }

                mysqli_close($conn);
                ?>


                </tbody>
            </table>


        </div>
    <div id="result"></div>
    </div>
</div>

</body>
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="ajax/deleteuser.js"></script>
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>$(document).ready(function() {
            $('#example').DataTable();
        } );</script>
    <script>
        function delay() {
            setTimeout(function(){ location.reload(); }, 1500);
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
