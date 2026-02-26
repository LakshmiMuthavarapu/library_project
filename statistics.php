<?php

session_start();

include "db.php";

/* SECURITY */

if(!isset($_SESSION['username'])){

header("Location: login.php");

exit();

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Library Statistics</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

/* BODY */

body{

margin:0;

font-family:Poppins;

background-image:url("statisticsbook_bg.jpg");

background-size:cover;

background-position:center;

background-repeat:no-repeat;

background-attachment:fixed;

padding:30px;

text-align:center;

}

/* TITLES */

h2{

color:white;

margin-bottom:10px;

font-weight:600;

text-shadow:
2px 2px 6px rgba(0,0,0,0.7);

}

h3{

color:#ffd700;

margin-bottom:20px;

text-shadow:
2px 2px 6px rgba(0,0,0,0.7);

}

/* TABLE */

table{

margin:auto;

border-collapse:collapse;

width:70%;

background:white;

border-radius:14px;

overflow:hidden;

box-shadow:
0px 10px 25px rgba(0,0,0,.15);

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

/* TOP BOOK */

.top{

font-weight:600;

color:#16a34a;

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

<h2>📊 Library Statistics</h2>

<h3>⭐ Most Borrowed Books</h3>

<table>

<tr>

<th>Book</th>

<th>Times Borrowed</th>

</tr>

<?php

$result=$conn->query(

"SELECT books.title,
COUNT(borrowed_books.book_id) AS total

FROM borrowed_books

JOIN books
ON books.id = borrowed_books.book_id

GROUP BY borrowed_books.book_id

ORDER BY total DESC"

);

if(!$result){

die("Query Failed : ".$conn->error);

}

$rank=1;

if($result->num_rows==0){

echo "<tr>

<td colspan='2'>

No Records Found

</td>

</tr>";

}

while($row=$result->fetch_assoc()){

echo "<tr>";

if($rank==1){

echo "<td class='top'>

🏆 ".htmlspecialchars($row['title'])."

</td>";

}

else{

echo "<td>"

.htmlspecialchars($row['title']).

"</td>";

}

echo "<td>".$row['total']."</td>";

echo "</tr>";

$rank++;

}

?>

</table>

<!-- ⭐ MAIN FIX -->

<a class="back"

href="librarian_dashboard.php"

target="_top">

⬅ Back

</a>

</body>

</html>