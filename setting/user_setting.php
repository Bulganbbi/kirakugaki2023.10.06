<?php
require_once '../POST/functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$restrictionValue = isset($_SESSION['restriction_value']) ? $_SESSION['restriction_value'] : '';

// データベースに接続
$pdo = connectDB();

// 表示条件を取得
$condition = ($restrictionValue == '2') ? ' AND r18_flag = 0' : '';

// データベースからr18_flagを取得
$sql = 'SELECT r18_flag FROM rakugaki_images WHERE user_id = :user_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$databaseR18Flag = $stmt->fetchColumn();

// r18_flagが取得できた場合はセッションの値を更新
if ($databaseR18Flag !== false) {
    $_SESSION['restriction_value'] = $databaseR18Flag;
    $restrictionValue = $databaseR18Flag;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['restriction'])) {
        $restrictionValue = $_POST['restriction'];
        // セッションに設定を保存
        $_SESSION['restriction_value'] = $restrictionValue;

        // データベースにも保存する場合はここで更新処理を追加する
        $sql = 'UPDATE rakugaki_images SET r18_flag = :r18_flag WHERE user_id = :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':r18_flag', $restrictionValue, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設定変更</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/title.PNG" type="image/x-icon">
    <link rel="stylesheet" href="../css/main.css">
    <style>
    </style>
</head>
<body>
    <?php include("../components/footer.php"); ?>
    <?php include("../components/setting_nav.php"); ?>
    <?php include("../components/setting.php"); ?>

    <!-- ユーザー設定項目 -->
    <div class="setting-content">
        <div class="setting-post-container" >
            <img src="../images/profile..jpg" >
            <ul>
                <li>
                    <a href="">ユーザーネーム変更</a>   <!-- プロフィールに飛ばす -->
                </li>
                <li>
                    <a href="">プロフィール画像変更</a>  <!-- プロフィールに飛ばす -->
                </li>
                <li>
                    <p>閲覧制限(R18&R18G)</p>
                    <form action="" method="post"> <!-- actionを空にして現在のページに送信するように変更 -->
                        <input type="radio" name="restriction" value="1" id="see" <?php echo ($restrictionValue == '1') ? 'checked' : ''; ?>>
                        <label for="see" class="label">表示する</label>                            
                        <input type="radio" name="restriction" value="2" id="nosee" <?php echo ($restrictionValue == '2') ? 'checked' : ''; ?>>
                        <label for="nosee" class="label">表示しない</label>  
                        <input type="submit" name="submit" class="btn_type01" value="適用">
                    </form>
                </li>
            </ul> 
            <!-- 適用ボタン -->
            <div class="submit">
                <hr>
                <input type="submit" name="submit" class="btn_type01" value="適用"> 
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
