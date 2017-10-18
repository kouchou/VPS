<?php
// connect database
$dns = "mysql:dbname=bbs;host=localhost";
$username = "bbs";
$password = "root";

$dbh = new PDO($dns, $username, $password);

// insert database & validation
$is_empty = false;
$is_success = false;
if ($_POST["submit"] !== null) {
  if ($_POST["sex"] !== null) {
    $dbh->query("
      INSERT INTO enquete1 (sex) VALUES ('".$_POST["sex"]."')
    ")->fetch();
    $is_success = true;
  } else {
    $is_empty = true;
  }
}

// select database
$enquete_result = $dbh->query("
  SELECT COUNT(sex = 0 OR NULL), COUNT(sex = 1 OR NULL) FROM enquete1
")->fetchALL(PDO::FETCH_ASSOC);

// calculation
$male = $enquete_result[0]["COUNT(sex = 0 OR NULL)"];
$female = $enquete_result[0]["COUNT(sex = 1 OR NULL)"];
if ($male === "0" && $female === "0") {
  $male = 0;
  $femase = 0;
} elseif ($male === "0") {
  $female = 100;
} elseif ($female === "0") {
  $male = 100;
} else {
  $all = $male + $female;
  $male = round($male / $all * 100); // round関数で四捨五入
  $female = 100 - $male;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="stylesheet" href="reset.css">
  <style>
/*     * { border: 1px solid green; } */
    .wrapper {
      margin: 0 auto;
      padding: 20px;
      min-width: 680px;
      width: 680px;
    }
    h1 {
      margin: 30px 0;
      font-size: 24px;
    }
    p {
      margin-bottom: 20px;
    }
    /* enquete area */
    .enquete {
      margin: 0 auto;
      padding: 35px 25px;
      box-sizing: border-box;
      width: 600px;
      border: 2px solid #f0f0f0;
    }
    label, .submit {
      display: inline-block;
    }
    label {
      margin-left: 20px;
      text-align: left;
      line-height: 30px;
    }
    .submit {
      margin-left: 300px;
      text-align: right;
    }
    .empty {
      color: #cf5757;
      font-weight: bold;
    }
    .success {
      color: #5399b3;
      font-weight: bold;
    }
    /* show result button */
    .show-result {
      display: block;
      margin: 50px auto;
      width: 300px;
      height: 34px;
      background-color: white;
      border: 2px solid #f0f0f0;
      outline: none;
      box-shadow: none;
    }
    .show-result:hover {
      border-color: #ccc;
    }
    .show-result:active {
      background-color: #3282f2;
      border-color: #3283f2;
    }
    /* result area */
    .result {
      display: flex;
      margin: 0 auto;
      width: 604px;
      height: 264px;
      box-sizing: border-box;
      border: 2px solid #f0f0f0;
    }
    .result-header {
      width: 300px;
      height: 60px;
      text-align: center;
      line-height: 60px;
      font-size: 26px;
      color: #555;
      border-bottom: 1px solid #f0f0f0;
    }
    .result-main {
      width: 300px;
      height: 200px;
      text-align: center;
      line-height: 200px;
      font-size: 80px;
      color: #666;
    }
    .result-header:first-child {
      border-right: 1px solid #f0f0f0;
    }
    .result-main:last-child {  /* なぜかfirst-childがきかない */
      border-left: 1px solid #f0f0f0;
    }
    

  </style>
</head>
<body>
  <div class="wrapper">
    <h1>アンケート</h1>
    <p>以下のアンケートにご協力ください。</p>
    <form action="" method="post" class="enquete">
      <p>
        ・性別を選択してください。
        <?php if ($is_empty) : ?>
          <span class="empty">失敗（必ずどちらかを選択してください）</span>
        <?php elseif ($is_success) : ?>
          <span class="success">投票ありがとうございます。</span>
        <?php endif; ?>
      </p>
      <label>
        <input type="radio" name="sex" value="0" checked="checked">
        男性
      </label>
      <label>
        <input type="radio" name="sex" value="1">
        女性
      </label>
      <input type="submit" name="submit" value="投票" class="submit">
    </form>
    <form action="" method="post">
      <button type="submit" name="show_result" value="" class="show-result">結果を表示</button>
    </form>
    <?php if ($_POST["show_result"] !== null) : ?>
    <div class="result">
      <header class="result-header">
        男性
      </header>
      <header class="result-header">
        女性
      </header>
      <div class="result-main">
        <?= $male ?>%
      </div>
      <div class="result-main">
        <?= $female ?>%
      </div>
    </div>
    <?php endif; ?>
  </div>
</body>
</html>