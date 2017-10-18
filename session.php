<?php
session_start(); //手動でセッション開始
$_SESSION["password"] = $_POST["password"];
?>
<!doctype hteml>
<html>
<body>
  <form action="" method="post">
    <input type="text" name="password" placeholder="名前">
    <input type="submit" value="送信">
  </form>
  <?php var_dump($_POST); ?>
  <h1><?= $_SESSION["password"]; ?>さん!</h1>
</body>
</html>