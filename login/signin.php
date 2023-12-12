<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../POST/functions.php';


$con = new mysqli("localhost", "kirakugaki", "", "kirakugaki");

session_start();
session_regenerate_id(true);

if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
}

$name = $email = $password = "";
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if (empty($name) || empty($email) || empty($password)) {
        array_push($errors, "ユーザ名、メールアドレス、パスワードは必須項目です");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "有効なメールアドレスを入力してください");
    }

    if (empty($errors)) {
        $check_email_stmt = $con->prepare("SELECT user_id FROM users WHERE email = ?");
        $check_email_stmt->bind_param("s", $email);
        $check_email_stmt->execute();
        $check_email_result = $check_email_stmt->get_result();
        $check_email_stmt->close();

        if ($check_email_result->num_rows > 0) {
            array_push($errors, "指定されたメールアドレスは既に使用されています");
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $now = date("Y-m-d H:i:s");

            $user_icon = null;

            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $user_icon = file_get_contents($_FILES['icon']['tmp_name']);
            } else {
                $default_icon_path = '../images/initial.jpg';
                $user_icon = file_get_contents($default_icon_path);
            }

            $insert_stmt = $con->prepare("INSERT INTO users (name, email, password, user_icon, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("ssssss", $name, $email, $hashedPassword, $user_icon, $now, $now);

            if ($insert_stmt->execute()) {
                // アカウントが作成された場合の処理
                header("Location: login.php");
                exit();
            } else {
                echo "<h2>アカウントの作成に失敗しました</h2>";
                echo "エラーメッセージ: " . $insert_stmt->error;
            }

            $insert_stmt->close();
        }
    } else {
        echo "<h2>入力エラーがあります:</h2>";
        foreach ($errors as $error) {
            echo "<p>{$error}</p>";
        }
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Devcrud">
    <title>アカウント作成</title>
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="shortcut icon" href="assets/imgs/title.PNG" type="image/x-icon">
</head>
<body>
    <div class="wrapper">
        <form action="signin.php" method="post" enctype="multipart/form-data">
            <h1>アカウント作成</h1>
            <!-- ユーザ名の入力追加 -->
            <div class="input-box">
                <input type="text" name="name" placeholder="ユーザ名" required>
            </div>
            <!-- 既存のメールアドレスとパスワードの入力フィールド -->
            <div class="input-box">
                <input type="email" name="email" placeholder="メールアドレス" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="パスワード" required>
            </div>
            <!-- アイコン画像のアップロードフィールド -->
            <div class="input-box">
                <input type="file" name="icon" accept="image/*">
            </div>
            <button type="submit" class="btn">登録</button>
            <div class="register-link">
                <?php if (!empty($errors)) : ?>
                    <p>エラーが発生しました。もう一度お試しください。</p>
                <?php endif; ?>
                <p>すでにアカウントを作成している場合は<a href="login.php">こちら</a></p>
            </div>
        </form>
    </div>
</body>
</html>
