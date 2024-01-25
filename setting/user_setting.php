<?php
require_once '../POST/functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$restrictionValue = isset($_SESSION['restriction_value']) ? $_SESSION['restriction_value'] : '';

// データベースに接続
$pdo = connectDB();

// 表示条件を取得
// $condition = ($restrictionValue == '2') ? ' AND r18_flag = 0' : '';

// データベースからr18_flagを取得
// $sql = 'SELECT r18_flag FROM rakugaki_images WHERE user_id = :user_id';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
// $stmt->execute();
// $databaseR18Flag = $stmt->fetchColumn();

// // r18_flagが取得できた場合はセッションの値を更新
// if ($databaseR18Flag !== false) {
//     $_SESSION['restriction_value'] = $databaseR18Flag;
//     $restrictionValue = $databaseR18Flag;
// }

// ユーザー情報を取得
$sqlUserInfo = 'SELECT user_icon FROM users WHERE user_id = :user_id';
$stmtUserInfo = $pdo->prepare($sqlUserInfo);
$stmtUserInfo->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtUserInfo->execute();
$userInfo = $stmtUserInfo->fetch(PDO::FETCH_ASSOC);

// 閲覧制限変更処理
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeRestriction'])) {
    $newRestrictionValue = isset($_POST['restriction']) ? $_POST['restriction'] : '';

    // バリデーションが必要ならここで実装

    // データベースなどに新しい閲覧制限の値を保存する処理を追加
    // 例えば、rakugaki_images テーブルに新しい値を保存する場合：
    // $updateRestrictionSql = 'UPDATE rakugaki_images SET r18_flag = :r18_flag WHERE user_id = :user_id';
    // $updateRestrictionStmt = $pdo->prepare($updateRestrictionSql);
    // $updateRestrictionStmt->bindValue(':r18_flag', $newRestrictionValue, PDO::PARAM_INT);
    // $updateRestrictionStmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    // $updateRestrictionStmt->execute();

    // セッションの閲覧制限の値も更新
    $_SESSION['restriction_value'] = $newRestrictionValue;

    // 必要に応じて他の処理を追加

    // リダイレクト
    header('Location: 設定変更後の画面のURL');
    exit;
}

// ユーザーネーム変更処理
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeUsername'])) {
    $newUsername = isset($_POST['newUsername']) ? $_POST['newUsername'] : '';

    // バリデーションが必要ならここで実装

    // データベースにユーザーネームを更新
    $updateSql = 'UPDATE users SET name = :newUsername WHERE user_id = :user_id';
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindValue(':newUsername', $newUsername, PDO::PARAM_STR);
    $updateStmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $updateStmt->execute();

    // セッションのユーザーネームも更新
    $_SESSION['user_name'] = $newUsername;
}

// プロフィール画像変更処理
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeProfileImage'])) {
    $profileImage = $_FILES['profileImage'];

    // バリデーションが必要ならここで実装

    // 画像をDBに保存
    $updateSql = 'UPDATE users SET user_icon = :user_icon WHERE user_id = :user_id';
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindValue(':user_icon', file_get_contents($profileImage['tmp_name']), PDO::PARAM_LOB);
    $updateStmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $updateStmt->execute();
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
    .setting-post-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center; /* 必要に応じてテキストの中央揃えも追加 */
    }

    .setting-post-container img {
        max-width: 100%; /* 画像がコンテナをはみ出さないように */
        border-radius: 50%; /* 画像を円形にする場合は必要 */
    }

    .submit {
        margin-top: 20px; /* 適用ボタンの上部の余白 */
    }
    .btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    background-color: rgba(248, 116, 22, 0.628);
    
  }

    .btn-primary {
    color: #fff;
    background-color: rgba(246, 170, 30, 0.742);
    border-color:rgba(246, 170, 30, 0.555);
    
    }
  
  /* ホバー時のスタイル */
    .btn:hover {
    color: white;
    text-decoration: none;
    background-color: rgba(246, 170, 30, 0.555);
    border-color:rgba(246, 170, 30, 0.555);

    }
     .btn-primary:focus{
        color: white;
        background-color: rgba(246, 170, 30, 0.742);
        border-color:rgba(246, 170, 30, 0.555);
        box-shadow: none;
     }
    </style>

</head>
<body>
    <?php include("../components/footer.php"); ?>
    <?php include("../components/setting_nav.php"); ?>
    <?php include("../components/setting.php"); ?>

    <!-- ユーザー設定項目 -->
    <div class="setting-content">
        <div class="setting-post-container">
            <!-- プロフィール画像の表示 -->
            <img src="data:image/jpeg;base64,<?php echo base64_encode($userInfo['user_icon']); ?>" alt="プロフィール画像">

            <ul>
                <h1> <?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?></h1>
                <!-- ユーザーネーム変更ポップアップ -->
                <li>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeUsernameModal">
                        ユーザーネーム変更
                    </button>

                    <div class="modal fade" id="changeUsernameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ユーザーネーム変更</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>現在のユーザーネーム: <?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?></p>
                                    <form method="post" action="">
                                        <div class="mb-3">
                                            <label for="newUsername" class="form-label">新しいユーザーネーム</label>
                                            <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                                        </div>
                                        <button type="submit" name="changeUsername" class="btn btn-primary">変更</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- プロフィール画像変更ポップアップ -->
                <li>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeProfileImageModal">
                        プロフィール画像変更
                    </button>

                    <div class="modal fade" id="changeProfileImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">プロフィール画像変更</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="profileImage" class="form-label">新しいプロフィール画像を選択</label>
                                            <input type="file" class="form-control" id="profileImage" name="profileImage" accept="image/*" required>
                                        </div>
                                        <button type="submit" name="changeProfileImage" class="btn btn-primary">変更</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </li>
                <li>
                    <p>閲覧制限(R18&R18G)</p>
                    <form action="action.php" method="post">
                        <input type="radio" name="restriction" value="1" id="see" <?php echo ($restrictionValue == '1') ? 'checked' : ''; ?>>
                        <label for="see" class="label">表示する</label>                            
                        <input type="radio" name="restriction" value="2" id="nosee" <?php echo ($restrictionValue == '2') ? 'checked' : ''; ?>>
                        <label for="nosee" class="label">表示しない</label>  
                        <input type="submit" name="changeRestriction" class="btn_type01" value="適用">
                    </form>
                </li> -->

            </ul> 
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
