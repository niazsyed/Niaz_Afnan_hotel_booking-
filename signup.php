<?php
session_start();
$login = 0;
if(isset($_SESSION['username'])){
        header("Location: dashboard.php");
    $login = 1;
    }
$title = "Sign up for a new Account!";
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
        echo '<div class="navbar-right">
        <a href="login.php" title="Login"><i class="dripicons-enter"></i></a>
    </div>';
    }
    ?>

</div>

    <div>
        <div class="roundbox1 dropshadow1"><h2>Add New User</h2></div>
        <div class="dropshadow1 roundbox1" style="margin: 50px;">

            <form  id="ajaxform" class="ajax-form" method="post">
                <label for="User Type">User Type: </label>
                <select name="usertype" id="usertype">
                   <option value="3" selected >Customer</option>
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
                <input type="submit" value="Signup" name="submit" id="submit" class="button1"><br>
            </form>
            <p><Strong>Already Have an account?</Strong></p>
            <a href="login.php"><button type="submit" class="regbutton">Login</button></a>
        </div>
        <div id="result"></div>
    </div>
</div>

</body>
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="ajax/registration.js"></script>
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