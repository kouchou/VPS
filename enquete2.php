<?php
// connect database
$dns = "mysql:dbname=bbs;host=localhost";
$username = "bbs";
$password = "root";

$dbh = new PDO($dns, $username, $password);

// pre treatment
$temp = [
  "vanilla" => 0,
  "green_tea" => 0,
  "strawberry" => 0,
  "macadamia_nuts" => 0,
  "cookie_cream" => 0,
  "rum_raisin" => 0,
  "coffee" => 0,
  "choco_browny" => 0,
  "rich_milk" => 0
];
$flavor_name = [
  "vanilla" => "バニラ",
  "green_tea" => "グリーンティー",
  "strawberry" => "ストロベリー",
  "macadamia_nuts" => "マカダミアナッツ",
  "cookie_cream" => "クッキー&クリーム",
  "rum_raisin" => "ラムレーズン",
  "coffee" => "コーヒー",
  "choco_browny" => "チョコレートブラウニー",
  "rich_milk" => "リッチミルク"
];
$rank = 1;

// insert database & validation
$is_empty = false;
$is_success = false;
$query = null;
if ($_POST["submit"] !== null) {
  if (count($_POST) <= 1) {
    $is_empty = true;
  } else {
    $input = $temp;
    foreach ($_POST as $key => $value) {
      $input[$key] = 1;
    }
    unset($value);
  $dbh->query("
    INSERT INTO enquete2 (
      vanilla,
      green_tea,
      strawberry,
      macadamia_nuts,
      cookie_cream,
      rum_raisin,
      coffee,
      choco_browny,
      rich_milk
    ) VALUES (
      {$input["vanilla"]},
      {$input["green_tea"]},
      {$input["strawberry"]},
      {$input["macadamia_nuts"]},
      {$input["cookie_cream"]},
      {$input["rum_raisin"]},
      {$input["coffee"]},
      {$input["choco_browny"]},
      {$input["rich_milk"]}
    );
  ")->fetch();
    $is_success = true;
  }
}

// select database and culcuration
$count = $temp;
if ($_POST["show_result"] !== null) {
  // select
  $enquete_result = $dbh->query("
   SELECT * FROM enquete2;
  ")->fetchALL(PDO::FETCH_ASSOC);
  // count
  foreach ($enquete_result as $record) {
    foreach ($record as $key => $value) {
      if ($count[$key] !== null) {
        $count[$key] = $count[$key] + $value;
      }
    }
  }
}
unset($record);
unset($value);
// sort
array_multisort($count, SORT_DESC, $count);
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
    .empty {
      color: #cf5757;
      font-weight: bold;
    }
    .success {
      color: #5399b3;
      font-weight: bold;
    }
    .submit, .show-result {
      display: block;
      margin: 0 auto;
      width: 300px;
      height: 34px;
      background-color: white;
      border: 2px solid #f0f0f0;
      outline: none;
      box-shadow: none;
    }
    .submit {
      margin-top: 30px;
    }
    /* show result button */
    .show-result {
      margin: 50px auto;
    }
    .show-result:hover, .submit:hover {
      border-color: #ccc;
    }
    .show-result:active, .submit:active {
      background-color: #3282f2;
      border-color: #3283f2;
    }
    /* result area */
    .result {
      display: flex;
      margin: 0 auto;
      padding: 20px 65px;
      width: 600px;
      box-sizing: border-box;
      border: 2px solid #f0f0f0;
    }
    .c-table {
      width: 100%;
    }
    .c-table__row-head {
      margin-bottom: 40px;
      height: 80px;
      line-height: 80px;
      border-bottom: 1px solid #f0f0f0;
    }
    .c-table__row-main {
      height: 30px;
      line-height: 30px;
    }
    .c-table__cell-head {
      
    }
    .c-table__cell-main {
      
    }
    .c-table__cell-head--label-flavor {
    
    }
    .c-table--left {
      text-align: left;
    }
    .c-table--center {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <h1>アンケート</h1>
    <p>以下のアンケートにご協力ください。</p>
    <form action="" method="post" class="enquete">
      <p>
        ・以下のうち、好きなハーゲンダッツのフレーバーを選んでください。<br>
        （複数可）
        <?php if ($is_empty) : ?>
          <span class="empty">失敗（最低一つは選択してください）</span>
        <?php elseif ($is_success) : ?>
          <span class="success">投票ありがとうございます。</span>
        <?php endif; ?>
      </p>
      <label>
        <input type="checkbox" name="vanilla" value="1">
        バニラ
      </label>
      <label>
        <input type="checkbox" name="green_tea" value="1">
        グリーンティー
      </label>
      <label>
        <input type="checkbox" name="strawberry" value="1">
        ストロベリー
      </label>
      <label>
        <input type="checkbox" name="macadamia_nuts" value="1">
        マカダミアナッツ
      </label>
      <label>
        <input type="checkbox" name="cookie_cream" value="1">
        クッキー＆クリーム
      </label>
      <label>
        <input type="checkbox" name="rum_raisin" value="1">
        ラムレーズン
      </label>
      <label>
        <input type="checkbox" name="coffee" value="1">
        コーヒー
      </label>
      <label>
        <input type="checkbox" name="choco_browny" value="1">
        チョコレートブラウニー
      </label>
      <label>
        <input type="checkbox" name="rich_milk" value="1">
        リッチミルク
      </label>
      <button type="submit" name="submit" value="0" class="submit">投票</button>
    </form>
    <form action="" method="post">
      <button type="submit" name="show_result" value="" class="show-result">結果を表示</button>
    </form>
    <?php if ($_POST["show_result"] !== null) : ?>
    <div class="result">
      <table class="c-table">
        <tr class="c-table__row-head">
          <th class="c-table__cell-head c-table--center">順位</th>
          <th class="c-table__cell-head c-table--left c-table__cell-head--label-flavor">フレーバー</th>
          <th class="c-table__cell-head c-table--center">得票数</th>
        </tr>
        <?php foreach ($count as $key => $value) : ?>
        <tr class="c-table__row-main">
          <td class="c-table__cell-main c-table--center"><?= $rank; ?>位</td>
          <td class="c-table__cell-main c-table--left"><?= $flavor_name[$key]; ?></td>
          <td class="c-table__cell-main c-table--center"><?= $value; ?></td>
        <tr>
        <?php $rank = $rank + 1; ?>
        <?php endforeach; ?>
      </table>
    </div>
    <?php endif; ?>
  </div>
</body>
</html>