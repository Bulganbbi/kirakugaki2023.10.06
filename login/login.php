<?php
require_once '../POST/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // データベースへの接続
    $con = new mysqli("localhost", "kirakugaki", "", "kirakugaki");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

    // プリペアドステートメントの作成
    $stmt = $con->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // パスワードの照合
        if (password_verify($password, $hashed_password)) {
            // ログイン成功時の処理（セッションの設定など）
            session_start();
            $_SESSION['user_id'] = $user_id;

            // ./index.php にリダイレクト
            header("Location: ../index.php");
            exit();
        } else {
            echo "<h2>パスワードが間違っています。</h2>";
        }
    } else {
        echo "<h2>メールアドレスが見つかりません。</h2>";
    }

    // ステートメントを閉じる
    $stmt->close();

    // 接続を閉じる
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Devcrud">
    <title>ログイン</title>
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="shortcut icon" href="assets/imgs/title.PNG" type="image/x-icon">
</head>
<body>
    <div class="wrapper">
        <form action="login.php" method="post">
            <h1>ログイン</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="メールアドレス" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="パスワード" required>
            </div>
            <div class="remember-forget">
                <label><input type="checkbox">覚えておく</label>
                <a href="#">パスワード忘れた方</a>
            </div>
            <button type="submit" class="btn">ログイン</button>
            <div class="register-link">
                <p>アカウントを持ってない方 <a href="signin.php">こちら</a></p>
            </div>
        </form>
    </div>
</body>
</html>
