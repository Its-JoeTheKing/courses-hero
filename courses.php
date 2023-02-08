<?php
require("conf.php");
$query = "SELECT * FROM courses";
if (isset($_GET["type"])) {
    $tag = $_GET["type"];
    $query = "SELECT * FROM courses WHERE tags LIKE '%".$tag."%' ";
}
else if (isset($_POST["search"])) {
    $tag = $_POST["search"];
    $query = "SELECT * FROM courses WHERE tags LIKE '%".$tag."%' ";
}
$res = mysqli_query($db, $query);
error_reporting(false);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Hero</title>
    <link rel="stylesheet" href="css/courses.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&family=Inria+Sans:wght@700&family=Irish+Grover&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h2 class="nav-tit">Course Hero</h2>
        <form action="" method="post" class="search">
            <div class="logo"><i class="fas fa-search"></i></div>
            <input type="text" name="search" id="">
        </form>
    </header>
    <div class="cont">
        <div class="g"></div>
        <?php
        while ($result = mysqli_fetch_assoc($res)) {
            echo "<a href='#' class='card'>";
            echo "<img src='" . $result["image"] . "'/>";
            echo "<h2>" . $result["name"] . "</h2>";
            $tags = explode(",", $result["tags"]);
            echo "<div class='tags'>";
            foreach ($tags as $tag) {
                echo "<div class='tag'>" . $tag . "</div>";
            }
            echo "</div>";
            echo "<div class='foot-card'>";
            echo "<div class='aut'>" . $result["author"] . "</div>";
            echo "<div class='rates'>";
            for ($i = 0; $i < $result["rating"]; $i++) {
                echo "<i class='fas fa-star'></i>";
            };
            echo "</div>";
            echo "</div>";
            echo "</a>";
        }
        ?>
    </div>
</body>

</html>