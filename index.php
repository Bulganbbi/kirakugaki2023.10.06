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
    <link rel="shortcut icon" href="./images/title.PNG" type="image/x-icon">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<?php include("./components/nav.php"); ?>
    <?php include("./components/aside.php"); ?>
        <!--main content-->
        <div class="main-content">
            <div class="write-post-container d-grid gap-2">
                <a href="./POST/list.php" class="btn btn-primary btn-lg">らくがき投稿</a>
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
                        <button id="likeButton" class="like-button not-liked"></button>  
                        <span id = "likeCount">0</span>
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
                        <button id="likeButton" class="like-button not-liked"></button>  
                        <span id = "likeCount">0</span>
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
                        <button id="likeButton" class="like-button not-liked"></button>  
                        <span id = "likeCount">0</span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>]
</html>