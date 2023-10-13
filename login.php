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
        <form action="index.php" method="post">
            <h1>ログイン</h1>
            <div class="input-box">
                <input type="email" placeholder="ユーザ名" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="パスワード" required>
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
</body>
</html>