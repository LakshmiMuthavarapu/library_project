<?php

include "db.php";

$username=$_POST['username'];
$password=$_POST['password'];
$role=$_POST['role'];

$sql="INSERT INTO users
(username,password,role)
VALUES
('$username','$password','$role')";

if($conn->query($sql))
{
?>

<!DOCTYPE html>

<html>

<head>

<title>Registration Successful</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>

/* BODY */

body{

margin:0;

height:100vh;

display:flex;

justify-content:center;

align-items:center;

font-family:Poppins;

/* LIBRARY BACKGROUND */

background:

linear-gradient(

rgba(0,0,0,.55),

rgba(0,0,0,.55)

),

url("library_bg.jpg");

background-size:cover;

background-position:center;

}

/* SUCCESS CARD */

.box{

width:430px;

padding:50px;

border-radius:18px;

text-align:center;

/* GLASS EFFECT */

background:

rgba(255,255,255,.15);

backdrop-filter:blur(14px);

border:

1px solid rgba(255,255,255,.3);

box-shadow:

0px 15px 45px rgba(0,0,0,.7);

animation:fade .6s ease;

}

/* FADE ANIMATION */

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

/* SUCCESS ICON */

.tick{

font-size:55px;

margin-bottom:10px;

animation:pop .5s ease;

}

@keyframes pop{

from{

transform:scale(.3);

opacity:0;

}

to{

transform:scale(1);

opacity:1;

}

}

/* TITLE */

h2{

font-family:'Playfair Display';

font-size:34px;

color:#ffd27f;

margin-bottom:12px;

}

/* MESSAGE */

p{

color:white;

font-size:17px;

margin-bottom:25px;

}

/* BUTTON */

a{

display:inline-block;

background:

linear-gradient(

135deg,

#ffd54f,

#ffb300

);

color:#3e2723;

padding:14px 32px;

border-radius:10px;

text-decoration:none;

font-weight:600;

transition:.3s;

}

a:hover{

transform:scale(1.07);

}

</style>

</head>

<body>

<div class="box">

<div class="tick">

✅

</div>

<h2>

Registration Successful

</h2>

<p>

Your account has been created successfully.

</p>

<a href="login.html">

Go To Login

</a>

</div>

</body>

</html>

<?php

}

else{

echo "Error";

}

?>
