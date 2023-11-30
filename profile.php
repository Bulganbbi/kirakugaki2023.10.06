<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './POST/functions.php';

$con = new mysqli("localhost", "kirakugaki", "", "kirakugaki");

session_start();
session_regenerate_id(true);

if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
}

// データベースから画像を取得
$result = $con->query("SELECT * FROM rakugaki_images");
$images = $result->fetch_all(MYSQLI_ASSOC);

$con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
    <link rel="shortcut icon" href="images/title.PNG" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include("./components/nav.php"); ?>
    <div class="header_wrapper">
        <header></header>
        <div class="cols_container">
            <div class="left_col">
                <div class="img_container">
                    <img src="./images/profile..jpg" alt="ユーザ名">
                    <span></span>
                </div>
                <h2>あなたの名前</h2>
                <p>xxxxx@email.com</p>
                <hr>
                <div class="content">
                    <p>イラストの評価を気にせずきらくに投稿できる！
                    評価を気にしないことによって精神的に辛くなることはなくなり
                    モチベーションが上がって絵を楽しく描いてもらえる！
                    </p>
                    <hr>
                    <ul>
                        <a href="https://www.facebook.com/"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/"><i class='bx bxl-instagram' ></i></a>
                        <a href="https://www.pinterest.com/"><i class='bx bxl-pinterest'></i></a>
                    </ul>
                </div>
            </div>
            <div class="right_col">
            <nav>
                <ul>
                    <li><a href="#">galleries</a></li>
                    <li><a href="#">about</a></li>
                </ul>
            </nav>
            <div class="photos">
                <?php foreach ($images as $image): ?>
                    <img src="data:image/<?php echo $image['image_type']; ?>;base64,<?php echo base64_encode($image['image_content']); ?>" alt="<?php echo $image['image_name']; ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 あなたの名前</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>]
</body>
</html>