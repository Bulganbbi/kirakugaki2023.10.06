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
    <script src="https://kit.fontawesome.com/f6d918b6d6.js" crossorigin="anonymous"></script></head>

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
        <div class="help-content">
            <div class="help-post-container">
                <div>
                    <h3>ヘルプ</h3>
                </div>
                <section>
        <h2>よくある質問</h2>
        <p>以下はよくある質問のリストです：</p>
        <div class="dropdown">
            <div class="question">
                <a>質問1: どうやってアカウントを作成しますか？</a><i class="fa-solid fa-caret-down" style="color: #4c4e52;"></i>
                <div class="answer">
                    <p>sdfghjklcvbgnhmxcdvfbg</p>
                </div>
            </div>
            <div class="question">
                <a>質問2: パスワードをリセットするには？</a><i class="fa-solid fa-caret-down" style="color: #4c4e52;"></i>
                <div class="answer">
                    <p>dfghjgfdfghnjmhgfdghjhgf</p>
                </div>
            </div>
            <div class="question">
                <a>質問3: お問い合わせ先は？</a><i class="fa-solid fa-caret-down" style="color: #4c4e52;"></i>
                <div class="answer">
                    <p>dfbghnjmgfcdscdfghjkjhgfdfghjmk,l</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        const questions = document.querySelectorAll('.question');

        questions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.querySelector('.answer');
                if (answer.style.display === 'block') {
                    answer.style.display = 'none';
                } else {
                    answer.style.display = 'block';
                }
            });
        });
    </script>            
            <div class="contract">

            </div>
                <hr>
                <section>
                    <h2>お問い合わせ</h2>
                    <p>ご質問やお困りのことがあれば、<a href="email.php">お問い合わせページ</a>でご連絡いただけます。</p>
                </section>                
            </div>
        </div>
        
                
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>]
    
</body>

</html>