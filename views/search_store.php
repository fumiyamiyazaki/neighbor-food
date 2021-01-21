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

// ログイン画面を経由したかを判定
if(!isset($_SESSION['User'])) {
  header('location: /my_app/views/registrations/new.php');
  exit;
}

// if($_POST) {
//   $_SESSION['store'] = $_POST;
//   $storeName = $_SESSION['store']['name'];
// }


try {
  $history = new History($host, $dbname, $user, $pass);
  $history->connectdb();

  if($_POST) {
    $user_id = $_SESSION['User']['id'];
    // 行ったお店を登録
    $history->addHistory($_POST);
    // 中間テーブルに格納
    $history->addUserHisotry($user_id);
  }




}catch(PDOException $e) {
  echo 'データベース接続失敗'.$e->getMessage();
}





 ?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>my_app</title>
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/shared.css">
<link rel="stylesheet" type="text/css" href="../css/search_store.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCQLiK3BefVx2uwPaRfTPlvL-tuOE1OZ5Q&language=ja&libraries=drawing,geometry,places,directions,visualization&fields=photos,opening_hours&callback=initMap" async defer></script>
<script>
window.onload = function() {
const load = document.getElementById('loading');
setTimeout(load.classList.add('loaded'), 2000);
}

// 現在地所得JS
var infowindow;
var ret = new Array();
var rendererOptions = {
	// draggable: true,	//ドラッグ操作の有効/無効
	// preserveViewport: true,	//ズームの有無
	suppressMarkers: true,	//デフォルトのマーカーを非表示
	polylineOptions: {	//ルートの色と太さはここで変える
		strokeColor:"#FF4F50",	//色
		strokeWeight:3	//太さ
	}
};


