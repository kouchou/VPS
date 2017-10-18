<?php
$dns = "mysql:dbname=bbs;host=localhost";
$username = "bbs";
$password = "root";

$dbh = new PDO($dns, $username, $password);

var_dump($_POST);
var_dump($_GET);

if ($_POST["name"] === "") { echo "nameのなか空だよ"; }

$profiles = $dbh->query("SELECT * FROM profiles")->fetchALL(PDO::FETCH_ASSOC);
// var_dump($profiles);

if ($_POST["submit"] !== NULL) {
  $dbh->query("
    INSERT INTO profiles (name, rubi, sex, age, like_food, dislike_food, note)
    VALUES (
      '".$_POST["name"]."',
      '".$_POST["rubi"]."',
      '".$_POST["sex"]."',
      '".$_POST["age"]."',
      '".$_POST["like"]."',
      '".$_POST["dislike"]."',
      '".$_POST["note"]."'
    )
  ")->fetch();
}

$search = NULL;
if ($_GET["q"] !== NULL) {
  $search = $dbh->query("SELECT * FROM profiles WHERE id = '".$_GET["q"]."' LIMIT 1")->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>プロフィール</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <style>
    .my-form {
      display: flex;
      flex-direction: column;
    }
    .my-radio {
      margin-left: 30px;
    }
    .my-submit {
      margin-top: 20px;
    }
    .my-hr {
      margin: 40 0;
      border: 3px solid #ccc;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <?php if ($is_empty === 1) : ?>
      <div class="alert alert-danger" role="alert">必要な項目が入力されていません</div>
      <?php endif; ?>
    </div>
    <div class="row"></div>
    <div class="col-md-2"></div>
    <form action="" method="post" class="form-group my-form col-md-6">
      <label>
        氏名
        <input type="text" name="name" class="form-control" required>
      </label>
      <label>
        フリガナ
        <input type="text" name="rubi" class="form-control" required>
      </label>
      <label class="radio disabled my-radio">
        <input type="radio" name="sex" value="1" checked="checked">
        男性
      </label>
      <label class="radio disabled my-radio">
        <input type="radio" name="sex" value="2">
        女性
      </label>
      <label class="radio disabled my-radio">
        <input type="radio" name="sex" value="3">
        その他
      </label>
      <label>
        年齢
        <input type="number" name="age" class="form-control" required>
      </label>
      <label>
        好きな食べ物
        <input type="text" name="like" class="form-control">
      </label>
      <label>
        嫌いな食べ物
        <input type="text" name="dislike" class="form-control">
      </label>
      <label> 
        備考
        <textarea name="note" class="form-control" row="3"></textarea>
      </label>
      <input type="submit" name="submit" value="送信" class="btn btn-default my-submit">
    </form>
    <div class="col-md-2"></div>
    </div>
  </div>
  
  <hr class="my-hr">
  
  <div class="container">
    <p>ユーザーidを指定してください</p>
    <div class="row">
      <form action="" method="get">
        <input type="number" name="q" min="1" max="999">
        <input type="submit" value="検索" class="btn btn-default">
      </form>
    </div>
    <?php if ($search !== NULL) : ?>
    <h3>検索結果</h3>
    ユーザID : <?= $search["id"]; ?>  ユーザ名 : <?= $search["name"]; ?>
    <?php else : ?>
    <p>検索結果はありません</p>
    <?php endif; ?>
  </div>
  <hr class="my-hr">
  
  <?php if ($profiles !== false) : ?>
  <div class="container">
    <?php foreach ($profiles as $profile) : ?>
    <div class="row">
    <div class="col-md-4 col-md-offset-2">
      ユーザーID : <?= $profile["id"]; ?><br>
      氏名 : <?= $profile["name"]; ?>
    </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</body>
</html>