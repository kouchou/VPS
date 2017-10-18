<?php
$dns = "mysql:dbname=bbs;host=localhost";
$username = "bbs";
$password = "root";

$dbh = new PDO($dns, $username, $password);

$is_submit = false;
$is_delete = false;
$delete_id = NULL;

if ($_POST["submit"] !== NULL) {
  $dbh->query("INSERT INTO tweets (tweet) VALUES ('".$_POST["tweet"]."')")->fetch();
  $is_submit = true;
}
if ($_POST["delete_id"] !== NULL) {
  $dbh->query("DELETE FROM tweets WHERE id = ".$_POST["delete_id"])->fetch();
  $is_delete = true;
  $delete_id = $_POST["delete_id"];
}

$tweet_list = $dbh->query("SELECT id, tweet, created_at FROM tweets ORDER BY id DESC LIMIT 12")->fetchAll(PDO::FETCH_ASSOC);

var_dump($_POST);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Tweets</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <style>
    input.tweet {
      height: 40px;
      width: 500px;
    }
    .new-tweet {
      margin: 20px auto;
      padding: 30px;
      width: 500px;
      border: 2px solid #ccc;
    }
  </style>
</head>
<body>
  <div class="container">
  <?php if ($is_submit) : ?>
    <div class="alert alert-success" role="alert">ツイートを送信しました</div>
  <?php endif; ?>
  <?php if ($is_delete) : ?>
    <div class="alert alert-info" role="alert">ツイートを削除しました</div>
  <?php endif; ?>
  </div>
  <div class="new-tweet">
    <form action="" method="post" class="form-inline">
      <div class="form-group">
      <input type="text" name="tweet" class="form-control tweet" placeholder="今どんな気分？">
      <input type="submit" name="submit" value="Tweet" class="btn btn-primary">
      </div>
    </form>
  </div>
  <div class="container">
  <table class="table table-striped">
    <tr>
      <th>ツイート</th>
      <th>投稿日時</th>
      <th>削除</th>
    </tr>
    <?php foreach ($tweet_list as $tweet) : ?>
    <tr>
      <td><?= $tweet["tweet"]; ?></td>
      <td> ( <?= strftime("%m/%d %H:%M", strtotime($tweet["created_at"])); ?> ) </td>
      <td>
        <form action="" method="post">
          <button type="submit" name="delete_id" value="<?= $tweet["id"]; ?>" class="btn btn-arart">削除</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  </div>
</body>
</html>