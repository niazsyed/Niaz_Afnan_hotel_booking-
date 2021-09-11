<?php
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
    $user=$row['username'];
}
else{
    header("Location: login.php");
}
$title = "Update Password";
include 'header.php';
include 'navbar.php';
?>
<div id="main">

    <div>
        <div class="roundbox1 dropshadow1" style="margin: 20px;"><h2><?php echo $title ?></h2></div>
        <div class="dropshadow1 roundbox1" style="margin: 50px;">

            <form  id="ajaxform" class="ajax-form" method="post">

                <label for="Current Password">Current Password: </label>
                <input type="password" name="currentpass" id="currentpw" required><br>
                <label for="New Password">New Password: </label>
                <input type="password" name="newpass" id="newpass" required><br>
                <label for="Confirm Password">Retype New Password: </label>
                <input type="password" name="confirmpass" id="confirmpass" required><br>
                <?php
                echo '<input type="hidden" name="username" id="username" value="'.$user.'" required><br>';
                ?>


                <br><br>
                <input type="submit" value="Change" name="submit" id="submit" class="button1"><br>
            </form>

        </div>
        <div id="result"></div>
    </div>
</div>

</body>
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="ajax/updatepass.js"></script>
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