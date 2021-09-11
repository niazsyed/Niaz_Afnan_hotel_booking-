<?php
session_start();
if(isset($_SESSION['username'])){
    session_destroy();
    header("Location: login.php?loggedout");
}
else{
    header("Location: login.php");
}
?>