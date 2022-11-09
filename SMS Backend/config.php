<?php
session_start();
session_unset();

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$database = "school_management_system";

$conn = mysqli_connect($localhost, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    session_destroy();
    exit();
}

?>