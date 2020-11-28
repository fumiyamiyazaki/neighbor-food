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
    $sql = "INSERT INTO users(name, email, password, created_at) VALUES(:name, :email, :password, :created_at)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':name'=>$arr['name'],
      ':email'=>$arr['email'],
      ':password'=>$arr['password'],
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



  // バリデーション
  public function new_validate($arr) {
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
