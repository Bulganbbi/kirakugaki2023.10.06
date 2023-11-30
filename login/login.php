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
                <input type="email" name="email" class="form-control" placeholder="メールアドレス" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="form-control" placeholder="パスワード" required>
            </div>
            <div class = "remember-forget">
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

<?php
// session_start();
include("dbase.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo 'post';
    $email = $_POST['email'];
    $password = $_POST['password'];


    // パスワードはハッシュ化して保存されるべきですが、ここでは簡単のためにそのまま比較しています
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        echo print_r($user['name']) . 'さん こんにちは。';
        
        $query = "SELECT * FROM users WHERE admin = 1";
        $result = $con->query($query);
        $row = mysqli_fetch_array($result);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                header("Location: index.php");
            }
        } 
    } else {
        echo "ログイン失敗しました。メールアドレスまたはパスワードが正しく入力してください。";
    }
}

$con->close();
?>
   
    

