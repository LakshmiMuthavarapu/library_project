<?php

include "db.php";

$msg="";

if(isset($_POST['reset']))
{

$username=$_POST['username'];

$newpass=$_POST['newpass'];

/* CHECK USER EXISTS */

$check=$conn->query(

"SELECT * FROM users
WHERE username='$username'"

);

if($check->num_rows>0)
{

$conn->query(

"UPDATE users
SET password='$newpass'
WHERE username='$username'"

);

$msg="✅ Password Reset Successful";

}

else{

$msg="⚠ Username Not Found";

}

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Forgot Password</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

body{

margin:0;

font-family:Poppins;

background:
linear-gradient(135deg,#fff7ed,#e0f2fe);

display:flex;

justify-content:center;

align-items:center;

height:100vh;

}


/* CARD */

.card{

background:white;

padding:30px;

width:420px;

border-radius:16px;

box-shadow:
0px 10px 25px rgba(0,0,0,.2);

text-align:center;

}


/* TITLE */

h2{

margin-bottom:20px;

color:#1f2937;

}


/* INPUT */

input{

width:100%;

padding:10px;

margin-bottom:15px;

border-radius:8px;

border:1px solid #ccc;

font-family:Poppins;

}


/* BUTTON */

button{

width:100%;

background:#fb923c;

color:white;

padding:12px;

border:none;

border-radius:10px;

font-weight:600;

cursor:pointer;

}

button:hover{

background:#ea580c;

}


/* MESSAGE */

.msg{

margin-bottom:15px;

padding:10px;

border-radius:8px;

font-weight:600;

background:#fff7ed;

color:#9a3412;

}


/* BACK */

.back{

display:block;

margin-top:12px;

background:#2563eb;

color:white;

padding:10px;

border-radius:10px;

text-decoration:none;

font-weight:600;

}

.back:hover{

background:#1d4ed8;

}

</style>

</head>

<body>

<div class="card">

<h2>🔑 Forgot Password</h2>

<?php

if($msg!="")
{

echo "<div class='msg'>$msg</div>";

}

?>

<form method="POST">

<input name="username"

placeholder="Enter Username"

required>

<input type="password"

name="newpass"

placeholder="New Password"

required>

<button name="reset">

Reset Password

</button>

</form>

<a class="back"

href="login.php">

⬅ Back To Login

</a>

</div>

</body>

</html>