<?php
session_start();
if(isset($_SESSION['username'])){

    header("Location: dashboard.php");

}
$site_address = $_SERVER['SERVER_NAME'];
$filename = './admin/dbconfig.php';
if (file_exists($filename)){
    header("Location: admin/create_central_admin.php");
}
$title="HotelBooking Installer";

include 'header.php';
?>


<div class="roundbox1 dropshadow1" style="margin: 20px;"><h2>Login Form</h2></div>

<div class="dropshadow1 roundbox1" style="margin: 50px">
    <form action="admin/installer.php" method="post">

        <input type="text" required placeholder="Database Host" name="dbhost" value="localhost">

        <input type="text" required placeholder="Database Name" name="dbname">

        <input type="text" required placeholder="Database User" name="dbuser">

        <input type="password" placeholder="Database Password" name="dbpass"><br>


        <button type="submit" class="button1">Install</button>



    </form>
</div>

</body>
<?php include 'footer.php'?>
