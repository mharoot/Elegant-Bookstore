<html>
<head></head>
<body>

<h1>Elegant Bookstore</h1><br>
<a class="nav-link" href="./?sign-up">Sign up</a>
<br />

<?php


foreach ($books as $book)
{
    $title = $book[0]['title'];
    $title = str_replace(' ', '_', $title); //replace spaces with underscores
    $title = str_replace(':', '', $title); //remove colon
    echo "<img src='" . "http://localhost/Elegant-Bookstore/view/pages/pictures/" . $title . ".jpg" . "' alt='book' height='152' width='122'>";
    //echo $title . "<br>";
}
?>
<!-- <img src="http://localhost/Elegant-Bookstore/view/pages/pictures/Cracking_the_Coding_Interview_189_Programming_Questions_and_Solutions.jpg" height="152" width="122"> -->
</body>
</html>