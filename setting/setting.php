<?php
// settings.php

require_once './POST/functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 必要なメタタグ、タイトル、スタイルシートを追加 -->
    <title>設定</title>
</head>
<body>
    <!-- ナビゲーションバーを含む -->
    <?php include("./components/nav.php"); ?>
