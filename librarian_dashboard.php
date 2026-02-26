<?php
session_start();

if(!isset($_SESSION['username']))
{
header("Location:login.html");
exit();
}

$username=$_SESSION['username'];
$role=$_SESSION['role'];
?>

<!DOCTYPE html>

<html>

<head>

<title>Librarian Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>

/* BODY */

body{

margin:0;

font-family:Poppins;

/* LIBRARY BACKGROUND */

background:

linear-gradient(

rgba(0,0,0,.70),

rgba(0,0,0,.70)

),

url("library1_bg.jpg");

background-size:cover;

background-position:center;

background-attachment:fixed;

}


/* SIDEBAR */

.sidebar{

position:fixed;

width:250px;

height:100%;

/* LUXURY GLASS SIDEBAR */

background:

linear-gradient(

180deg,

rgba(90,45,10,.95),

rgba(30,15,5,.95)

);

color:white;

padding-top:25px;

backdrop-filter:blur(12px);

box-shadow:

5px 0px 25px rgba(0,0,0,.7);

}


/* LOGO */

.logo{

text-align:center;

font-size:24px;

font-weight:600;

margin-bottom:30px;

font-family:'Playfair Display';

color:#ffd54f;

letter-spacing:1px;

}


/* MENU */

.menu{

padding:15px;

cursor:pointer;

margin:12px;

border-radius:10px;

transition:.3s;

background:

rgba(255,255,255,.05);

}

.menu:hover{

background:

linear-gradient(

135deg,

#ffb74d,

#ff9800

);

color:#3e2723;

transform:translateX(8px) scale(1.02);

}


/* CONTENT */

.content{

margin-left:270px;

padding:40px;

}


/* WELCOME CARD */

.welcome{

background:

rgba(255,255,255,.12);

backdrop-filter:blur(12px);

padding:35px;

border-radius:18px;

box-shadow:

0px 10px 35px rgba(0,0,0,.6);

font-size:23px;

color:#fff;

max-width:800px;

animation:fade .6s ease;

}


/* ROLE BADGE */

.role{

display:inline-block;

padding:7px 16px;

border-radius:12px;

color:white;

font-size:14px;

margin-top:12px;

font-weight:600;

}

/* ROLE COLORS */

.librarian{

background:#3b82f6;

}

.student{

background:#22c55e;

}

.management{

background:#ff9800;

}


/* POPUP BACKGROUND */

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

backdrop-filter:blur(8px);

z-index:9999;

}


/* POPUP BOX */

.popup-content{

background:white;

width:75%;

height:88%;

padding:20px;

border-radius:16px;

overflow:hidden;

box-shadow:

0px 20px 45px rgba(0,0,0,.6);

animation:zoom .3s ease;

}


/* CLOSE BUTTON */

.close{

float:right;

background:#ef4444;

color:white;

padding:9px 16px;

cursor:pointer;

border-radius:10px;

font-weight:600;

}

.close:hover{

background:#dc2626;

}


/* ANIMATIONS */

@keyframes zoom{

from{

transform:scale(.85);

opacity:0;

}

to{

transform:scale(1);

opacity:1;

}

}

@keyframes fade{

from{

opacity:0;

transform:translateY(30px);

}

to{

opacity:1;

transform:translateY(0);

}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">

📚 Smart Library

</div>

<div class="menu" onclick="openPopup('add_book.php')">

📚 Add Book

</div>

<div class="menu" onclick="openPopup('view_books.php')">

📖 View Books

</div>

<div class="menu" onclick="openPopup('issue_book.php')">

🔄 Issue Book

</div>

<div class="menu" onclick="openPopup('borrowed_books.php')">

⏰ Borrowed Books

</div>

<div class="menu" onclick="openPopup('statistics.php')">

📊 Statistics

</div>

<div class="menu" onclick="openPopup('notifications.php')">

🔔 Announcements

</div>

<div class="menu"

onclick="location.href='logout.php'">

🚪 Logout

</div>

</div>

<!-- CONTENT -->

<div class="content">

<div class="welcome">

Welcome <?php echo $username; ?> 👋

<br>

<span class="role <?php echo $role; ?>">

Role : <?php echo ucfirst($role); ?>

</span>

<br><br>

Manage books, borrowing and library activities easily using the sidebar options.

</div>

</div>

<!-- POPUP -->

<div id="popup" class="popup">

<div class="popup-content">

<span class="close"

onclick="closePopup()">

Close

</span>

<iframe id="frame"

width="100%"

height="95%"

style="border:none;border-radius:10px;">

</iframe>

</div>

</div>

<script>

/* OPEN POPUP */

function openPopup(page){

let popup=document.getElementById("popup");

let frame=document.getElementById("frame");

popup.style.display="flex";

document.body.style.overflow="hidden";

history.pushState({popup:true},"");

frame.src=page;

}


/* CLOSE POPUP */

function closePopup(){

let popup=document.getElementById("popup");

let frame=document.getElementById("frame");

popup.style.display="none";

document.body.style.overflow="auto";

frame.src="about:blank";

}


/* CLICK OUTSIDE CLOSE */

document.getElementById("popup").onclick=function(e){

if(e.target.id==="popup"){

closePopup();

}

};


/* BACK BUTTON FIX */

window.onpopstate=function(){

closePopup();

};

</script>

</body>

</html>
