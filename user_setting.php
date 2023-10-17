<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設定変更</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="./images/title.PNG" type="image/x-icon">
    <link rel="stylesheet" href="./css/main.css">

</head>
<body>
    <?php include("./components/nav.php"); ?>

    <div class="setting">
        <div class="title">
        <h1>設定</h1>
            <div class="sub-title">
                <h2>ユーザー設定</h2>
            </div>
            <img src="./images/profile..jpg" width="100" height="100">
                <div class="Various">
                    <ul>
                        <li>
                            <a href="./setting/user_setting.php">ユーザー設定</a>
                        </li>
                        <li>
                            <a href="./setting/notice_setting.php">通知設定</a>
                        </li>
                        <li>
                            <a href="./setting/message_setting.php">メッセージ設定</a>
                        </li>
                    </ul>
                </div> 
        </div>
    </div>
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
    