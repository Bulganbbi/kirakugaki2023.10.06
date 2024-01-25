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

function searchImagesByKeyword($keyword) {
    $pdo = connectDB();

    $sql = 'SELECT i.*, u.name FROM rakugaki_images i
            INNER JOIN users u ON i.user_id = u.user_id
            WHERE i.image_comment LIKE :keyword OR i.image_hashtag LIKE :keyword
            ORDER BY i.created_at DESC';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll();
}

// functions.php

function getOwnerId($imageId, $pdo) {
    // 画像の所有者の ID を取得するロジック
    $stmt = $pdo->prepare("SELECT user_id FROM rakugaki_images WHERE image_id = ?");
    $stmt->bindParam(1, $imageId, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $result['user_id'] ?? null;
}


?>
