<?php

$conn = new mysqli("localhost","root","","library_db");

if($conn->connect_error)
{
die("Connection Failed");
}

?>