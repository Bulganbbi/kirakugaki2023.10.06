<?php
require_once './POST/functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// パラメータからユーザーIDを取得
$userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// ユーザーIDが未定義の場合はログインユーザーのIDをデフォルト値
$userId = $userId ?? $_SESSION['user_id'];

// データベースに接続
$con = new mysqli("localhost", "kirakugaki", "", "kirakugaki");

// 接続を確認
if ($con->connect_error) {
    die("データベース接続エラー: " . $con->connect_error);
}

// ユーザー情報を取得
$userInfo = getUserInfo($userId);

// データベースから画像を取得
$result = $con->query("SELECT * FROM rakugaki_images WHERE user_id = $userId");
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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css'><link rel="stylesheet" href="./main.css">
</head>

<body>
<?php include("./components/nav.php"); ?>
    <div class="header_wrapper">
        <header></header>
        <div class="cols_container">
            <div class="left_col">
                <div class="img_container">
                    <!-- 投稿したユーザーのアイコン -->
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($userInfo['user_icon']); ?>" alt="<?php echo htmlspecialchars($userInfo['name'] ?? ''); ?>">
                    <span></span>
                </div>
                <h2><?php echo $userInfo['name'] ?? ''; ?></h2>
                <p><?php echo $userInfo['email'] ?? ''; ?></p>
                <hr>
                <div class="content">
                    <p>
                        プロフィール
                    </p>
                    <hr>
                    <div class="social-icon">
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-instagram instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-pinterest pinterest"></i></a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="photos">
                <?php foreach ($images as $image): ?>
                    <img src="data:image/<?php echo $image['image_type']; ?>;base64,<?php echo base64_encode($image['image_content']); ?>" alt="<?php echo $image['image_name']; ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>