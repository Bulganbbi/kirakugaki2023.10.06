<?php
// delete.php

// エラー表示を有効にする
error_reporting(E_ALL);
ini_set('display_errors', 1);

// セッション開始
session_start();

// 必要な関数やデータベース接続などの読み込み
require_once './POST/functions.php';
$pdo = connectDB();

// ID パラメータの取得と検証
$imageId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($imageId === false || $imageId === null) {
    // 不正なパラメータが渡された場合のエラー処理
    echo '不正なパラメータです';
    exit;
}

// 画像の所有者を取得
$ownerId = getOwnerId($imageId, $pdo);

// ログインしているユーザーのIDを取得
$loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// 画像の所有者がログイン中のユーザーであるか確認
if ($ownerId !== $loggedInUserId) {
    // 不正なアクセスを防ぐためのエラー処理
    echo '権限がありません';
    exit;
}

// 削除処理
$sql = 'DELETE FROM rakugaki_images WHERE image_id = :image_id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':image_id', $imageId, PDO::PARAM_INT);

if ($stmt->execute()) {
    // 削除が成功したら一覧ページにリダイレクト
    header('Location: list.php');
    exit;
} else {
    // 削除に失敗した場合のエラー処理
    echo '削除に失敗しました';
    exit;
}
?>
