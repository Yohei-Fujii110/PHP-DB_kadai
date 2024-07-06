<?php
session_start();

if(isset($_GET['logout'])){
  $_SESSION['flash'] = 'ログアウトしました。';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>会員ログイン</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  
</head>

<body>
  <div class="container m-auto mt-4 w-50">
    <header>
      <h4>会員ログイン</h4>

      <?php if(isset($_SESSION['flash'])): ?>
        <nav class="px-4 py-2 my-4 border border-danger">
          <?php 
            echo $_SESSION['flash'];
            unset($_SESSION['flash']);
          ?>
        </nav>
      <?php endif; ?>
    </header>

    <main class="mb-4 p-4 m-auto border border-secondary form">
      <form action="member.php" method="post">
        <section class="mb-4 login-form">
          <label for="email">メールアドレス</label>
          <input type="text" name="email" id="email" class="form-control">
          <label for="password">パスワード</label>
          <input type="password" name="password" id="password" class="form-control">
        </section>

        <section class="text-center">
          <button type="submit" name="submit" value="submit" class="btn btn-primary">ログイン</button>
        </section>
      </form>
    </main>

    <footer class="text-center">
      <a href="login.php" class="btn btn-secondary">ログインページ</a>
    </footer>
  </div>
</body>
</html>