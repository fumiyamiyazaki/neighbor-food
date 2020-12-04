<?php

require_once ("DB.php");

class Store extends DB {


  // // ストアログイン
  public function loginStore($arr) {
    $sql ="SELECT * FROM stores WHERE email = :email AND password = :password";
    $stmt = $this->connect->prepare($sql);
    $params = array(':email'=>$arr['email'], ':password'=>$arr['password']);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }


  // // 新規ストア登録
  public function addStore($arr) {
    $sql = "INSERT INTO stores(name, postal_code, address, building_name, email, password, created_at) VALUES(:name, :postal_code, :address, :building_name, :email, :password, :created_at)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':name'=>$arr['name'],
      ':postal_code'=>$arr['postal_code'],
      ':address'=>$arr['address'],
      ':building_name'=>$arr['building_name'],
      ':email'=>$arr['email'],
      ':password'=>$arr['password'],
      ':created_at'=>date('Y-m-d H:i:s')
    );
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }








  // アカウント画像の登録
  public function insertImg($img, $id) {
    $sql = "UPDATE stores SET image = :image WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':id'=>$id,
      ':image'=>$img
    );
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  // 参照（条件付き）
  public function findByStoreId($id) {
    $sql = "SELECT * FROM stores WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $params = array(":id"=>$id);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  // サインアップしたユーザーの情報を格納
  public function lastInsertStoreId() {
    $lastId = $this->connect->lastInsertId();
    $sql = "SELECT * FROM stores WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $params = array(":id"=>$lastId);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }



  // バリデーション
  public function new_validateStore($arr) {
    $error = array();

    if(empty($arr['name'])) {
      $error['name'] = "氏名を入力してください";
    }

    if(empty($arr['postal_code'])) {
      $error['postal_code'] = "郵便番号を入力してください";
    }

    if(empty($arr['address'])) {
      $error['address'] = "都道府県・市町村・番地を入力してください";
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

  public function login_validateStore($arr) {
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

  public function img_balidate($arr) {
    $message = arry();
    $file_name = $arr['img']['name'];
    $file_size = $arr['img']['size'];
    $allow_ext = array('jpg', 'jpeg', 'png');
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    if(empty($file_name)) {
      $message['img'] = "画像を指定してください。";
    }

    if(!in_array(strtolower($file_ext), $allow_ext)) {
      $message['img'] = "『jpg』『jpeg』『png』形式の画像を指定してください。";
    }
  }






}



 ?>
