<?php
session_start();
$name = "N/A";
if(isset($_SESSION['username'])){
    require_once './admin/dbconfig.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $username = $_SESSION['username'];
    date_default_timezone_set("UTC");
    $query="Select users.username, users.typecode, user_type.type_code, user_type.type_name from users join user_type on users.typecode=user_type.type_code where md5(users.username) = '$username'";
    $result = mysqli_query($conn,("Select users.*, user_type.* from users join user_type on users.typecode=user_type.type_code where md5(username) = '$username'")) or die("Failed to Retrive Database");
    $row = mysqli_fetch_assoc($result);
    $result2 = mysqli_query($conn,("Select * from room_type")) or die("Failed to Retrive Database");
    $result3 = mysqli_query($conn,("Select * from beds")) or die("Failed to Retrive Database");

    $user_type=$row['type_name'];
    if($user_type!="admin"){
        header("Location: dashboard.php");
    }
}
else{
    header("Location: login.php");
}
$title = "Add Room Descriptions";
include 'header.php';
include 'navbar.php';
?>
<div id="main">

    <div>
        <div class="roundbox1 dropshadow1" style="margin: 20px;"><h2><?php echo $title; ?></h2></div>
        <div class="dropshadow1 roundbox1" style="margin: 50px;">

            <form  id="ajaxform" class="ajax-form" method="post">
                <label for="Room Type">Select Room Type/Name: </label><br>
                <select name="roomcode" id="roomcode">
                <?php
                if (mysqli_num_rows($result2) >= 0){
                    while($row2=mysqli_fetch_assoc($result2)) {
                        $sl = 0;
                        $name = strtoupper($row2['room_name']);
                        $type = $row2['room_code'];
                        if($sl==0){
                            echo '<option value="'.$type.'" selected>'.$name.'</option>';
                        }
                        else{
                            echo '<option value="'.$type.'">'.$name.'</option>';
                        }
                        $sl++;

                    }
                }
                ?>
                </select><br><br>
                <label for="Bed Type">Bed Type: </label>
                <select name="bedtype" id="bedtype">
                    <?php
                    if (mysqli_num_rows($result3) >= 0){
                        while($row3=mysqli_fetch_assoc($result3)) {
                            $sl = 0;
                            $bed_name = strtoupper($row3['bed_name']);
                            $bed_code = $row3['bed_code'];
                            if($sl==0){
                                echo '<option value="'.$bed_code.'" selected>'.$bed_name.'</option>';
                            }
                            else{
                                echo '<option value="'.$bed_code.'">'.$bed_name.'</option>';
                            }
                            $sl++;

                        }
                    }

                    mysqli_close($conn);
                    ?>
                </select><br><br>

                <label for="Number of Beds">Bed Number(s): </label>
                <input type="number" name="bedcount" id="bedcount" required><br>
                <label for="WiFi">Free WiFi: </label>
                <select name="wifi" id="wifi">
                    <option value="y" selected>YES</option>
                    <option value="n">NO</option>
                </select><br><br>
                <label for="Pool">Swimming Pool: </label>
                <select name="pool" id="pool">
                    <option value="y" selected>YES</option>
                    <option value="n">NO</option>
                </select><br><br>
                <label for="parking">Parking: </label>
                <select name="parking" id="parking">
                    <option value="y" selected>YES</option>
                    <option value="n">NO</option>
                </select><br><br>
                <label for="bar">Bar: </label>
                <select name="bar" id="bar">
                    <option value="y" selected>YES</option>
                    <option value="n">NO</option>
                </select><br><br>
                <label for="Spa">Spa: </label>
                <select name="spa" id="spa">
                    <option value="y" selected>YES</option>
                    <option value="n">NO</option>
                </select><br><br>
                <label for="Gym">GYM: </label>
                <select name="gym" id="gym">
                    <option value="y" selected>YES</option>
                    <option value="n">NO</option>
                </select><br><br>

                <br><br>
                <input type="submit" value="Create" name="submit" id="submit" class="button1"><br>
            </form>

        </div>
        <div id="result"></div>
    </div>
</div>

</body>
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="ajax/addroomdesc.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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