<?php
$up_file = "";
$up_ok = false;
$tmp_file = isset($_FILES["up"]["tmp_name"]) ? $_FILES["up"]["tmp_name"] : "";
$org_file = isset($_FILES["up"]["name"])     ? $_FILES["up"]["name"]     : "";
if($tmp_file != "" &&
    is_uploaded_file($tmp_file))
{
    $split = explode(".", $org_file); $ext = end($split);
    if( $ext != "" &&
        $ext != $org_file)
    {
    $up_file = "img/". date("Ymd_His.") . mt_rand(1000,9999). ".$ext";
    $up_ok = move_uploaded_file($tmp_file, $up_file);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post</title>
</head>
<body>
    <p><?php if( $up_ok ){ ?>
    <img src="<?= $up_file ?>">
    <?php }else{ ?>
    アップロードは失敗しました。
    <?php } ?></p>
    </p>
</body>
</html>