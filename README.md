# neighbor-food
php自作

## 概要　
ラーメン検索プラットフォーム

自身の位置情報を取得し、半径１km圏内のオープンしてるラーメン屋だけをマップ上で確認。また、選択した店へのルート表示。

## 使い方
ユーザー

店の検索・選択した店までのルート表示・行った店の履歴閲覧

テストアカウント

ユーザーID：ff@ne.jp

パスワード：pass01

## 環境
MAMP/MySQL/PHP

## DB
データーベース名：my_app

## Users テーブル
|Columm|Type|Options|
|:------|:----|:-------|
|id|int|null: false|
|name|varchar(255)|null: false|
|email|varchar(255)|null: false|
|password|varchar(255)|null: false|
|role|int|null: false|
|created_at|datetime|null: false|
|updated_at|timestamp|null: false|

## Histories テーブル
|Columm|Type|Options|
|:------|:----|:-------|
|id|int|null: false|
|name|varchar(255)|null: false|
|vicinity|varchar(255)|null: false|
|img|varchar(512)|null: false|
|created_at|datetime|null: false|
|updated_at|timestamp|null: false|

## users_histories テーブル
|Columm|Type|Options|
|:------|:----|:-------|
|id|int|null: false|
|user_id|int|null: false|
|history_id|int|null: false|
|created_at|datetime|null: false|
|updated_at|timestamp|null: false|

