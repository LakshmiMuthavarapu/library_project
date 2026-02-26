<?php

session_start();

include "db.php";

?>

<!DOCTYPE html>

<html>

<head>

<title>Available Books</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

/* BODY */

body{

margin:0;

font-family:Poppins;

background:#f4f7fc;

display:flex;

justify-content:center;

padding-top:25px;

}

/* MAIN CONTAINER */

.container{

width:90%;

background:white;

padding:25px;

border-radius:14px;

box-shadow:0px 6px 18px rgba(0,0,0,0.15);

}

/* TITLE */

h2{

text-align:center;

color:#1f2937;

}

/* SEARCH */

form{

text-align:center;

margin:15px;

}

input{

padding:8px 12px;

border-radius:6px;

border:1px solid #ccc;

margin-right:8px;

}

button{

background:#3b82f6;

color:white;

border:none;

padding:8px 14px;

border-radius:6px;

cursor:pointer;

font-weight:600;

}

button:hover{

background:#2563eb;

}

/* TABLE */

table{

width:100%;

border-collapse:collapse;

margin-top:20px;

}

/* HEADER */

th{

background:#3b82f6;

color:white;

padding:12px;

}

/* ROW */

td{

padding:12px;

text-align:center;

border-bottom:1px solid #ddd;

}

/* HOVER */

tr:hover{

background:#eef2ff;

}

/* STATUS BADGE */

.available{

background:#22c55e;

color:white;

padding:4px 10px;

border-radius:6px;

font-size:14px;

}

.back{

display:inline-block;

margin-top:18px;

color:#3b82f6;

font-weight:600;

text-decoration:none;

}

.back:hover{

text-decoration:underline;

}

</style>

</head>

<body>

<div class="container">

<h2>

📚 Available Books

</h2>

<form method="GET">

Search :

<input name="search"

placeholder="Search by title or category">

<button>

Search

</button>

</form>

<table>

<tr>

<th>Title</th>

<th>Author</th>

<th>Status</th>

</tr>

<?php

if(isset($_GET['search']))
{

$search=$_GET['search'];

$sql="SELECT * FROM books
WHERE status='available'
AND (title LIKE '%$search%'
OR category LIKE '%$search%')";

}

else{

$sql="SELECT * FROM books
WHERE status='available'";

}

$result=$conn->query($sql);

while($row=$result->fetch_assoc())
{

echo "<tr>";

echo "<td>".$row['title']."</td>";

echo "<td>".$row['author']."</td>";

echo "<td><span class='available'>".$row['status']."</span></td>";

echo "</tr>";

}

?>

</table>

<a class="back"

href="student_dashboard.php">

← Back

</a>

</div>

</body>

</html>
