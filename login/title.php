<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    header("Location: ./main.phpc "); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Devcrud">
    <title>きらくがき</title>
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="shortcut icon" href="assets/imgs/title.PNG" type="image/x-icon">

</head>
<body>
    <div class="title-word">
        <form action="" method="post"> <!-- action属性を空にして同じページにポストする -->
            <h1>きらくがきへようこそ</h1>
            <button type="submit" class="btn" name="submit">ログインして始める</button>
        </form>
    </div>
</body>
</body>
</html>