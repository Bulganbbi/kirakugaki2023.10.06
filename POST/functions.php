<?php

function connectDB() {
    $pdo = new PDO("mysql:host=localhost;dbname=kirakugaki", "kirakugaki", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $pdo;
}

function getUserInfo($userId) {
    $pdo = connectDB();

    // ユーザー情報を取得する
    $stmt = $pdo->prepare("SELECT name, user_icon FROM users WHERE user_id = ?");
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();

    // 結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    // 接続を閉じる
    $pdo = null;

    return $result;
}

// functions.php に追加
function getUserIcon($userId) {
    $pdo = connectDB();

    // ユーザーアイコンを取得する
    $stmt = $pdo->prepare("SELECT user_icon FROM users WHERE user_id = ?");
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();

    // 結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt->closeCursor();
    $pdo = null;

    return $result['user_icon'] ?? null;
}

?>
