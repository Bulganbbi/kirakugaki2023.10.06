<?php
require_once './POST/functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// データベースに接続
$pdo = connectDB();

// 画像IDを取得
$imageId = isset($_GET['image_id']) ? $_GET['image_id'] : null;

if (!$imageId) {
    header("Location: ./POST/list.php"); //  一覧ページにリダイレクト
    exit();
}

// 画像データを取得
$sql = 'SELECT i.*, u.name, u.user_icon FROM rakugaki_images i
        INNER JOIN users u ON i.user_id = u.user_id
        WHERE i.image_id = :imageId';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$image) {
    header("Location: ./POST/list.php"); // 一覧ページにリダイレクト
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/titlelogo.png" type="image/x-icon">
    <title>作品詳細</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="./images/title.PNG" type="image/x-icon">
    <link rel="stylesheet" href="css/main.css">
    <style>
        .post-img {
            object-fit: contain;
            object-position: center;
            height: 400px;
            width: 100%;
        }

        .post-img-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .post-img-modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 8px;
        }
    </style>
    
</head>
<body>
    <?php include("./components/nav.php"); ?>

        <!-- 画像表示 -->
        <div class="main-content">
        <div class="post-container">
            <a href="#" class="post-img-link" data-img-url="data:image/<?= $image['image_type']; ?>;base64,<?= base64_encode($image['image_content']); ?>">
                <img src="data:image/<?= $image['image_type']; ?>;base64,<?= base64_encode($image['image_content']); ?>" class="post-img">
            </a>
        </div>

        <!-- ユーザー情報 -->
        <div class="left-post-contents">
            <div class="user-profile">
                <!-- 投稿したユーザーのアイコン -->
                <img src="data:image/jpeg;base64,<?= base64_encode($image['user_icon']); ?>" alt="User Icon" class="user-icon">
                <div>
                    <p class="user-text"><?= $image["name"]; ?></p>
                    <p class="user-text"><?= date('Y年 m月d日 H:i', strtotime($image["created_at"])); ?></p>
                </div>
            </div>
        </div>

        <!-- 作品情報 -->
        <p class="post-text"><?= $image['image_comment']; ?><a href="#"><?= $image['image_hashtag']; ?></a></p>
    </div>

    <!-- 拡大表示用 -->
    <div class="post-img-modal" id="postImgModal">
        <img id="modalImg" src="" alt="拡大表示画像">
    </div>

    <script>
        // 画像リンクをクリックしたときの処理
        document.querySelectorAll('.post-img-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // 画像を表示
                var imgUrl = link.getAttribute('data-img-url');
                document.getElementById('modalImg').src = imgUrl;
                document.getElementById('postImgModal').style.display = 'flex';
            });
        });

        document.getElementById('postImgModal').addEventListener('click', function(e) {
            if (e.target.id === 'postImgModal') {
                this.style.display = 'none';
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
