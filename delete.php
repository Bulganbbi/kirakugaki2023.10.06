<?php
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

// ログインしていない場合はログインページにリダイレクト
if (!$loggedInUserId) {
    header('Location: login.php');
    exit;
}

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
$stmt->execute();

// 削除が成功したら一覧ページにリダイレクト
header('Location: list.php');
exit();
?>
