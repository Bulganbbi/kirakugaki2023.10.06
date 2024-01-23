<?php
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

// 表示条件を取得
$restrictionValue = isset($_SESSION['restriction_value']) ? $_SESSION['restriction_value'] : '';
$condition = ($restrictionValue == '2') ? ' AND r18_flag = 0' : '';

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
    $hashtag = isset($_POST['hashtag']) ? $_POST['hashtag'] : ''; // ハッシュタグの追加
    $r18Flag = isset($_POST['r18_flag']) ? $_POST['r18_flag'] : 0; // R18 フラグの追加
    $r18_flag = isset($_POST['r18']) ? 1 : 0; // R18チェックがある場合は1、ない場合は0

    // 画像のサイズ・形式チェック
    $maxFileSize = 20 * 1024 * 1024; // 20MBをバイト単位に変換
    $validFileTypes = ['image/png', 'image/jpeg'];
    if ($size > $maxFileSize || !in_array($type, $validFileTypes)) {
        $err_msg = '* jpg, jpeg, png 形式で 20 MB までの画像を選択してください。';
    }

    if ($err_msg == '') {
        // 画像情報をデータベースに挿入
        $sql = 'INSERT INTO rakugaki_images(user_id, image_name, image_type, image_content, image_size, image_comment, image_hashtag, r18_flag, created_at)
        VALUES (:user_id, :image_name, :image_type, :image_content, :image_size, :image_comment, :image_hashtag, :r18_flag, now())';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_comment', $comment, PDO::PARAM_STR);
        $stmt->bindValue(':image_hashtag', $hashtag, PDO::PARAM_STR);
        $stmt->bindValue(':r18_flag', $r18Flag, PDO::PARAM_INT);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->execute();

        // リダイレクト前にセッションをクリアする
        session_write_close();

        // 画像リストページにリダイレクト
        header('Location: ../main.php');
        exit();
    }
}

// 画像を取得（新しい画像がアップロードされたときだけ表示）
$images = [];
if (empty($err_msg)) {
    $sql = 'SELECT * FROM rakugaki_images WHERE user_id = :user_id' . $condition . ' ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $images = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Image Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="shortcut icon" href="../images/title.PNG" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <style>
        .preview-container {
            width: 100%;
            max-width: 400px;
            height: 100%; /* 予め設定された高さ */
            overflow: hidden;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0; /* 背景色を灰色に設定 */
            border-radius: 8px; /* 角丸の設定 */
            border: 2px solid #808080; /* 枠線の設定 */
        }

        .preview-image-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: inherit; /* 親要素の角丸を継承 */
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover; /* 画像を表示領域にカバーさせる */
        }
    </style>

    <script>
        $(document).ready(function () {
            // ファイルが選択されたときに呼び出されるイベント
            $('input[name="image"]').change(function (event) {
                var input = event.target;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // 画像を表示するための要素に読み込んだ画像を設定
                        $('.preview-image').attr('src', e.target.result);
                    };

                    // ファイルを読み込む
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
</head>

<body>
    <?php include("../components/setting_nav.php"); ?>
    <div class="container mt-5 mx-auto">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- 選択した画像のプレビューを表示 -->
                <div class="preview-container">
                    <div class="preview-image-container">
                        <img src="#" class="img-fluid preview-image" alt="Preview Image">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="image" accept=".jpg,.jpeg,.png" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="comment" class="form-control" placeholder="作品のコメント">
                    </div>
                    <div class="form-group">
                        <input type="text" name="hashtag" class="form-control mb-3" placeholder="タグ付け 例:#オリキャラ">
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="r18_flag" name="r18_flag" value="1">
                        <label class="form-check-label" for="r18_flag">R18</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 画像一覧を表示するためのカルーセル -->
    <?php if (!empty($images)): ?>
                <div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <ol class="carousel-indicators">
                                    <?php for ($i = 0; $i < count($images); $i++): ?>
                                        <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
                                    <?php endfor; ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php foreach ($images as $index => $image): ?>
                                        <div class="carousel-item <?= ($index === 0) ? 'active' : '' ?>">
                                            <img src="data:image/jpeg;base64,<?= base64_encode($image['image_content']); ?>"
                                                class="img-fluid preview-image mb-3" alt="Preview Image">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
</body>

</html>
