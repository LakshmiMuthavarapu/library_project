<?php

include "db.php";

$id=$_GET['id'];

$result=$conn->query(

"SELECT * FROM borrowed_books WHERE id=$id"

);

$row=$result->fetch_assoc();

$book=$row['book_id'];

$conn->query(

"UPDATE borrowed_books
SET returned=TRUE
WHERE id=$id"

);

$conn->query(

"UPDATE books
SET status='available'
WHERE id=$book"

);

header("Location:borrowed_books.php");

?>