<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Devcrud">
    <title>サインイン</title>
	<link rel="stylesheet" href="css/signin.css">
    <link rel="shortcut icon" href="assets/imgs/title.PNG" type="image/x-icon">

</head>
<body>
    <div class="wrapper">
        <?php
        if(isset($_POST["submit"])){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            if(empty($name) OR empty($email) OR empty($password)){
                array_push($errors, "メールまたはパスワ－ド正しく入力してください");
            }
        }
        ?>
        <form action="index.php" method="post">
            <h1>サインイン</h1>
            <div class="input-box">
                <input type="text" name="name" class="form-control" placeholder="ユーザ名" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" class="form-control" placeholder="メールアドレス" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="form-control"  placeholder="パスワード" required>
            </div>
            <div class="input-box">
                <input type="password" name="cofirm_password" class="form-control"  placeholder="パスワード" required>
            </div>
            <div class = "remember-forget">
                <label><input type="checkbox">覚えておく</label>
            </div>
            <button type="submit" name="register_btn" class="btn">サインイン</button>

            <div class="register-link">
                <p>アカウントを持っている <a href="login.php">こちら</a></p>
            </div>
            
        </form>
    </div>
    
</body>
</body>
</html>
