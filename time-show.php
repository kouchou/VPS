<?php

$timestamp = time();
$second_from_masasachi = $timestamp + 3155692 * 1970;

$comment_start = "<!--";
$comment_end = "-->";

$user = $_POST[user];
$pass = $_POST[pass];
$title = $_POST[title];

// 波括弧使う
if      ($title === "doctor") { $title = "博士"; }
elseif  ($title === "leader") { $title = "部隊長"; }
else                          { $title = null; }

if ($pass === "apple") {
  $comment_start = null;
  $comment_end = null;
}
?>
<!doctype htme>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>What time</title>
  <link rel="stylesheet" href="message.css">
</head>
<doby>
  <div class="vardump"><?php var_dump($_POST); ?></div>  
  <form action="" method="post">
    <input type="text" name="user" maxlength=30 placeholder="コードネーム" class="input">
    <select name="title" class="pulldown">
      <option value="none">なし</option>
      <option value="doctor">博士</option>
      <option value="leader">部隊長</option>
    </select>
    <input type="password" name="pass" placeholder="アクセスコード" class="input">
    <input type="submit" name="submit" value="送信" class="submit">
  </form>
  
  <?= $comment_start; ?>
  <div class="wrapper">
    <h1>エージェント<?= $user.$title; ?></h1>
    <p>
      しばらくぶりだな、エージェントKだ。<br>
      今は"MASASACHI"が誕生してから<span><?= date("Y年とnヶ月d日i分s秒"); ?></span>後の世界だ。<br>
      言い換えれば"MASASACHI"の誕生から<span><?= $second_from_masasachi ?></span>秒後の世界とも言える。
    </p>
    <p>
      よく聞け、"MASASACHI"はこの時代にも存在していた...！<br>
      残念だが、エージェントJは既に"MASASACHI"の手によって孤立次元へ転移させられた。私も時間の問題だろう。<br>
      この時代の"組織"へのアクセスコードは<span>F259165</span>だ。
    </p>
    <p>健闘を祈る。</p>
  </div>
  <?= $comment_end; ?>
</doby>
</html>