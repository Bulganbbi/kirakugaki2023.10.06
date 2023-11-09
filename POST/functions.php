<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=kirakugaki;host=localhost';
    try {
        $pdo = new PDO($param, '220109uj@yse-c.net', 'kirakugaki');
        return $pdo;

    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
?>