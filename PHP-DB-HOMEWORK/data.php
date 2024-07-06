<?php
  //------------- データサーバ関係------------------
  $dsn = 'mysql:dbname=homework_login;host=localhost;charset=utf8mb4';
  $user = 'root';
  $password = '';

  // submitパラメータの値が存在するとき

  try{
    // データベースへの接続
    $pdo = new PDO($dsn, $user, $password);

    //テーブルの作成
    $sql = 'CREATR TABLE IF NOT EXISTS members(
      id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(60) NOT NULL,
      email VARCHAR(255) NOT NULL,
      password CHAR(64) NOT NULL,                 
      age INT(11) NOT NULL,
      address VARCHAR(255) NOT NULL                    
    )';
    $pdo->query($sql);

    if(isset($_POST['submit'])) {
      // 入力されたメールアドレスとpasswordに両方合致するデータを検索するSQL文
      $sql = 'SELECT * FROM members WHERE ( email = :email ) AND (password = :password )';
      $stmt = $pdo->prepare($sql);     // SQL文のセット

      $password = hash('sha256', $_POST['password']);   // パスワードのハッシュ化

      // bindValue()メソッドでプレースホルダにバインド
      $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);

      $stmt->execute(); //SQL文の実行

      // 戻り値として取得
      $resluts = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // 戻り値がNULL（会員情報が一致しない）場合
      if(empty($resluts)) {
        $_SESSION['flash'] = "認証エラー：ログインに失敗しました";
        header('Location: login.php');
      } else {
        // クッキーの設定
        setcookie('email', $resluts[0]['email'], time() + 3600 );
      }
    } 
  } catch(PDOException $e) {
      $_SESSION['flash'] = "接続エラー：データベースの接続に失敗しました";
      header('Location: login.php');
  }
?>