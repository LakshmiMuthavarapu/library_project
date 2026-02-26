<?php
session_start();

if(!isset($_SESSION['username']))
{
header("Location:login.html");
exit();
}

$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html>

<head>

<title>Management Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>

/* BODY */

body{

margin:0;

font-family:Poppins;

background:

linear-gradient(

135deg,

#fff7e6,

#fdebd0,

#fff3cd

);

}

/* SIDEBAR */

.sidebar{

position:fixed;

width:240px;

height:100%;

background:

linear-gradient(

180deg,

#3e2723,

#5d4037

);

color:white;

padding-top:30px;

box-shadow:5px 0px 20px rgba(0,0,0,.25);

}

/* LOGO */

.logo{

text-align:center;

font-size:23px;

font-weight:600;

margin-bottom:35px;

font-family:'Playfair Display';

color:#ffd27f;

}

/* MENU */

.menu{

padding:16px;

margin:12px;

cursor:pointer;

border-radius:10px;

transition:.3s;

}

.menu:hover{

background:#ffd27f;

color:#3e2723;

transform:translateX(6px);

}

/* CONTENT */

.content{

margin-left:260px;

padding:45px;

}

/* WELCOME CARD */

.welcome{

background:

linear-gradient(

135deg,

#ffecb3,

#ffe082

);

padding:35px;

border-radius:18px;

box-shadow:

0px 10px 25px rgba(0,0,0,.2);

font-size:22px;

color:#4e342e;

font-weight:600;

}

/* POPUP */

.popup{

display:none;

justify-content:center;

align-items:center;

position:fixed;

top:0;

left:0;

width:100%;

height:100%;

background:rgba(0,0,0,.55);

backdrop-filter:blur(6px);

z-index:9999;

}

/* POPUP BOX */

.popup-content{

background:

linear-gradient(

135deg,

#fff8e1,

#ffecb3

);

width:70%;

height:85%;

padding:20px;

border-radius:16px;

box-shadow:0px 15px 35px rgba(0,0,0,.4);

}

.close{

float:right;

background:#e53935;

color:white;

padding:8px 15px;

border-radius:8px;

cursor:pointer;

}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">

🏢 Management Panel

</div>

<div class="menu"

onclick="openPopup('announcements.php')">

📢 Send Announcement

</div>

<div class="menu"

onclick="openPopup('view_books.php')">

📚 View Books

</div>

<div class="menu"

onclick="location.href='logout.php'">

🚪 Logout

</div>

</div>


<div class="content">

<div class="welcome">

Welcome <?php echo $username;?> 👋

<br><br>

Manage announcements and monitor library books efficiently.

</div>

</div>


<div id="popup" class="popup">

<div class="popup-content">

<span class="close"

onclick="closePopup()">

Close

</span>

<iframe id="frame"

width="100%"

height="95%"

style="border:none;border-radius:12px;">

</iframe>

</div>

</div>

<script>

function openPopup(page){

document.getElementById("popup").style.display="flex";

document.body.style.overflow="hidden";

document.getElementById("frame").src=page;

}

function closePopup(){

document.getElementById("popup").style.display="none";

document.body.style.overflow="auto";

document.getElementById("frame").src="about:blank";

}

</script>

</body>

</html>