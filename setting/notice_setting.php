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
    <style>
    input[type=radio] {
    display: none;
    }
    input[type="radio"]:checked + label {
    background: #851acd;/* マウス選択時の背景色を指定する */
    color: #ffffff; /* マウス選択時のフォント色を指定する */
    }
    .label:hover {
        background-color: #ddddff; /* マウスオーバー時の背景色を指定する */
    }
    .label {
    float: center; 
    margin: 5px; 
    width: 100px; /* ボックスの横幅を指定する */
    height: 28px; /* ボックスの高さを指定する */
    padding-left: 5px; /* ボックス内左側の余白を指定する */
    padding-right: 5px; /* ボックス内御右側の余白を指定する */
    color: black; /* フォントの色を指定 */
    text-align: center; /* テキストのセンタリングを指定する */
    line-height:25px; /* 行の高さを指定する */
    cursor: pointer; /* マウスカーソルの形（リンクカーソル）を指定する */
    border: 1px solid black;/* ボックスの境界線を実線で指定する */
    border-radius: 5px; /* 角丸を指定する */
    }
    </style>
</head>
<body>
<?php include("../components/setting_nav.php"); ?>
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
    