// グーグルAPIのURLからコールバックされる
function initMap() {

  //現在位置を許可させ、位置を取得する javascript
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(pos) {
       ret['long'] = pos.coords.longitude; //経度
       ret['lat'] = pos.coords.latitude; //緯度

        //位置を指定して、Google mapに表示する javascript
        var mapPosition = {}
        mapPosition["lat"] = ret['lat'];
        mapPosition["lng"] = ret['long'];
        var mapArea = document.getElementById('maps');
        var mapOptions = {
          center: mapPosition,
          zoom: 15
        };

        // グーグルマップAPI、ダイレクションAPIを宣言
        var directionsRenderer = new google.maps.DirectionsRenderer(rendererOptions);
        var directionsService = new google.maps.DirectionsService();
        var map = new google.maps.Map(mapArea, mapOptions);

        // ルートとサイドパネルを地図上にセット
        directionsRenderer.setMap(map);
        directionsRenderer.setPanel(document.getElementById('directionsPanel'));

	      // google.maps.event.addListener(directionsRenderer,'directions_changed', function(){});

        //現在地の緯度経度を中心にマップに円を描く
        var circleOptions = {
          map: map,
          center: new google.maps.LatLng(mapPosition),
          radius: 1000,
          strokeColor: "#00ffcc",
          strokeOpacity: 1,
          strokeWeight: 1,
          fillColor: "#00ffcc",
          fillOpacity: 0.35
        };
        var circle = new google.maps.Circle(circleOptions);

        //現在地にマーカーをつける
        var marker = new google.maps.Marker({
          position: mapPosition,
          title: "Your Location"
        });
        marker.setMap(map);

        result(ret);

        // 現在地から１キロ以内のお店を検索
        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: mapPosition,
          radius: 1000,
          // openNow: true,
          keyword: 'ラーメン'
        }, callback);   //検索後、コールバック関数を呼び出す

        //地図上にマーカーをプロット
        function callback(results, status, pagination) {
          if(status === google.maps.places.PlacesServiceStatus.OK) {
            // 取得した店の数だけ関数を呼び出す
            for(var i = 0; i < results.length; i++) {
              createMarker(results[i]);
              if(pagination.hasNextPage) {
                setTimeout(pagination.nextPage(), 1000);
              }
            }
          }
        }

        // マーカーをクリックしたときの動作 + サイドパネル表示
        function createMarker(place) {
          var placeLoc = place.geometry.location;
          var placeList = document.getElementById("places");
          var photos = place.photos;
          if(!photos) {
            return;
          }
          var marker = new google.maps.Marker({
            map: map,
            position: placeLoc,
            icon: {
              url: '../img/pin.png',
              scaledSize: new google.maps.Size(30, 20)
            }
          });

          // 吹き出しの中身
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent('<div><strong>'
            + place.name + '</strong><br><br>' + '住所: '
            + place.vicinity  + '</div>');

            infowindow.open(map, this);
          });

          // サイドパネルに取得した店の情報を表示
          var photos = place.photos;
          const li = document.createElement("li");
          li.innerHTML = '<div class="shoplist_wrapp"><img class="place_photos" alt="nophoto" src='
          + place.photos[0].getUrl({'maxWidth': 200, 'maxHeight': 200}) + '><div class="shoplist_info"><strong>'
          + place.name + '</strong><br>' + '<span class="place_vicinity">'
          + place.vicinity + '</span><form action="" id="store_form" enctype="multipart/form-data" method="post"><input type="text" name="name" class="place_info-input" value="'
          + place.name + '"><input type="text" name="vicinity" class="place_info-input" value="'
          + place.vicinity + '"><input type="text" name="img" class="place_info-input" value="'
          + place.photos[0].getUrl() + '"><button type="button" id="go_btn" value="'
          + place.vicinity + '">この店に行く</button><input type="submit" id="arrival_btn" value="到着"></form></div></div>';

          placeList.appendChild(li);
        }

        // ルート表示のトリガー
        $('#right_panel').on('click', '#go_btn', function() {

          // クリック時のcssの変化js
          $(this).closest('li').addClass('cli');
          $(this).closest('li').prev('li').removeClass('cli');
          $('#right_panel').find('li').css("opacity","0.3");
          $('.cli').css("opacity","1");
          $(this).closest('li').find('#arrival_btn').css("display","inline");
          $(this).closest('li').find('#go_btn').css("display","none");

          // ボタンの値を取得し、引数に入れ関数を呼び出す
          var destination = $(this).attr('value');
          calcRoute(destination)
        });



        // ルート表示
        function calcRoute(destination) {
          var request = {
            origin: mapPosition,
            destination: destination,
            travelMode: 'WALKING',
          };
          directionsService.route(request, function(result, status) {
            if (status == 'OK') {
              directionsRenderer.setDirections(result);

            }
          });
        }





      },
      // エラーハンドル
      function(erro) {
        switch(error.code) {
          case 1: ret['msg'] = "位置情報の利用が許可されていません"; break;
          case 2: ret['msg'] = "デバイスの位置が判定できません"; break;
          case 3: ret['msg'] = "タイムアウトしました"; break;
        }
        result(ret);
      }
    );
  }else {
    ret['msg'] = 'このブラウザでは位置取得が出来ません。';
    result(ret);
  }
  function result(ret) {
    console.log(ret);
  }
}





</script>
<!-- <script>
function initMap() {
  var mapPosition = {lat: 35.170662, lng: 136.923430};
  var mapArea = document.getElementById('maps');
  var mapOpstions = {
    center: mapPosition,
    zoom: 16,
  };
  var map = new google.maps.Map(mapArea, mapOpstions);
}

</script> -->
</head>
<body>
  <?php require("shared/_loading.html") ?>

  <div class="search_flame-wrapp">



    <?php require("shared/_header.php"); ?>

    <div class="search_store-wrapp">

      <div class="search_map-wrapp">

        <div id="right_panel">
          <h2 id="h2">Open-Now</h2>
          <ul id="places">
          </ul>
        </div>

        <div id="maps"></div>

      </div>

    </div>
    <div id="directionsPanel">
    </div>




    <?php require("shared/_footer.php") ?>

</div>


</body>
</html>
