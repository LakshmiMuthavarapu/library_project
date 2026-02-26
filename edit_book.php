<?php
session_start();
include "db.php";

/* GET BOOK ID */

$id = $_GET['id'];

$result = $conn->query(

"SELECT * FROM books WHERE id=$id"

);

$row = $result->fetch_assoc();

/* UPDATE BOOK */

if(isset($_POST['update']))
{

$title=$_POST['title'];

$author=$_POST['author'];

$conn->query(

"UPDATE books
SET title='$title',
author='$author'
WHERE id=$id"

);

echo "<p class='success'>✅ Book Updated Successfully</p>";

}
?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Book</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

/* BODY BACKGROUND IMAGE */

body{

margin:0;

font-family:Poppins;

/* IMAGE + DARK OVERLAY */

background:

linear-gradient(
rgba(0,0,0,.65),
rgba(0,0,0,.65)
),

url("editbook_bg.jpg");

background-size:cover;

background-position:center;

background-repeat:no-repeat;

/* IMPORTANT FOR POPUP */

padding:40px;

}


/* CARD */

.card{

background:rgba(255,255,255,.96);

width:460px;

margin:auto;

padding:30px;

border-radius:14px;

box-shadow:

0px 15px 35px rgba(0,0,0,.6);

animation:fade .4s ease;

}


/* ANIMATION */

@keyframes fade{

from{

opacity:0;

transform:translateY(20px);

}

to{

opacity:1;

transform:translateY(0);

}

}


/* TITLE */

h2{

text-align:center;

color:#1e293b;

margin-bottom:22px;

}


/* TABLE ALIGNMENT */

table{

width:100%;

border-spacing:15px;

}


/* LABEL */

td:first-child{

font-weight:600;

color:#111827;

}


/* INPUT */

input{

width:100%;

padding:11px;

border-radius:8px;

border:1px solid #ccc;

font-size:14px;

}


/* BUTTON */

button{

width:100%;

margin-top:15px;

background:

linear-gradient(
135deg,
#fb923c,
#f97316
);

color:white;

padding:13px;

border:none;

border-radius:9px;

font-weight:600;

cursor:pointer;

transition:.3s;

}


button:hover{

transform:scale(1.05);

background:

linear-gradient(
135deg,
#ea580c,
#c2410c
);

}


/* SUCCESS MESSAGE */

.success{

text-align:center;

color:#22c55e;

font-weight:600;

margin-bottom:15px;

}

</style>

</head>

<body>

<div class="card">

<h2>✏️ Edit Book</h2>

<form method="POST">

<table>

<tr>

<td>Title :</td>

<td>

<input

name="title"

value="<?php echo $row['title'];?>"

required>

</td>

</tr>

<tr>

<td>Author :</td>

<td>

<input

name="author"

value="<?php echo $row['author'];?>"

required>

</td>

</tr>

</table>

<button name="update">

Update Book

</button>

</form>

</div>

</body>

</html>