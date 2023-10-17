<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
    <link rel="shortcut icon" href="images/title.PNG" type="image/x-icon">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Bootstrap 5 logo" class="d-inline-block align-top" width="56" height="56"></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Notification</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                          ユーザ
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li>
                            <a class="dropdown-item" href="#"><img src="images/userpic.png" class="settings-icons">ユーザ</a>
                        </li>
                          <li>
                            <a class="dropdown-item" href="#"><img src="images/usersetting.png" class="settings-icons">個人情報</a>
                        </li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                            <a class="dropdown-item" href="help.php">
                                <img src="images/help.png" class="settings-icons">ヘルプ</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="login.php"><img src="images/logout.png" class="settings-icons">ログアウト</a>
                        </li>
                        </ul>
                      </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="検索。。。" aria-label="Search">
                    <button><img src="images/search.png" alt=""></button>
                </form>
            </div>
        </div>
    </nav>
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

</body>
</html>