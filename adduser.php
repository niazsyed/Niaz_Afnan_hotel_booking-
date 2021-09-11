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
    if($user_type=="admin"||$user_type=="staff"){
$permission=1;
    }
    else{
        header("Location: dashboard.php");
    }
}
else{
    header("Location: login.php");
}
$title = "Add New User";
include 'header.php';
include 'navbar.php';
?>
<div id="main">

    <div>
        <div class="roundbox1 dropshadow1" style="margin: 20px;"><h2>Add New User</h2></div>
        <div class="dropshadow1 roundbox1" style="margin: 50px;">

            <form  id="ajaxform" class="ajax-form" method="post">
                <label for="Link Type">User Type: </label><br>
                <select name="user_type" id="user_type">
                    <?php if($user_type=="staff"){
                        echo '<option value="3" selected>Customer</option>';
                    }
                    else if($user_type=="admin"){
                        echo '<option value="3" selected>Customer</option>
                    <option value="2">Staff</option>';
                    }
                    ?>

                </select><br><br>
                <label for="First Name">First Name: </label>
                <input type="text" name="firstname" id="firstname" required><br>
                <label for="Last Name">Last Name: </label>
                <input type="text" name="lastname" id="lastname" required><br>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email"><br>
                <label for="Phone">Phone: </label>
                <input type="tel" name="phone" id="phone" required><br>
                <label for="address">Address: </label>
                <input type="text" name="address" id="address" required><br>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" required><br>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" required><br><br>

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
    <script src="ajax/adduser.js"></script>
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