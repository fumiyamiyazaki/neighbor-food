<?php

require_once ("DB.php");

class History extends DB {



  // 行ったお店を登録
  public function addHistory($arr) {
    // imgの文字列暗号化
    $crypt = $arr['img'];
    $cipher = 'aes-128-ecb';
    $key = 'key';
    $crypttext = openssl_encrypt($crypt, $cipher, $key);
    $arr['img'] = $crypttext;

    // 格納
    $sql = "INSERT INTO histories (name, vicinity, img, created_at) VALUES(:name, :vicinity, :img, :created_at)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':name'=>$arr['name'],
      ':vicinity'=>$arr['vicinity'],
      ':img'=>$arr['img'],
      ':created_at'=>date('Y-m-d H:i:s')
    );
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  // ユーザーIDとヒストリーIDを中間テーブルに格納
  public function addUserHisotry($user_id) {
    $lastHistoryId = $this->connect->lastInsertId();
    $sql = "INSERT INTO users_histories(user_id, history_id, created_at) VALUES(:user_id, :history_id, :created_at)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':user_id'=>$user_id,
      ':history_id'=>$lastHistoryId,
      ':created_at'=>date('Y-m-d H:i:s')
    );
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }


  // ユーザーのアプリ利用歴を時間帯ごとに抽出
  public function usingHisotry() {
    $sql = "SELECT ";
    $sql .= "DATE_FORMAT(created_at, '%H') as used_time,";
    $sql .= "COUNT(*) as count ";
    $sql .= "FROM histories ";
    $sql .= "GROUP BY DATE_FORMAT(created_at, '%H')";

    $stmt = $this->connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }






}



 ?>
