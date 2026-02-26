<?php

session_start();

include "db.php";

/* SECURITY */

if(!isset($_SESSION['username'])){

header("Location: login.php");

exit();

}

/* ISSUE BOOK LOGIC */

$success="";

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['issue'])){

$book = $_POST['book_id'];

$student = $conn->real_escape_string($_POST['student']);

$due = $_POST['due'];

/* INSERT */

$conn->query(

"INSERT INTO borrowed_books
(book_id,student_name,due_date)

VALUES
('$book','$student','$due')"

);

/* UPDATE STATUS */

$conn->query(

"UPDATE books
SET status='borrowed'
WHERE id='$book'"

);

$success="✅ Book Issued Successfully";

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Issue Book</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

/* BODY */

body{

margin:0;

font-family:Poppins;

background-image:url("issuebook_bg.jpg");

background-size:cover;

background-position:center;

background-repeat:no-repeat;

background-attachment:fixed;

display:flex;

justify-content:center;

align-items:center;

min-height:100vh;

}

/* CARD */

.card{

background:white;

width:460px;

padding:30px;

border-radius:16px;

box-shadow:
0px 10px 25px rgba(0,0,0,.15);

animation:fade .5s ease;

}

h2{

text-align:center;

color:#1e293b;

margin-bottom:18px;

}

label{

font-weight:600;

color:#555;

}

input,select{

width:100%;

padding:10px;

margin-top:6px;

margin-bottom:15px;

border-radius:8px;

border:1px solid #ccc;

font-family:Poppins;

}

input:focus,select:focus{

outline:none;

border-color:#fb923c;

box-shadow:0 0 6px rgba(251,146,60,.4);

}

button{

width:100%;

background:
linear-gradient(
135deg,
#fb923c,
#f97316
);

color:white;

padding:12px;

border:none;

border-radius:10px;

font-weight:600;

cursor:pointer;

transition:.3s;

}

button:hover{

background:
linear-gradient(
135deg,
#ea580c,
#c2410c
);

transform:scale(1.04);

}

/* SUCCESS */

.success{

text-align:center;

color:#16a34a;

font-weight:600;

margin-top:12px;

}

/* BACK BUTTON */

.back{

display:block;

text-align:center;

margin-top:18px;

text-decoration:none;

font-weight:600;

color:#2563eb;

}

.back:hover{

text-decoration:underline;

}

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

</style>

</head>

<body>

<div class="card">

<h2>🔄 Issue Book</h2>

<form method="POST">

<label>Book</label>

<select name="book_id" required>

<?php

$result=$conn->query(

"SELECT * FROM books WHERE status='available'"

);

while($row=$result->fetch_assoc()){

echo "<option value='".$row['id']."'>"

.htmlspecialchars($row['title']).

"</option>";

}

?>

</select>

<label>Student Name</label>

<input name="student" required>

<label>Due Date</label>

<input type="date" name="due" required>

<button type="submit" name="issue">

Issue Book

</button>

</form>

<?php

if(!empty($success)){

echo "<p class='success'>$success</p>";

}

?>

<!-- ⭐ MAIN FIX -->

<a class="back"

href="librarian_dashboard.php"

target="_top">

⬅ Back

</a>

</div>

</body>

</html>