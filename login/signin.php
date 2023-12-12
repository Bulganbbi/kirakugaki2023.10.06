<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../POST/functions.php';

$con = new mysqli("localhost", "kirakugaki", "", "kirakugaki");

$croppedImage = null;

session_start();
session_regenerate_id(true);

if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
}

$name = $email = $password = "";
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if (empty($name) || empty($email) || empty($password)) {
        array_push($errors, "ユーザ名、メールアドレス、パスワードは必須項目です");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "有効なメールアドレスを入力してください");
    }

    if (empty($errors)) {
        $check_email_stmt = $con->prepare("SELECT user_id FROM users WHERE email = ?");
        $check_email_stmt->bind_param("s", $email);
        $check_email_stmt->execute();
        $check_email_result = $check_email_stmt->get_result();
        $check_email_stmt->close();

        if ($check_email_result->num_rows > 0) {
            array_push($errors, "指定されたメールアドレスは既に使用されています");
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $now = date("Y-m-d H:i:s");

            $user_icon = null;

            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $tempFilePath = $_FILES['icon']['tmp_name'];
            
                $image_info = getimagesize($tempFilePath);
                $allowed_mime_types = ['image/jpeg', 'image/png'];
            
                if (!in_array($image_info['mime'], $allowed_mime_types)) {
                    die("JPEGまたはPNG形式の画像を選択してください");
                }
            
                $file_extension = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
                $outputFilePath = $_SERVER['DOCUMENT_ROOT'] . '/-main2222/kirakugaki2023.10.06/processed_image/user_icon_' . uniqid() . '.' . $file_extension;
                
                if ($croppedImage !== null) {
                    // 画像形式によって保存処理を変更
                    switch ($file_extension) {
                        case 'jpeg':
                        case 'jpg':
                            if (imagejpeg($croppedImage, $outputFilePath)) {
                                // 保存成功の場合の処理
                            } else {
                                die("画像の保存に失敗しました");
                            }
                            break;
                        case 'png':
                            if (imagepng($croppedImage, $outputFilePath)) {
                                // 保存成功の場合の処理
                            } else {
                                die("画像の保存に失敗しました");
                            }
                            break;
                        default:
                            die("サポートされていない画像形式です");
                    }
                } else {
                    die("クロップされた画像が存在しません");
                }
                
            
                $croppedImage = imagecrop($image, ['x' => 0, 'y' => 0, 'width' => 100, 'height' => 100]);
                ob_start();
            
                // 画像形式によって保存処理を変更
                switch ($file_extension) {
                    case 'jpeg':
                    case 'jpg':
                        imagejpeg($croppedImage, $outputFilePath);
                        break;
                    case 'png':
                        imagepng($croppedImage, $outputFilePath);
                        break;
                    default:
                        die("サポートされていない画像形式です");
                }
            
                $user_icon = ob_get_clean();
            
                imagedestroy($image);
                imagedestroy($croppedImage);
            } else {
                $default_icon_path = '../images/initial.jpg';
                $user_icon = file_get_contents($default_icon_path);
            }

            // 保存先のファイルパスをデータベースに保存
            $insert_stmt = $con->prepare("INSERT INTO users (name, email, password, user_icon, created_at, updated_at, user_icon_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssssss", $name, $email, $hashedPassword, $user_icon, $now, $now, $file_extension);

            if ($insert_stmt->execute()) {
                // アカウントが作成された場合の処理
                header("Location: login.php");
                exit();
            } else {
                echo "<h2>アカウントの作成に失敗しました</h2>";
                echo "エラーメッセージ: " . $insert_stmt->error;
            }

            $insert_stmt->close();
        }
    } else {
        echo "<h2>入力エラーがあります:</h2>";
        foreach ($errors as $error) {
            echo "<p>{$error}</p>";
        }
    }
}

$con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Devcrud">
    <title>アカウント作成</title>
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="shortcut icon" href="assets/imgs/title.PNG" type="image/x-icon">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css'>
    <!-- CroppieのファイルをCDN経由で読み込む -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    
    <style>
        .wrapper {
            text-align: center;
        }

        #imagePreview {
            max-width: 150px;
            max-height: 150px;
            margin: 10px auto;
            display: block;
        }

        #croppieContainer {
            margin: 10px auto;
        }
    </style>

    <script>
        function initCroppie() {
            var image = document.getElementById('imagePreview');
            var croppieContainer = document.getElementById('croppieContainer');
            var croppedImage = document.getElementById('croppedImage');
            
            var croppie = new Croppie(croppieContainer, {
                viewport: { width: 100, height: 100, type: 'circle' },
                boundary: { width: 150, height: 150 }
            });

            function handleImageSelect(event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        // 画像の読み込みが完了したらCroppieにセット
                        croppie.bind({
                            url: e.target.result
                        });

                        // Croppieの表示
                        if (image) {
                            image.style.display = 'none';
                        }
                        if (croppieContainer) {
                            croppieContainer.style.display = 'block';
                        }
                        if (croppedImage) {
                            croppedImage.style.display = 'none';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            }

            document.getElementById('uploadBtn').addEventListener('change', handleImageSelect);

            document.getElementById('cropBtn').addEventListener('click', function () {
                croppie.result({
                    type: 'base64',
                    size: { width: 100, height: 100 }
                }).then(function (base64) {
                    // 画像を表示する要素が存在するか確認
                    if (croppedImage) {
                        croppedImage.src = base64;
                        if (image) {
                            image.style.display = 'none';
                        }
                        if (croppieContainer) {
                            croppieContainer.style.display = 'none';
                        }
                        if (croppedImage) {
                            croppedImage.style.display = 'block';
                        }
                    }
                });
            });
        }
    </script>
</head>
<body onload="initCroppie()">
    <div class="wrapper">
        <form action="signin.php" method="post" enctype="multipart/form-data">
            <h1>アカウント作成</h1>
            <div class="input-box">
                <input type="text" name="name" placeholder="ユーザ名" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="メールアドレス" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="パスワード" required>
            </div>
            <div class="input-box">
                <input type="file" name="icon" id="uploadBtn" accept="image/*">
                <label for="uploadBtn"><i class="fa-solid fa-upload"></i>プロフィール写真選択</label>
            </div>
            <div id="croppieContainer"></div>
            <img id="user_icon" alt="プレビュー">
            <button type="button" id="cropBtn">切り取る</button>
            <button type="submit" class="btn">登録</button>
            <div class="register-link">
                <?php if (!empty($errors)) : ?>
                    <p>エラーが発生しました。もう一度お試しください。</p>
                <?php endif; ?>
                <p>すでにアカウントを作成している場合は<a href="login.php">こちら</a></p>
            </div>
        </form>
    </div>
</body>
</html>
