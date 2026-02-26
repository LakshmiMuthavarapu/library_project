<?php

session_start();

include "db.php";

/* ONLY RUN LOGIN WHEN FORM SUBMITTED */

if($_SERVER["REQUEST_METHOD"]=="POST"){

$username = $_POST['username'] ?? '';

$password = $_POST['password'] ?? '';

$sql="SELECT * FROM users
WHERE username='$username'
AND password='$password'";

$result=$conn->query($sql);

if($result->num_rows>0){

$user=$result->fetch_assoc();

$_SESSION['username']=$user['username'];

$_SESSION['role']=$user['role'];


/* ROLE REDIRECT */

if($user['role']=="librarian"){

header("Location:librarian_dashboard.php");
exit();

}

elseif($user['role']=="management"){

header("Location:management_dashboard.php");
exit();

}

else{

header("Location:student_dashboard.php");
exit();

}

}

else{

$error="Invalid Username or Password";

}

}

?>
<!DOCTYPE html>

<html>

<head>

<title>Library Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>

body{

margin:0;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
font-family:Poppins;

background:
linear-gradient(rgba(0,0,0,.55),
rgba(0,0,0,.55)),
url("library_bg.jpg");

background-size:cover;
background-position:center;

}

.login-box{

width:420px;
padding:50px;
border-radius:18px;
text-align:center;

background:
linear-gradient(
135deg,
rgba(255,180,90,.85),
rgba(140,70,20,.85)
);

box-shadow:0px 15px 45px rgba(0,0,0,.7);

}

h2{

font-family:'Playfair Display';

color:#fff3cd;

}

input{

width:95%;

padding:13px;

margin:12px 0;

border-radius:10px;

border:none;

background:rgba(255,255,255,.25);

color:white;

}

button{

width:100%;

padding:14px;

border:none;

border-radius:10px;

font-weight:600;

cursor:pointer;

background:
linear-gradient(
135deg,
#ffd54f,
#ffb300
);

color:#3e2723;

}

/* ERROR MESSAGE */

.error{

background:#fee2e2;

color:#7f1d1d;

padding:10px;

border-radius:8px;

margin-bottom:10px;

}

.forgot{

display:block;

margin-top:10px;

background:#2563eb;

color:white;

padding:10px;

border-radius:10px;

text-decoration:none;

}

</style>

</head>

<body>

<div class="login-box">

<h2>Library Login</h2>

<?php
if(!empty($error)){
echo "<div class='error'>$error</div>";
}
?>

<form method="POST">

<input type="text"
name="username"
placeholder="Enter Username"
required>

<input type="password"
name="password"
placeholder="Enter Password"
required>

<button type="submit">

Login

</button>

</form>

<a class="forgot"

href="forgot_password.php">

Forgot Password

</a>

</div>

</body>

</html>