<?php
require_once './POST/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Devcrud">
    <title>ログイン</title>
	<link rel="stylesheet" href="css/signin.css">
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
    </form>

            <div class = "remember-forget">
                <label><input type="checkbox">覚えておく</label>
                <a href="#">パスワード忘れた方</a>
            </div>
            <button type="submit" class="btn">ログイン</button>

            <div class="register-link">
                <p>アカウントを持ってない方 <a href="signin.php">こちら</a></p>
            </div>
            
        </form>
        <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // パスワードのハッシュ化
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // データベースへの接続
    $con = new mysqli("localhost", "root", "", "users");

    // 接続エラーの確認
    if ($con->connect_error) {
        die("Failed to connect: ".$con->connect_error);
    } else {
        // プリペアドステートメントの作成
        $stmt = $con->prepare("INSERT INTO registration (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);

        // プリペアドステートメントの実行
        if ($stmt->execute()) {
            echo "<h2>アカウントが作成されました。</h2>";
        } else {
            echo "<h2>アカウントの作成に失敗しました。</h2>";
        }

        // ステートメントを閉じる
        $stmt->close();

        // 接続を閉じる
        $con->close();
    }
}
?>


    </div>
    
</body>
</body>
</html>
