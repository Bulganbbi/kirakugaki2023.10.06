<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageId = $_POST['image_id'];

    // データベースに接続
    $pdo = connectDB();

    // 削除クエリの実行
    $sql = 'DELETE FROM rakugaki_images WHERE image_id = :image_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':image_id', $imageId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // 削除成功した場合の処理（リダイレクトなど）
        header('Location: ./your_redirect_page.php');
        exit;
    } else {
        // 削除失敗した場合の処理
        echo '削除に失敗しました';
    }
}
