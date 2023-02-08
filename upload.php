<?php
require("conf.php");
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $tags = $_POST["tags"];
    $author = $_POST["author"];
    $rates = $_POST["rates"];
    $link = $_POST["link"];

    $file_name = explode(".", $_FILES["img"]["name"]);
    $ext = strtolower($file_name[1]);
    $allowed = ["png", "jpeg", "jpg"];

    if (in_array($ext, $allowed)) {
        $content = file_get_contents($_FILES["img"]["tmp_name"]);
        $image = "data:image/png;base64," . base64_encode($content);
        $res = $db->query("INSERT INTO courses(name,author,link,image,rating,description,tags) VALUES('$name','$author','$link','$image','$rates','$description','$tags');");
        if ($res) {
            echo "
            <div class='modal'>
                <div class='box'>
                    <h1>Thank You !!</h1>
                    <p>Thank You So Much For Uploading, I Hope You Upload Again</p>
                    <button id='close'>close</button>
                </div>
            </div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Hero</title>
    <link rel="stylesheet" href="css/upload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&family=Inria+Sans:wght@700&family=Irish+Grover&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <h2 class="nav-tit">Course Hero</h2>
        <ul>
            <a href="#">
                <li>Courses</li>
            </a>
            <a href="#">
                <li>Upload</li>
            </a>
            <a href="#">
                <li>About</li>
            </a>
        </ul>
    </header>
    <form class="cont" method="post" action="" enctype="multipart/form-data">
        <div class="s1">
            <div class="upl" id="upl">Upload The Banner Of Course</div>
            <input type="file" name="img" required style="display: none;" src="" id="img" alt="">
            <div class="inpt-group">
                <label for="name">Name Of Course</label>
                <input type="text" name="name" required placeholder="Java Programming: Arrays, Lists, and Structured Data">
            </div>
            <div class="inpt-group">
                <label for="author">Course Creator</label>
                <input type="text" name="author" required placeholder="Hassan Fulaih">
            </div>
        </div>
        <div class="s2">
            <div class="inpt-group">
                <label for="tags">Tags :</label>
                <input type="text" name="tags" required placeholder="programming,business,trading,cryptho,ecommerce,html,css">
            </div>
            <div class="inpt-group" style="display: flex;gap: 10px;">
                <input type="text" name="link" required style="width: 90%;" placeholder="link of course">
                <input type="text" name="rates" required placeholder="4.5" style="width: 10%;">
            </div>
            <div class="inpt-group">
                <label for="description">Course Description</label>
                <textarea name="description"></textarea>
            </div>
            <button class="sub" name="submit" type="submit">Add Course <i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </form>
</body>
<script src="scripts.js"></script>

</html>