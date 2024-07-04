<?php
if (!isset($_SESSION["user_id"]))
    return header('location: login.php');
else {
    return header('location: dashboard.php');   
}