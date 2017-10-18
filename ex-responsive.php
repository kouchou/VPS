<?php
$style = 0;
if ($_POST["style"] !== null) {
  $style = 1;
}
var_dump($style);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>レスポンシブの練習</title>
  <link rel="stylesheet" href="reset.css">
  <?php if ($style === 0) : ?>
  <link rel="stylesheet" href="ex-responsive1.css">
  <?php elseif ($style === 1) : ?>
  <link rel="stylesheet" href="ex-responsive2.css">
  <?php endif; ?>
</head>
<body>
  <div class="c-button">
    <form action="" method="post">
      <button type="submit" name="style" value="1">課題2へ切り替え</button>
    </form>
  </div>
  <main class="main">
    <div class="c-box">A</div>
    <div class="c-box">B</div>
    <div class="c-box">C</div>
    <div class="c-box">D</div>
  </main>
</body>
</html>