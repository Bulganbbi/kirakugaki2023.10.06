<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>らくがき投稿</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="./images/title.PNG" type="image/x-icon">
    <link rel="stylesheet" href="../css/main.css">

</head>
<body>
<?php include("../components/setting_nav.php"); ?>
<div class="title">
    <h2>らくがき投稿</h2>
</div>
<!-- 画像選択 -->
<div class="Work">
    <form method="post" enctype="multipart/form-data" action="image_up.php">
        <input type="file" name="up">
        <input type="submit"value="アップロード">
    </form>
</div>
<div class="item">
    <ul>
        <li><input type="text" name="title" placeholder="作品名"></li>
        <li><input type="text" name="details" placeholder="作品紹介"></li>
    </ul>
</div>
</body>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>]
</html>