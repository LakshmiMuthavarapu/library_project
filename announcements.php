<?php

session_start();

include "db.php";

/* SECURITY */

if(!isset($_SESSION['username'])){

header("Location: login.php");

exit();

}

/* ROLE */

$role=$_SESSION['role'] ?? "";

/* MESSAGE */

$msgbox="";


/* SEND ANNOUNCEMENT */

if($_SERVER["REQUEST_METHOD"]=="POST"
&& isset($_POST['send'])
&& $role=="management"){

$message=$conn->real_escape_string($_POST['message']);

$date=date("Y-m-d");

$conn->query(

"INSERT INTO announcements(message,date)

VALUES('$message','$date')"

);

$msgbox="✅ Announcement Sent Successfully";

}


/* DELETE ANNOUNCEMENT */

if(isset($_GET['delete'])
&& $role=="management"){

$id=intval($_GET['delete']);

$conn->query(

"DELETE FROM announcements WHERE id=$id"

);

$msgbox="🗑️ Announcement Deleted Successfully";

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

background:url("announcements.jpg")
no-repeat center center fixed;

background-size:cover;

padding:25px;

}

/* CARD */

.container{

width:70%;

margin:auto;

background:white;

padding:28px;

border-radius:14px;

box-shadow:
0px 10px 25px rgba(0,0,0,.2);

}

/* TITLE */

h2{

text-align:center;

color:#1f2937;

margin-bottom:20px;

}

/* MESSAGE BOX */

.msg{

background:#dcfce7;

color:#166534;

padding:10px;

border-radius:8px;

margin-bottom:20px;

text-align:center;

font-weight:600;

}

/* FORM */

textarea{

width:100%;

padding:12px;

border-radius:8px;

border:1px solid #ccc;

resize:none;

font-family:Poppins;

}

button{

background:#fb923c;

color:white;

border:none;

padding:10px 16px;

border-radius:8px;

cursor:pointer;

margin-top:10px;

font-weight:600;

}

button:hover{

background:#ea580c;

}

/* ANNOUNCEMENT CARD */

.announce{

background:#eef2ff;

padding:16px;

border-radius:10px;

margin-bottom:15px;

border-left:6px solid #3b82f6;

position:relative;

}

/* DATE */

.date{

font-size:13px;

color:#64748b;

margin-bottom:6px;

}

/* MESSAGE */

.message{

font-size:16px;

color:#111827;

font-weight:600;

}

/* DELETE */

.delete{

position:absolute;

right:10px;

top:10px;

background:#ef4444;

color:white;

padding:5px 10px;

border-radius:6px;

text-decoration:none;

font-size:13px;

}

.delete:hover{

background:#dc2626;

}

</style>

</head>

<body>

<div class="container">

<h2>🔔 Library Announcements</h2>

<?php

if($msgbox!=""){

echo "<div class='msg'>$msgbox</div>";

}

?>

<!-- MANAGEMENT SEND -->

<?php if($role=="management"){ ?>

<form method="POST">

<textarea
name="message"
rows="4"
placeholder="Write announcement..."
required>

</textarea>

<button type="submit"

name="send">

Send Announcement

</button>

</form>

<?php } ?>


<?php

$result=$conn->query(

"SELECT * FROM announcements
ORDER BY id DESC"

);

if($result->num_rows==0){

echo "<p>No announcements available.</p>";

}

while($row=$result->fetch_assoc()){

echo "

<div class='announce'>

<div class='date'>

📅 ".$row['date']."

</div>";

if($role=="management"){

echo "

<a class='delete'

href='announcements.php?delete=".$row['id']."'

onclick=\"return confirm('Delete this announcement?')\">

Delete

</a>";

}

echo "

<div class='message'>"

.htmlspecialchars($row['message'])."

</div>

</div>";

}

?>

</div>

</body>

</html>