<?php

require_once ("DB.php");

class History extends DB {



  // 行ったお店を登録
  public function addHistory($arr) {
    $sql = "INSERT INTO histories (name, vicinity, img, created_at) VALUES(:name, :vicinity, :img, :created_at)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':name'=>$arr['name'],
      ':vicinity'=>$arr['vicinity'],
      ':img'=>sha1($arr['img']),
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






}



 ?>
