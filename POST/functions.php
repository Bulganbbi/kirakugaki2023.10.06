<?php
session_start();

function checkSessionTimeout() {
    // セッションの有効期限を24時間に設定
    $sessionTimeout = 24 * 60 * 60; // 24時間（秒単位）

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $sessionTimeout)) {
        // セッションが有効期限を超えた場合はログアウト
        session_unset();
        session_destroy();
        header('Location: ./login.php'); // ログインページにリダイレクト
        exit();
    }

    // 最終アクティビティのタイムスタンプ更新
    $_SESSION['last_activity'] = time();
}

// ログインしているか確認する関数
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// ログインしていない場合はログインページにリダイレクト
if (!isLoggedIn()) {
    header('Location: ./login.php');
    exit();
}

// セッションの有効期限をチェック
checkSessionTimeout();

// ログインユーザーの情報を取得
$userInfo = getUserInfo($_SESSION['user_id']);

// checkSessionTimeout関数を各ページの冒頭で呼び出す
checkSessionTimeout();

// 以下、他の関数や設定 (省略)

function connectDB() {
    $pdo = new PDO("mysql:host=localhost;dbname=kirakugaki", "kirakugaki", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $pdo;
}

function getUserInfo($userId) {
    $pdo = connectDB();
    
    // ユーザー情報を取得する
    $stmt = $pdo->prepare("SELECT name FROM users WHERE user_id = ?");
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();

    // 結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    // 接続を閉じる
    $pdo = null;

    return $result;
}
?>
