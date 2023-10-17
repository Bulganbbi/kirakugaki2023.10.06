<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
    <link rel="shortcut icon" href="images/title.PNG" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include("./components/nav.php"); ?>
    <header>
        <h1>あなたの名前</h1>
        <p>職業/役職</p>
    </header>

    <nav>
        <ul>
            <li><a href="#about">自己紹介</a></li>
            <li><a href="#skills">スキル</a></li>
            <li><a href="#contact">お問い合わせ</a></li>
        </ul>
    </nav>

    <section id="about">
        <h2>自己紹介</h2>
        <p>ここに自己紹介を記入します。</p>
    </section>

    <section id="skills">
        <h2>スキル</h2>
        <ul>
            <li>スキル1</li>
            <li>スキル2</li>
            <li>スキル3</li>
        </ul>
    </section>

    <section id="contact">
        <h2>お問い合わせ</h2>
        <p>お問い合わせ情報をここに記入します。</p>
    </section>
    

    <footer>
        <p>&copy; 2023 あなたの名前</p>
    </footer>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>]
</body>
</html>