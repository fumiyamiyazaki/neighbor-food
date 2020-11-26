<?php
session_start();

// ログイン画面を経由したかを判定
if(!isset($_SESSION['User']) && !isset($_SESSION['Store'])) {
  header('location: index.php');
  exit;
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
<script src="//maps.googleapis.com/maps/api/js?key=&language=ja&libraries=drawing,geometry,places,visualization&fields=photos,opening_hours&callback=initMap" async defer></script>
<script>
</script>
<script>
// 現在地所得JS
var infowindow;
var ret = new Array();
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
        var map = new google.maps.Map(mapArea, mapOptions);

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
        }, callback);

        //地図上にマーカーをプロット
        function callback(results, status, pagination) {
          if(status === google.maps.places.PlacesServiceStatus.OK) {
            for(var i = 0; i < results.length; i++) {
              createMarker(results[i]);
              if(pagination.hasNextPage) {
                setTimeout(pagination.nextPage(), 1000);
              }
            }
          }
        }

        // マーカーをクリックしたときの動作
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
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + 'サイト：' + place.opening + '<br>' + '住所: ' + place.vicinity  + '</div>');
            infowindow.open(map, this);
          });

          var photos = place.photos;
          const li = document.createElement("li");
          li.innerHTML = '<div class="shoplist_wrapp"><img class="place_photos" src=' + place.photos[0].getUrl({'maxWidth': 200, 'maxHeight': 200}) + '><div class="shoplist_info"><strong>' + place.name + '</strong><br>' + '<span class="place_vicinity">' + place.vicinity + '</span></div></div>';
          placeList.appendChild(li);
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

  <div class="search_flame-wrapp">



    <?php require("shared/_header.php"); ?>

    <div class="search_store-wrapp">

      <div class="search_map-wrapp">

        <div id="right_panel">
          <h2>Open-Now</h2>
          <ul id="places">
          </ul>
        </div>

        <div id="maps"></div>

      </div>

    </div>


    <?php require("shared/_footer.php") ?>

</div>


</body>
</html>
