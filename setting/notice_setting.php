<?php
require_once '../POST/functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設定変更</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/title.PNG" type="image/x-icon">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<?php include("../components/setting_nav.php"); ?>
<?php include("../components/footer.php"); ?>

    <?php include("../components/setting.php"); ?>
        <!-- 通知設定 -->
        <div class="setting-content">
            <div class="setting-post-container">
            
                <ul>
                <li>
                    <p>お知らせ通知</p>
                    <input type="radio" name="q1" value="1" id="see">
                            <label for="see" class="label">表示する</label>                            
                            <input type="radio" name="q1" value="2" id="nosee">
                            <label for="nosee" class="label">表示しない</label>  
                </li>
                <li>
                    <p>新着おすすめ通知</p>
                            <input type="radio" name="q2" value="1" id="see">
                            <label for="see" class="label">表示する</label>                            
                            <input type="radio" name="q2" value="2" id="nosee">
                            <label for="nosee" class="label">表示しない</label>  
                </li>
                </ul> 
            </div>
            <!-- 適用ボタン -->
            <div class="submit">
            <hr>
            <input type="submit" name="submit" class="btn_type01" value="適用"> 

        </div>

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>    
    