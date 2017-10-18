<?php

// 接続情報の設定
$dns = "mysql:dbname=bbs;host=localhost";
$username = "bbs";
$password = "root";

// 接続
$dbh = "宣言";
try {
  $dbh = new PDO($dns, $username, $password);
//  echo "接続に成功したよ！";
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}

$is_liked = $dbh->query("SELECT * FROM likes")->fetch();

var_dump($_POST);
if ($_POST["like"] !== NULL) {
  if ($is_liked === false) {
    $stmt = $dbh->query("INSERT INTO likes (is_liked) VALUES (1)");
    $stmt->fetch();
//    var_dump($stmt);
  } else {
    $stmt = $dbh->query("DELETE FROM likes");
    $stmt->fetch();
//    var_dump($stmt);
  }
}

$result = $dbh->query("SELECT * FROM likes")->fetch();
//var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<style>
  h1 {
    padding-bottom: 10px;
    border-bottom: 1px dashed #333;
  }
</style>
<body class="container">
  <form action="" method="post">
    <input type="checkbox" name="name1" value="value1">
    <input type="checkbox" name="name2" value="value2">
    <input type="submit" name="submit1" value="submit1">
  </form>
  
  <h1>いいね！画面</h1>
  
  <div class="row">
    <div class="col-md-1"></div>
    <div class="well text-center col-md-10">
      <form action="" method="post">
      	<input type="submit" value="いいね！" name="like" class="btn btn-warning btn-lg">
      </form>
      <?php if ($result === false) : ?>
        <div class="label label-default">いいねしてません</div>
      <?php else : ?>
        <div class="label label-info">いいねしました</div>
      <?php endif; ?>
    </div>
    <div class="col-md-1"></div>
  </div>
</html>