<?php

session_start();

include "db.php";

/* SECURITY CHECK */

if(!isset($_SESSION['username'])){

header("Location: login.php");

exit();

}

?>

<!DOCTYPE html>

<html>

<head>

<title>All Books</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

/* BODY BACKGROUND */

body{

margin:0;

font-family:Poppins;

background:
linear-gradient(
rgba(0,0,0,.45),
rgba(0,0,0,.45)
),
url("viewbook_bg.jpg");

background-size:cover;

background-position:center;

background-attachment:fixed;

text-align:center;

padding:25px;

}

/* TITLE */

h2{

color:white;

margin-bottom:15px;

}

/* SEARCH */

form{

margin-bottom:20px;

color:white;

}

input{

padding:9px;

border-radius:8px;

border:1px solid #ccc;

}

/* BUTTON */

button{

background:#fb923c;

color:white;

border:none;

padding:9px 15px;

border-radius:8px;

cursor:pointer;

font-weight:600;

}

button:hover{

background:#ea580c;

}

/* TABLE */

table{

margin:auto;

border-collapse:collapse;

width:85%;

background:rgba(255,255,255,.95);

border-radius:12px;

overflow:hidden;

box-shadow:
0px 8px 20px rgba(0,0,0,.35);

}

/* HEADER */

th{

background:
linear-gradient(
135deg,
#fb923c,
#f97316
);

color:white;

padding:14px;

}

/* DATA */

td{

padding:12px;

border-bottom:1px solid #eee;

}

/* HOVER */

tr:hover{

background:#fff7ed;

}

/* LINKS */

a{

text-decoration:none;

font-weight:600;

color:#2563eb;

margin:5px;

}

a:hover{

text-decoration:underline;

}

/* BACK BUTTON */

.back{

display:inline-block;

margin-top:25px;

background:#2563eb;

color:white;

padding:10px 18px;

border-radius:8px;

text-decoration:none;

}

.back:hover{

background:#1d4ed8;

}

</style>

</head>

<body>

<h2>📖 All Books</h2>

<!-- SEARCH -->

<form method="GET">

Search Book :

<input type="text"

name="search"

placeholder="Title or Category">

<button type="submit">

Search

</button>

</form>

<table>

<tr>

<th>ID</th>
<th>Title</th>
<th>Author</th>
<th>Status</th>
<th>Edit</th>
<th>Delete</th>

</tr>

<?php

/* SEARCH QUERY */

if(isset($_GET['search']) && $_GET['search']!=""){

$search=$conn->real_escape_string($_GET['search']);

$sql="SELECT * FROM books
WHERE title LIKE '%$search%'
OR category LIKE '%$search%'";

}
else{

$sql="SELECT * FROM books";

}

$result=$conn->query($sql);

if($result && $result->num_rows>0){

while($row=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['id']."</td>";

echo "<td>".$row['title']."</td>";

echo "<td>".$row['author']."</td>";

echo "<td>".$row['status']."</td>";

echo "<td>
<a href='edit_book.php?id=".$row['id']."'>
Edit
</a>
</td>";

echo "<td>
<a href='delete_book.php?id=".$row['id']."'>
Delete
</a>
</td>";

echo "</tr>";

}

}

else{

echo "<tr>

<td colspan='6'>

No Books Found

</td>

</tr>";

}

?>

</table>

<!-- IMPORTANT FIX -->

<a class="back"

href="librarian_dashboard.php"

target="_top">

⬅ Back

</a>

</body>

</html>