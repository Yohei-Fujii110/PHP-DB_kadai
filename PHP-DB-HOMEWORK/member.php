<?php
  session_start();

  require_once 'data.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title><?php echo $resluts[0]['name']; ?>さんの会員ページ</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container m-auto mt-4 ">
    <header>
      <h4><?php echo $resluts[0]['name']; ?>さんの会員ページ</h4>

    </header>


      <article class="p-4 mb-4 border border-info">
      
          <h4 id="title" class="mb-4 w-75 text-decoration-underline"><?php echo $resluts[0]['name']; ?>さんの会員情報</h4>
          <section id="table" class="w-75 table">
            <div>お名前</div><div><?php echo $resluts[0]['name']; ?></div>
            <div>メールアドレス</div><div><?php echo $resluts[0]['email']; ?></div>
            <div>年齢</div><div><?php echo $resluts[0]['age']; ?></div>
            <div>住所</div><div><?php echo $resluts[0]['address']; ?></div>
          </section>

      </article>

      <section class="p-4 border border-info text-center">
        <button id="area-btn" class="btn me-2 btn-primary">地域天気表示</button>
        <button id="info-btn" class="btn me-2 btn-primary">会員情報表示</button>
      </section>

    </main>

    <footer class="text-center">
      <a href="login.php?logout=true" class="btn btn-secondary">ログアウト</a>
    </footer>
  </div>
  <script>const address = '<?php echo $resluts[0]['address']; ?>';</script>
  <script src = "script3.js"></script>
</body>
</html>