<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/titlelogo.png" type="image/x-icon">

    <title>きらくがき</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<?php include("./components/nav.php"); ?>
    <div class="container">
        <!--left sidebar-->
        <div class="left-sidebar">
            <div class="event-bar">
                <div class="eventbar-title">
                    <h4>エベント</h4>
                    <a href="#">See All</a>
                </div>
                <div class="event">
                    <div class="left-event">
                        <h3>18日(水)</h3>
                        <span>12月</span>
                    </div>
                    <div class="right-event">
                        <h4>今月タイプ</h4>
                        <p>白黒</p>
                        <a href="#">More Info</a>

                    </div>

                </div>
            </div>

            <div class="imp-links">
                <a href="#"><img src="images/new.png" alt="">新作品</a>
                <a href="#"><img src="images/famous.png" alt="">大人気</a>
                <a href="#"><img src="images/follow.png" alt="">フォロー中</a>
                <a href="#"><img src="images/save.png" alt="">保存</a>
                <a href="#">See More</a>

            </div>
            <div class="shortcut-links">
                <p>作品のタイプ</p>
                <a href="#"><img src="images/type1.png" alt="">aaaaa</a>
                <a href="#"><img src="images/type2.png" alt="">bbbbb</a>
                <a href="#"><img src="images/type3.png" alt="">cccc</a>

            </div>
        </div>


        <!--main content-->
        <div class="main-content">
            <div class="write-post-container">
                <div class="user-profile">
                    <img src="images/profile..jpg">
                    <div>
                        <p>株式会社烈丸</p>
                    </div>
                </div>

                <div class="post-input-container">
                    <textarea rows="3" placeholder="今日何を描いたの? 株式会社烈丸"></textarea>
                    <div class="add-post-links">
                        <a href="#"><img src="images/logo.png" alt="">落書き</a>
                    </div>
                </div>
            </div>

            <div class="post-container">
                <div class="left-post-contents">
                    <div class="user-profile">
                        <img src="images/cat-01.jpg">
                        <div>
                            <p>猫</p>
                        </div>
                    </div>
                </div>
                <p class="post-text">初めてのきらくがきです。<a href="#">#新タイプ</a> </p>
                <img src="images/cat-02.jpg" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/saw.png">1234</div>
                        <div><img src="images/fire.png">999</div>
                    </div>
                </div>
            </div>

            <div class="post-container">
                <div class="left-post-contents">
                    <div class="user-profile">
                        <img src="images/dog-01.jpg">
                        <div>
                            <p>犬のお回り</p>
                        </div>
                    </div>
                </div>
                <p class="post-text">初めてのきらくがきです。<a href="#">#新タイプ</a> </p>
                <img src="images/dog-02.jpg" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/saw.png">1234</div>
                        <div><img src="images/fire.png">999</div>
                    </div>
                </div>
            </div>

            <div class="post-container">
                <div class="left-post-contents">
                    <div class="user-profile">
                        <img src="images/profile..jpg">
                        <div>
                            <p>株式会社烈丸</p>
                        </div>
                    </div>
                </div>
                <p class="post-text">初めてのきらくがきです。<a href="#">#新タイプ</a> </p>
                <img src="images/backgroundpic.jpg" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/saw.png">1234</div>
                        <div><img src="images/fire.png">999</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>]
    
</body>
</html>