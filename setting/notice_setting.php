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
    <?php include("../components/setting.php"); ?>
    <div class="settingcontent">
        <!-- 通知設定 -->
            <ul>
                <li>
                    <p>お知らせ通知</p>
                    <input type="radio" name="q1" value="はい">表示する
                    <input type="radio" name="q1" value="いいえ">表示しない
                </li>
                <li>
                    <p>新着おすすめ通知</p>
                    <input type="radio" name="q1" value="はい">表示する
                    <input type="radio" name="q1" value="いいえ">表示しない
                </li>
                <li>
                    <p>他ユーザによるコメント通知</p>
                    <input type="radio" name="q1" value="はい">表示する
                    <input type="radio" name="q1" value="いいえ">表示しない
                </li>
            </ul> 
        </div>

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>    
    