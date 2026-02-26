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

<title>Borrowed Books</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

/* BODY */

body{

margin:0;

font-family:Poppins;

background-image:url("borrowedbook_bg.jpg");

background-size:cover;

background-position:center;

background-repeat:no-repeat;

background-attachment:fixed;

padding:30px;

text-align:center;

}

/* TITLE */

h2{

color:white;

margin-bottom:20px;

text-shadow:
2px 2px 6px rgba(0,0,0,0.7);

}

/* TABLE */

table{

margin:auto;

border-collapse:collapse;

width:85%;

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

/* ROW */

td{

padding:12px;

border-bottom:1px solid #eee;

}

/* HOVER */

tr:hover{

background:#fff7ed;

}

/* STATUS */

.overdue{

color:white;

background:#ef4444;

padding:5px 12px;

border-radius:8px;

font-size:13px;

font-weight:600;

}

.borrowed{

color:white;

background:#fb923c;

padding:5px 12px;

border-radius:8px;

font-size:13px;

font-weight:600;

}

/* RETURN BUTTON */

.return{

background:#22c55e;

color:white;

padding:6px 14px;

border-radius:8px;

text-decoration:none;

font-weight:600;

}

.return:hover{

background:#16a34a;

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

<h2>⏰ Borrowed Books</h2>

<table>

<tr>

<th>Book</th>
<th>Student</th>
<th>Due Date</th>
<th>Status</th>
<th>Return</th>

</tr>

<?php

$result=$conn->query(

"SELECT borrowed_books.*, books.title
FROM borrowed_books
JOIN books
ON borrowed_books.book_id = books.id
WHERE returned = FALSE"

);

$today=date("Y-m-d");

if($result && $result->num_rows>0){

while($row=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".htmlspecialchars($row['title'])."</td>";

echo "<td>".htmlspecialchars($row['student_name'])."</td>";

echo "<td>".$row['due_date']."</td>";

/* STATUS */

if($today > $row['due_date']){

echo "<td>

<span class='overdue'>

Overdue

</span>

</td>";

}

else{

echo "<td>

<span class='borrowed'>

Borrowed

</span>

</td>";

}

/* RETURN BUTTON */

echo "<td>

<a class='return'

href='return_book.php?id=".$row['id']."'>

Return

</a>

</td>";

echo "</tr>";

}

}

else{

echo "<tr>

<td colspan='5'>

No Borrowed Books Found

</td>

</tr>";

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