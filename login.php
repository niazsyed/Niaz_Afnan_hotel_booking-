<?php
session_start();
$login=0;
if(isset($_SESSION['username'])){

    header("Location: dashboard.php");
    $login=1;
}
$title="HotelBooking Login";

include 'header.php';
?>
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

<div class="roundbox1 dropshadow1" style="margin: 20px;"><h2>Login Form</h2></div>

<div class="dropshadow1 roundbox1" style="margin: 50px">
    <form action="./admin/loginhandle.php" method="post">


        <input type="text" required placeholder="Username" name="user">


        <input type="password" required placeholder="Password" name="pass"><br>


        <button type="submit" class="button1">Log In</button>



    </form>
    <p><Strong>Don't have an account?</Strong></p>
    <a href="signup.php"><button type="submit" class="regbutton">Signup Here</button></a>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    var current_url = window.location.href;


    if(current_url.includes('wrong_credentials')){

        swal("Wrong Credentials!", "Either Username or Password is incorrect!", "error");
    }
    else if(current_url.includes('loggedout')){
        swal("You have been logged out!", "You have successfully logged out from Hotel Booking System!", "info");
    }
</script>


</body>
<?php include 'footer.php'?>
