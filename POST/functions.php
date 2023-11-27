<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=kirakugaki;host=localhost';
    try {
        $pdo = new PDO($param, 'kirakugaki', "kirakugaki");
        return $pdo;

    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
?>