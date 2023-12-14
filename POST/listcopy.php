<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

// functions.php ファイルを読み込み
require_once 'functions.php';

// セッションが開始されていない場合は開始する
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ユーザーがログインしていない場合はログインページにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // ログインページのパスを適切に修正
    exit();
}

// データベースに接続
$pdo = connectDB();

$err_msg = $err_msg ?? ""; 

// POST メソッドでない場合
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['image']['name'])) {
    // 画像を保存
    $userId = $_SESSION['user_id'];

    $name = $_FILES['image']['name'];
    $type = $_FILES['image']['type'];
    $content = file_get_contents($_FILES['image']['tmp_name']);
    $size = $_FILES['image']['size'];
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
    $hashtag = isset($_POST['hashtag']) ? $_POST['hashtag'] : '';

    // 画像のサイズ・形式チェック
    $maxFileSize = 20 * 1024 * 1024; // 20MBをバイト単位に変換
    $validFileTypes = ['image/png', 'image/jpeg'];
    if ($size > $maxFileSize || !in_array($type, $validFileTypes)) {
        $err_msg = '* jpg, jpeg, png 形式で 20 MB までの画像を選択してください。';
    }
    
    if ($err_msg == '') {
        // 画像情報をデータベースに挿入
        $sql = 'INSERT INTO rakugaki_images(user_id, image_name, image_type, image_content, image_size, image_comment, image_hashtag, created_at)
        VALUES (:user_id, :image_name, :image_type, :image_content, :image_size, :image_comment, :image_hashtag, now())';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_LOB); // LONGBLOB型に修正
        $stmt->bindValue(':image_comment', $comment, PDO::PARAM_STR);
        $stmt->bindValue(':image_hashtag', $hashtag, PDO::PARAM_STR);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->execute();

        // リダイレクト前にセッションをクリアする
        session_write_close();

        // 画像リストページにリダイレクト
        header('Location: ../main.php'); 
        exit();
    }
}

// 画像を取得
$sql = 'SELECT * FROM rakugaki_images WHERE user_id = :user_id ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$images = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Image Test</title>
    <!-- Bootstrap CSS（既に読み込まれていると仮定） -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="shortcut icon" href="../images/title.PNG" type="image/x-icon">
    <style>
    .file-input-container {
        position: relative;
        height: 400px;
        border: 2px dashed #cccccc;
        margin-bottom: 20px;
        transition: background-color 0.3s ease;
    }

    .file-input-container:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    #image {
        display: none;
    }

    .preview-image {
        max-width: 100%;
        max-height: 100%;
    }

    .file-label {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        cursor: pointer;
    }

    .preview-image[src=""] {
        display: none;
    }

    .file-label[for="image"] {
        display: block;
    }

    .file-label:not([for="image"]) {
        display: none;
    }
</style>
</head>
<body>
    <?php include("../components/post_nav.php"); ?>
        <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <?php if (!empty($images)): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($images[0]['image_content']); ?>" class="img-fluid preview-image mb-3" alt="Preview Image">
                <?php endif; ?>
            </div>
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="image" accept=".jpg,.jpeg,.png" required>
                        <?php if ($err_msg != ''): ?>
                            <div class="invalid-feedback d-block"><?= $err_msg; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="text" name="comment" class="form-control" placeholder="作品のコメント">
                    </div>
                    <div class="form-group">
                        <input type="text" name="hashtag" class="form-control mb-3" placeholder="タグ付け 例:#オリキャラ">
                    </div>
                    <div class="text-center">
                        <!-- 修正 -->
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-JV8dNCYT9FL3JYaI3VeyF+riJjZO0wJi2I/JvxW9xcC1zFLCJ73G1GbiKu2LZmpW" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#image').change(function (event) {
                var input = event.target;
                var previewImage = $('.preview-image');
                var fileLabel = $('.file-label');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        previewImage.attr('src', e.target.result);
                        // 画像が選択されたら「ファイルを選択」のラベルを非表示にする
                        fileLabel.css('display', 'none');
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    // 画像が選択されていない場合は「ファイルを選択」のラベルを表示する
                    fileLabel.css('display', 'block');
                    previewImage.attr('src', ''); // 画像が表示されないようにする
                }
            });
        });
    </script>
</body>
</html>
