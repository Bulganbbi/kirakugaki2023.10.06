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


<!-- main content -->
<style>
    :root {
    --gutter-x: 0.5rem;
    --gutter-y: -1.5rem; 
    }
    .post-img {
        object-fit: cover; 
        object-position: center; 
        height: 200px; 
        width: 100%; 
    }

    .write-post-container {
        margin-bottom: var(--gutter-y); 
    }

    .post-container {
        margin-bottom: var(--gutter-y); 
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .truncated-text {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .write-post-container a.btn-warning {
        background-color: rgba(255, 193, 7, 0.5); 
        border-color: #ffc107; 
        color: #212529; 
    }

</style>

<div class="main-content">
    <div class="write-post-container d-grid gap-2">
        <a href="./POST/list.php" class="btn btn-warning btn-lg">きらくに投稿</a>
    </div>


    <?php
    // ログインしている場合、セッションからユーザーIDを取得
    $loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // データベースに接続
    $pdo = connectDB();

    // 画像を取得
    $sql = 'SELECT i.*, u.name, u.user_icon FROM rakugaki_images i
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
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
            <?php foreach ($images as $image): ?>
                <div class="col mb-4">
                    <!-- 画像をクリックしたら詳細ページに遷移 -->
                    <a href="detail.php?image_id=<?= $image['image_id']; ?>" class="text-decoration-none text-reset">
                        <div class="post-container">
                            <!-- ユーザー情報 -->
                            <div class="left-post-contents">
                                <div class="user-profile">
                                    <!-- ユーザーのアイコン -->
                                    <?php if ($loggedInUserId == $image['user_id']): ?>
                                        <!-- ログイン中のユーザーのアイコン -->
                                        <img src="data:image/jpeg;base64,<?= base64_encode($image['user_icon']); ?>" alt="User Icon">
                                    <?php else: ?>
                                        <!-- 他のユーザーのアイコン -->
                                        <img src="data:image/jpeg;base64,<?= base64_encode(getUserIcon($image['user_id'])); ?>" alt="User Icon">
                                    <?php endif; ?>
                                    <div>
                                        <p class="user-text"><?= $image["name"]; ?></p><!-- ユーザーネーム -->
                                        <!-- 削除ボタン -->
                                        <?php if ($loggedInUserId == $image['user_id']): ?>
                                            <a href="delete.php?id=<?= $image['image_id']; ?>" class="btn btn-danger btn-sm">削除</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- 作品情報 -->
                            <p class="post-text truncated-text"><?= $image['image_comment']; ?><a href="#"><?= $image['image_hashtag']; ?></a></p>
                            <img src="data:image/<?= $image['image_type']; ?>;base64,<?= base64_encode($image['image_content']); ?>" class="post-img">
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
</div>
<?php include("./components/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>