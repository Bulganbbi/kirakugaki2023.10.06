<!-- action.php -->

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTメソッドで送信された場合のみ処理

    // 閲覧制限の値を取得
    $restrictionValue = isset($_POST['restriction']) ? $_POST['restriction'] : '';

    // セッションに設定値を保存
    $_SESSION['restriction_value'] = $restrictionValue;

    // 他の処理も追加できる場合はここに追加
}

// 設定が終わったらメイン画面にリダイレクト
header('Location: main.php');
exit;
