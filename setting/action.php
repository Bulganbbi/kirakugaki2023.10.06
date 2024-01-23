<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTメソッドで送信された場合のみ処理

    // 閲覧制限の値を取得
    $restrictionValue = isset($_POST['restriction']) ? $_POST['restriction'] : '';

    // セッションに設定値を保存
    $_SESSION['restriction_value'] = $restrictionValue;

    // データベースに閲覧制限の値を保存する処理を追加
    // ここで適切なデータベースへの接続と更新処理を実行する必要があります

}

// 設定が終わったらメイン画面にリダイレクト
header('Location: main.php');
exit;
