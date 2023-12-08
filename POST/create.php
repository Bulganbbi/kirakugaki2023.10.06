<?php
// データベースに接続
$pdo = new PDO("mysql:host=localhost;dbname=your_database", "kirakugaki");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// テーブルが存在しない場合、作成する
$sql = "CREATE TABLE IF NOT EXISTS rakugaki_images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    image_name VARCHAR(255) NOT NULL,
    image_type VARCHAR(50) NOT NULL,
    image_content LONGBLOB NOT NULL,
    image_size INT NOT NULL,
    image_comment TEXT,
    image_hashtag VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$pdo->exec($sql);
//test
?>

