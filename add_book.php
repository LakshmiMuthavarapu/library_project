<?php
session_start();
include "db.php";
?>

<!DOCTYPE html>

<html>

<head>

<title>Add Book</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

/* BODY BACKGROUND IMAGE */

body{

margin:0;

font-family:Poppins;

background:

linear-gradient(

rgba(0,0,0,.45),

rgba(0,0,0,.45)

),

url("addbook_bg.jpg");

background-size:cover;

background-position:center;

background-attachment:fixed;

display:flex;

justify-content:center;

align-items:center;

height:100vh;

}


/* CARD */

.card{

background:white;

width:460px;

padding:30px;

border-radius:15px;

box-shadow:

0px 8px 20px rgba(0,0,0,.15);

}


/* TITLE */

h2{

text-align:center;

color:#1e293b;

margin-bottom:20px;

}


/* INPUT */

input{

width:100%;

padding:10px;

margin-bottom:12px;

border-radius:8px;

border:1px solid #ce1c1c;

}


/* BUTTON */

button{

width:100%;

background:#fb923c;

color:white;

padding:12px;

border:none;

border-radius:8px;

font-weight:600;

cursor:pointer;

}

button:hover{

background:#ea580c;

}


/* SUCCESS MESSAGE */

.success{

text-align:center;

color:green;

font-weight:600;

margin-top:10px;

}

</style>

</head>

<body>

<div class="card">

<h2>📚 Add Book</h2>

<form method="POST">

<input name="title" placeholder="Title" required>

<input name="author" placeholder="Author" required>

<input name="year" placeholder="Year">

<input name="category" placeholder="Category">

<input name="isbn" placeholder="ISBN">

<input name="copies" placeholder="Copies">

<button name="add">

Add Book

</button>

</form>

<?php

if(isset($_POST['add']))
{

$title=$_POST['title'];

$author=$_POST['author'];

$year=$_POST['year'];

$category=$_POST['category'];

$isbn=$_POST['isbn'];

$copies=$_POST['copies'];

$sql="INSERT INTO books
(title,author,publication_year,category,isbn,copies,status)

VALUES
('$title','$author','$year','$category','$isbn','$copies','available')";

$conn->query($sql);

echo "<p class='success'>

✅ Book Added Successfully

</p>";

}

?>

</div>

</body>

</html>