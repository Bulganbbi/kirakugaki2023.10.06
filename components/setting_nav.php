<!-- navタグ（ヘッダー） -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../main.php"><img src="../images/title.PNG" alt="Bootstrap 5 logo" class="d-inline-block align-top" width="90" height="56"></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" >ユーザー</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li>
                            <a class="dropdown-item" href="../profile.php"><img src="../images/userpic.png" class="settings-icons">ユーザ</a>
                        </li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                            <a class="dropdown-item" href="../help.php">
                                <img src="../images/help.png" class="settings-icons">ヘルプ</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../setting/user_setting.php"><img src="../images/setting.png" class="settings-icons">設定</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../login/login.php"><img src="../images/logout.png" class="settings-icons">ログアウト</a>
                        </li>
                        </ul>
                      </li>
                </ul>
            <!-- nav.php の検索フォーム -->
            <form class="d-flex" method="get" action="../search.php">
                <input class="form-control" type="search" name="keyword" placeholder="検索" aria-label="Search">
                <button type="submit"><img src="./images/検索アイコン.png" height="20" width="20"></button>
            </form>
            </div>
        </div>
    </nav>