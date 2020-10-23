<?php
session_start();
unset($_SESSION["user"]);
session_destroy();
header("location:login_parkinglot.html");
?>