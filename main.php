<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './POST/functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/titlelogo.png" type="image/x-icon">
    <title>きらくがき</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="./images/title.PNG" type="image/x-icon">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<?php include("./components/nav.php"); ?>
<?php include("./components/aside.php"); ?>
<!-- main content -->
<style>
    .post-img {
        object-fit: cover; /* 画像を均等に拡大または縮小して表示 */
        object-position: center; /* 画像の表示位置を中央に設定 */
        height: 200px; /* 画像の高さを調整（適切な高さに調整してください） */
        width: 100%; /* 幅は親要素に合わせて100%に設定 */
    }
</style>

<!-- main content -->
<div class="main-content">
    <div class="write-post-container d-grid gap-2">
        <a href="./POST/list.php" class="btn btn-primary btn-lg">らくがき投稿</a>
    </div>

    <?php
    // データベースに接続
    $pdo = connectDB();

    // 画像を取得
    $sql = 'SELECT i.*, u.name FROM rakugaki_images i
            INNER JOIN users u ON i.user_id = u.user_id
            ORDER BY i.created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll();
    ?>

    <?php if (empty($images)): ?>
        <p class="text-center mt-5">まだ投稿がありません。</p>
    <?php else: ?>
        <!-- 画像表示 -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5">
            <?php foreach ($images as $image): ?>
                <div class="col mb-4">
                    <!-- 画像をクリックしたら詳細ページに遷移 -->
                    <a href="detail.php?image_id=<?= $image['image_id']; ?>" class="text-decoration-none text-reset">
                        <div class="post-container">
                            <!-- ユーザー情報 -->
                            <div class="left-post-contents">
                            <div class="user-profile">
                                <img src="images/cat-01.jpg"><!-- ユーザーのアイコン -->
                                <div>
                                    <p class="user-text"><?= $image["name"]; ?></p><!-- ユーザーネーム -->
                                    <!-- 削除ボタンなどのアクションがあれば追加 -->
                                </div>
                            </div>
                        </div>
                        <!-- 作品情報 -->
                        <p class="post-text"><?= $image['image_comment']; ?><a href="#"><?= $image['image_hashtag']; ?></a></p>
                        <!-- 画像表示 -->
                        <img src="data:image/<?= $image['image_type']; ?>;base64,<?= base64_encode($image['image_content']); ?>" class="post-img">
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>