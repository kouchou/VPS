<!doctype html>
<html>
<head>
  <style>
    .test{
      margin: 30px;
      padding: 20px;
      border: 3px dashed #ccc;
      border-radius: 3px;
      font-size: 15px;
      color: #333;
      outline: none;
      box-sizing: border-box;
    }
    .test:focus {
      border: 3px solid #cba;
      background-color: #fbfce7;
    }
    
  </style>
</head>
<body>
  <input type="text" name="id_form" value="" maxlength=12 class="test" placeholder="IDを入力して"><br>
<!--
  <input type="text" name="" value="testes" readonly="readonly"><br>
  <input type="text" name="" value="testes" disabled="disabled"><br>
  <input type="password" name="password_form">
  <input type="checkbox" name="check_box" checked="checked"><br>
  <input type="radio" name="hoge">
  <input type="radio" name="hoge" checked="checked">
  <input type="radio" name="hoge">
  <input type="radio" name="hoge">
  <input type="radio" name="hoge">
  <input type="radio" name="hoge"><br>
  <input type="file" accept="text/css"><br>
  <input type="button" value="クリックしようやぁ"><br>
  <input type="submit" value="送信しますね"><br>
  <textarea>初期値です初期値へい</textarea><br>
  <select>
    <option value="ini">洗濯してください</option>
    <option value="en">英語</option>
    <option value="ja">日本語</option>
    <option value="it">イタリア語</option>
    <option value="apple">りんごちゃん</option>
  </select><br>
  <select multiple="multiple">
    <option value="">じゃがいも</option>
    <option value="">ポテト</option>
    <option value="">ポテチ</option>
    <option value="">ジャガビー</option>
    <option value="">芋ガン</option>
  </select><br>
  <input type="button" value="button">
  <button type="submit">Submit</button><br>
  <input type="url" name="" value="testes"><br>
  <input type="email" name="" value="testes"><br>
  <input type="date" name="" value="testes"><br>
  <input type="range" name="" value="testes"><br>
  <input type="color" name="" value="testes"><br>
-->
  
  <!-- action 送信するパスを指定 -->
  <form method="post" action="">
    <input type="text" name="user" placeholder="名前">
    <input type="radio" name="hoge" value="yamaha" id="apple">
    <label for="apple">YAMAHA</label>
    <label>
      <input type="radio" name="hoge" value="suzuki" checked="checked">SUZUKI
    </label>
    <label>
      <input type="radio" name="hoge" value="kawasaki">KAWASAKI
    </label>
    <input type="submit" name="submit" value="書き込む">
    <select multiple="multiple">
      <option value="jaga">じゃがいも</option>
      <option value="p">ポテト</option>
      <option value="pt">ポテチ</option>
      <option value="jb">ジャガビー</option>
    <option value="ig">芋ガン</option>
  </select><br>
  </form>
  <?php var_dump($_POST[hoge]); ?>
</body>
</html>



































