<?php
require_once 'functions.php';

$pdo = connectDB();

// ID パラメータの取得と検証
$imageId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($imageId === false || $imageId === null) {
    // 不正なパラメータが渡された場合のエラー処理
    echo '不正なパラメータです';
    exit;
}

$sql = 'DELETE FROM rakugaki_images WHERE image_id = :image_id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':image_id', $imageId, PDO::PARAM_INT);
$stmt->execute();

header('Location: list.php');
exit();
?>
