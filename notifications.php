<?php

session_start();

include "db.php";

/* SECURITY */

if(!isset($_SESSION['username'])){

header("Location: login.php");

exit();

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Library Announcements</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

/* BODY */

body{

margin:0;

font-family:Poppins;

background:url("notifications.jpg")

no-repeat center center fixed;

background-size:cover;

display:flex;

justify-content:center;

align-items:center;

min-height:100vh;

}

/* MAIN CARD */

.container{

width:520px;

max-width:90%;

background:white;

padding:25px;

border-radius:14px;

box-shadow:
0px 10px 28px rgba(0,0,0,0.25);

}

/* TITLE */

h2{

text-align:center;

color:#1f2937;

margin-bottom:22px;

}

/* ANNOUNCEMENT CARD */

.announce{

background:#eef2ff;

padding:14px;

border-radius:10px;

margin-bottom:12px;

border-left:6px solid #3b82f6;

}

/* DATE */

.date{

font-size:13px;

color:#64748b;

margin-bottom:6px;

}

/* MESSAGE */

.message{

font-size:15px;

color:#111827;

font-weight:600;

}

</style>

</head>

<body>

<div class="container">

<h2>

🔔 Library Announcements

</h2>

<?php

$result=$conn->query(

"SELECT * FROM announcements
ORDER BY id DESC"

);

if($result && $result->num_rows==0){

echo "<p>No announcements available.</p>";

}

while($row=$result->fetch_assoc()){

echo "

<div class='announce'>

<div class='date'>

📅 ".$row['date']."

</div>

<div class='message'>"

.htmlspecialchars($row['message'])."

</div>

</div>";

}

?>

</div>

</body>

</html>