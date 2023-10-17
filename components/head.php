<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><img src="../images/logo.png" alt="Bootstrap 5 logo" class="d-inline-block align-top" width="56" height="56"></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">通知</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" >ユーザー</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li>
                            <a class="dropdown-item" href="#"><img src="../images/userpic.png" class="settings-icons">ユーザ</a>
                        </li>
                          <li>
                            <a class="dropdown-item" href="#"><img src="../images/usersetting.png" class="settings-icons">個人情報</a>
                        </li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                            <a class="dropdown-item" href="#">
                                <img src="../images/help.png" class="settings-icons">ヘルプ</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../login.php"><img src="../images/logout.png" class="settings-icons">ログアウト</a>
                        </li>
                        </ul>
                      </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="検索" aria-label="Search">
                    <button><img src="../images/検索アイコン.png" height="20" width="20"></button>
                </form>
            </div>
        </div>
    </nav>