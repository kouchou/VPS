<?php
setcookie("username", $_POST["username"]);
?>
<!doctype hteml>
<html>
<body>
  <form action="" method="post">
    <input type="text" name="username" placeholder="名前">
    <input type="submit" value="送信">
  </form>
  <?php var_dump($_POST); ?>
  <h1><?= $_COOKIE["username"]; ?>さん!</h1>
</body>
</html>