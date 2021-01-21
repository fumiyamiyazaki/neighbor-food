<?php
session_start();
// セッション破棄
if(isset($_GET['logout'])) {
  $_SESSION = array();
  session_destroy();
  header('location: /my_app/views/index.php');
  exit;
}


require_once ("../config/config.php");
require_once ("../model/History.php");

// ログイン画面を経由したか,管理者ユーザーか判定
if(!isset($_SESSION['User']) || $_SESSION['User']['role'] != 0) {
  header('location: index.php');
  exit;
}


try {
  $history = new History($host, $dbname, $user, $pass);
  $history->connectdb();

  $Gdatas = $history->usingHisotry();  //時間帯毎のルート機能利用数を取得

}catch(PDOException $e) {
  echo 'データベース接続失敗'.$e->getMessage();
}

// foreach($Gdata as $row) {
//   switch() {
//     case 5 ==
//   }
//
// }




 ?>


<!DOCTYPE html>
<html lang="ja">
<head>
<title>my_app</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/shared.css">
<link rel="stylesheet" type="text/css" href="../css/administrator_account.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
$(function() {
  barGraph();

});


function barGraph() {
  let dataArray = JSON.parse('<?php echo json_encode($Gdatas) ?>'); //phpの値をパースして埋め込み
  var data = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,]; //初期値0の24時間分の配列
  //それぞれの時間帯での利用数を配列に格納
  for($i=0; $i<dataArray.length; $i++) {
    var hour = Number(dataArray[$i]['used_time']);
    var count = dataArray[$i]['count'];
    // console.log(count);
    // console.log(hour);
    switch(hour) {
      case 5:
        data.splice(0,0,count);
        break;
      case 6:
        data.splice(1,0,count);
        break;
      case 7:
        data.splice(2,0,count);
        break;
      case 8:
        data.splice(3,0,count);
        break;
      case 9:
        data.splice(4,0,count);
        break;
      case 10:
        data.splice(5,0,count);
        break;
      case 11:
        data.splice(6,0,count);
        break;
      case 12:
        data.splice(7,0,count);
        break;
      case 13:
        data.splice(8,0,count);
        break;
      case 14:
        data.splice(9,0,count);
        break;
      case 15:
        data.splice(10,0,count);
        break;
      case 16:
        data.splice(11,0,count);
        break;
      case 17:
        data.splice(12,0,count);
        break;
      case 18:
        data.splice(13,0,count);
        break;
      case 19:
        data.splice(14,0,count);
        break;
      case 20:
        data.splice(15,0,count);
        break;
      case 21:
        data.splice(16,0,count);
        break;
      case 22:
        data.splice(17,0,count);
        break;
      case 23:
        data.splice(18,0,count);
        break;
      case 24:
        data.splice(19,0,count);
        break;
      case 1:
        data.splice(20,0,count);
        break;
      case 2:
        data.splice(21,0,count);
        break;
      case 3:
        data.splice(22,0,count);
        break;
      case 4:
        data.splice(23,0,count);
        break;
    }
  }

  var ctx = document.getElementById('myChart');
  //chart.js宣言
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: ['5時','6時','7時','8時','9時','10時','11時','12時','13時','14時','15時','16時','17時','18時','19時','20時','21時','22時','23時','24時','1時','2時','3時','4時'],
      datasets: [
        {
          label: '利用数',
          data: data,
          backgroundColor: "rgba(219,39,91,0.5)",
          barPercentage: 0.6,  //バーの幅を調整
          categoryPercentage: 0.6  //バーの幅を調整
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'ルート機能 利用者数'
      },
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 100,
            suggestedMin: 0,
            stepSize: 10,
            callback: function(value, index, values){  //y軸のラベル表示
              return  value +  '人'
            }
          }
        }],
        xAxes: [{
          ticks: {
            callback: function(value) {
              const val = value.replace(/[^0-9]/g, '');  //0埋めをなくす
              return ((val % 3) == 0)? value : ''  //x軸のラベル表示を調整
            },
          }
        }]
      },
    }
  });

}


</script>
</head>
<body>

  <?php require("shared/_header.php"); ?>

  <div class="graph_content">

    <div class="chart_title">

    </div>

    <canvas id="myChart"></canvas>


  </div>



  <?php require("shared/_footer.php") ?>



</body>
</html>
