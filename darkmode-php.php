<?php
$hour = date("H");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dark Mode</title>
</head>
<link rel="stylesheet" href="reset.css">
<style>
  html, body {
    height: 100%;
    background-color: #fdfff1;
  }
  <?php if ($hour - 6 >= 12) : ?>
  body {
    background-color : #666;
  }
  <?php endif; ?>
  .main {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
  }
  .c-box--message {
    width: 500px;
    height: 250px;
    background-color: white;
    border: 1px solid #aaa;
    border-radius: 8px;
    text-align: center;
    line-height: 250px;
    font-size: 28px;
    box-shadow: 0px 0px 8px 10px white;
  }
</style>
<body>
  <main class="main">
    <div class="c-box c-box--message">
      ただいま
      <?= $hour; ?>
      時です
    </div>
  </main>
</body>
</html>