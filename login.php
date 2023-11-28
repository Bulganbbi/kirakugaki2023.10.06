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
                <input type="email" placeholder="メールアドレス" required>
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
        <?php
        // PHP
            $email = $_POST['email'];
            $password = $_POST['password'];

            $con = new mysqli("localhost", "root", "", "kirakugaki_users");
            if($con->connect_error){
                die("Failed to connect: ".$con->connect_error);
            } else{
                $stmt = $con->prepare("select * from registration where email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt_result = $stmt->get_result();
                if($stmt_result->num_rows > 0){
                    $data = $stmt_result->fetch_assoc();
                }
                    else{
                        echo "<h2>メールとパスワとド正しく入力してください！</h2>";
                    }
                }
        ?>

    </div>
    
</body>
</body>
</html>
