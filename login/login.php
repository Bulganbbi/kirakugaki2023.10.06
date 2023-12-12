<?php
require_once '../POST/functions.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $con = new mysqli("localhost", "kirakugaki", "", "kirakugaki");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    }

    $stmt = $con->prepare("SELECT user_id, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: (" . $con->errno . ") " . $con->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    if ($stmt->error) {
        die("Query error: " . $stmt->error);
    }

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['user_id'] = $user_id;
            header("Location: ../main.php");
            exit();
        } else {
            echo "<h2>パスワードが間違っています。</h2>";
        }

    } else {
        echo "<h2>メールアドレスが見つかりません。</h2>";
    }

    $stmt->close();
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
