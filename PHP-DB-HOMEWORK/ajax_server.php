<?php
  //data.phpを読み込む
  require_once 'data.php';

  // Ajaxarリクエストを取得
  $request = file_get_contents('php://input');
  $data = json_decode($request, true);

  // データベースから情報を取得
  $sql = 'SELECT * FROM members WHERE email = :email';
  $stmt = $pdo->prepare($sql);     // SQL文のセット
  // プレースホルダに値をバインド
  $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);

  // SQL実行
  $stmt->execute();

  // 結果の取得
  $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // JSON形式で返す
  if(!empty($info)) {
    $response = [
      'id' => $info[0]['id'],
      'name' => $info[0]['name'],
      'email' => $info[0]['email'],
      'age' => $info[0]['age'],
      'address' => $info[0]['address']];
    header('Content-Type: application/json');
    echo json_encode($response);
  } else {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(array('error' => 'Member not found'));
  }
?>