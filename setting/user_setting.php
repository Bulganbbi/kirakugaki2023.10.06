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
        <!-- ユーザー設定項目 -->
        <div class="settingcontent">
            <ul>
                <li>
                    <a href="">ユーザーネーム変更</a>   <!-- プロフィールに飛ばす -->
                </li>
                <li>
                    <a href="">プロフィール画像変更</a>  <!-- プロフィールに飛ばす -->
                </li>
                <li>
                    <p>閲覧制限(R18)</p>
                    <input type="radio" name="q1" value="はい">表示する
                    <input type="radio" name="q1" value="いいえ">表示しない

                </li>
            </ul> 
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>    
    