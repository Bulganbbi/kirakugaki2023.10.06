<?php
require_once 'functions.php';

if (session_status() == PHP_SESSION_NONE) {
    // セッションがまだ開始されていない場合にのみ開始
    session_start();
}

// ログインしていない場合はログインページにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit();
}

$pdo = connectDB();

// 画像を削除
$sql = 'DELETE FROM rakugaki_images WHERE image_id = :image_id AND user_id = :user_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':image_id', (int)$_POST['image_id'], PDO::PARAM_INT);
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();

header('Location: ./main.php');
exit();
?>
