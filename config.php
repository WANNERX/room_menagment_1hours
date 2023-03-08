<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "62414402030_room_menagment";
$conn = new mysqli($servername,$username,$password,$database );

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}