<?php

require_once ("DB.php");

class User extends DB {

  // ユーザーログイン
  public function loginUser($arr) {
    $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $this->connect->prepare($sql);
    $params = array(':email'=>$arr['email'], ':password'=>$arr['password']);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  // 新規ユーザー登録
  public function addUser($arr) {
    $sql = "INSERT INTO users(name, email, password, role, created_at) VALUES(:name, :email, :password, :role, :created_at)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':name'=>$arr['name'],
      ':email'=>$arr['email'],
      ':password'=>$arr['password'],
      ':role'=>1,
      ':created_at'=>date('Y-m-d H:i:s')
    );
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  // 参照（条件付き）
  public function findById($id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $params = array(":id"=>$id);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  // サインアップしたユーザーの情報を格納
  public function lastInsertUserId() {
    $lastId = $this->connect->lastInsertId();
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $params = array(":id"=>$lastId);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  // 編集 update
  public function edit($arr) {
    $sql = "UPDATE users SET name = :name, email = :email, password = :password, updated_at = :updated_at WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':id'=>$arr['id'],
      ':name'=>$arr['name'],
      ':email'=>$arr['email'],
      ':password'=>$arr['password'],
      ':updated_at'=>date('Y-m-d H:i:s'),
    );
    $stmt->execute($params);
  }

  // 削除 delete
  public function delete($id = null) {
    if(isset($id)) {
      $sql = "DELETE FROM users WHERE id = :id";
      $stmt = $this->connect->prepare($sql);
      $params = array(':id'=>$id);
      $stmt->execute($params);
    }
  }

  // ストア履歴の参照
  public function findHistory($user_id) {
    $sql = "SELECT ";
    $sql .= "histories.name as history_name,";
    $sql .= "histories.vicinity,";
    $sql .= "histories.img,";
    $sql .= "users_histories.created_at ";
    $sql .= "FROM users_histories ";
    $sql .= "JOIN users ON users.id = users_histories.user_id ";
    $sql .= "JOIN histories ON histories.id = users_histories.history_id ";
    $sql .= "WHERE users.id = :id";

    $stmt = $this->connect->prepare($sql);
    $params = array(':id'=>$user_id);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    return $result;
  }



  // バリデーション
  public function new_edit_validate($arr) {
    $error = array();

    if(empty($arr['name'])) {
      $error['name'] = "氏名を入力してください";
    }

    if(empty($arr['email'])) {
      $error['email'] = "メールアドレスを入力してください";
    }else {
      if(!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "メールアドレスが正しくありません";
      }
    }

    if(empty($arr['password'])) {
      $error['password'] = "パスワードを入力してください";
    }else {
      if(!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{4,100}+\z/i', $arr['password'])) {
        $error['password'] = "パスワードは半角英数字をそれぞれ1文字以上含んだ4文字以上で設定してください。";
      }
    }

    return $error;
  }

  public function login_validate($arr) {
    $message = array();

    if(empty($arr['email'])) {
      $message['email'] = "メールアドレスを入力して下さい";
    }else {
      if(!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {
        $message['email'] = "メールアドレスが正しくありません";
      }
    }

    if(empty($arr['password'])) {
      $message['password'] = "パスワードを入力してください。";
    }

    return $message;
  }


}





 ?>
