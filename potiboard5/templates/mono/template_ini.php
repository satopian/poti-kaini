<?php
/*
* Template - MONO by (C) 2018-2022 POTI-kai POTI-board redevelopment team.  >> https://paintbbs.sakura.ne.jp/poti/
* original script by sakots
  *
  * potiboard.php(v2.21.4～)のテーマ(テンプレート)設定ファイルです。
  *
*/
//テーマ(テンプレート)のバージョン
define('TEMPLATE_VER', "v5.33.1 lot.221025");

//一般的なメッセージ

//投稿者名を引用する時の敬称、ただし名前の末尾に入る
define('HONORIFIC_SUFFIX', 'さん');
//アップロードした画像の呼称
define('UPLOADED_OBJECT_NAME', '画像');
//アップロードに成功した時のメッセージ
define('UPLOAD_SUCCESSFUL', 'のアップロードが成功しました');
//投稿が終了して画面が切り替わる時のメッセージ
define('THE_SCREEN_CHANGES', '画面を切り替えます');

//メール通知
define('NOTICE_MAIL_TITLE', '記事題名');
define('NOTICE_MAIL_IMG', '投稿画像');
define('NOTICE_MAIL_THUMBNAIL', 'サムネイル画像');
define('NOTICE_MAIL_ANIME', 'アニメファイル');
define('NOTICE_MAIL_URL', '記事URL');
define('NOTICE_MAIL_REPLY', 'へのレスがありました');
define('NOTICE_MAIL_NEWPOST', '新規投稿がありました');

//エラーメッセージ
define('MSG001', "該当記事がみつかりません。[Log is not found.]");
define('MSG002', "絵が選択されていません。[You haven't selected a picture. You must upload a picture!.]");
define('MSG003', "アップロードに失敗しました。[Failed to upload picture.]<br>サーバーがサポートしていない可能性があります[There is a possibility that the server doesn't support it.]");
define('MSG004', "アップロードに失敗しました。[Failed to upload picture.]<br>画像ファイル以外は受け付けません[The image is not valid and it was excluded.]");
define('MSG005', "アップロードに失敗しました。[Failed to upload picture.]<br>同じ画像がありました[Image already exists.]");
define('MSG006', "CSRFトークンが一致しません。[CSRF token mismatch.]");
define('MSG007', "画像がありません。[Image does not exist.]");
define('MSG008', "何か書いて下さい。[Please write something.]");
define('MSG009', "名前がありません。[Please enter your name.]");
define('MSG010', "題名がありません。[Please enter a title.]");
define('MSG011', "本文が長すぎます。[comment is too long.]");
define('MSG012', "名前が長すぎます。[name is too long.]");
define('MSG013', "メールアドレスが長すぎます。[email is too long.]");
define('MSG014', "題名が長すぎます。[subject is too long.]");
define('MSG015', "異常です。[Unknown error]");
define('MSG016', "拒絶されました。[Post was rejected.]<br>このHOSTからの投稿は受け付けません。[This HOST has been banned from posting.]");
define('MSG017', "ＥＲＲＯＲ！[Error]　公開ＰＲＯＸＹ規制中！！[Open-PROXY is limited.](80)");
define('MSG018', "ＥＲＲＯＲ！[Error]　公開ＰＲＯＸＹ規制中！！[Open-PROXY is limited.](8080)");
define('MSG019', "ログの読み込みに失敗しました。[It failed in reading the log.]");
define('MSG020', "連続投稿はもうしばらく時間を置いてからお願い致します。[Please wait a little bit before posting again.]");
define('MSG021', "画像連続投稿はもうしばらく時間を置いてからお願い致します。[Please wait a little bit before posting again.]");
define('MSG022', "このコメントで一度投稿しています。[Post once by this comment.]<br>別のコメントでお願い致します。[Please put another comment.]");
define('MSG023', "ツリーの更新に失敗しました。[It failed in the renewal of the tree.]");
define('MSG024', "ツリーの削除に失敗しました。[It failed in the deletion of the tree.]");
define('MSG025', "スレッドがありません。[Thread does not exist.]");
define('MSG026', "スレッドが最後の1つなので削除できません。[This is the last thread, it can not be deleted.]");
define('MSG027', "削除に失敗しました。(ユーザー)[failed in deletion.(User)]");
define('MSG028', "該当記事が見つからないかパスワードが間違っています。[article is not found or password is wrong.]");
define('MSG029', "パスワードが違います。[password is wrong.]");
define('MSG030', "削除に失敗しました(管理者権限)。[failed in deletion.(Admin)]");
define('MSG031', "記事Noが未入力です。[Please input No.]");
define('MSG032', "不適切な文字列があります。[There is an inappropriate string.]");
define('MSG033', "削除に失敗しました。[failed in deletion.]<br>ユーザーに削除権限がありません。[user doesn't have deletion authority.]");
define('MSG034', "アップロードに失敗しました。[Failed to upload picture.]<br>規定の画像容量をオーバーしています。[The size of the picture is too big.]");
define('MSG035', "何か日本語で書いてください。[Comment should have at least some Japanese characters.]");
define('MSG036', "本文にURLを書く事はできません。[This URL can not be used in text.]");
define('MSG037', "この名前は使えません。[This name cannot be used.]");
define('MSG038', "このタグは使えません。[This tag cannot be used.]");
define('MSG039', "コメントのみの新規投稿はできません。［New posts with only comments are not accepted.］");
define('MSG040', "管理者パスワードが設定されていません。[admin password is not set.]");
define('MSG041', "がありません。");
define('MSG042', "を読めません。");
define('MSG043', "に書けません。");
define('MSG044', "最大ログ数が設定されていないか、数字以外の文字列が入っています。[Either the MAX LOG is not set, or it contains a non-numeric string.]");
define('MSG045', "アップロードペイントに対応していないファイルです。[This file does not supported by the ability to load uploaded files onto the canvas.]<br>対応フォーマットはpch、spch、chiです。[Supported formats are pch, spch,chi and psd.]");
define('MSG046', "パスワードが短すぎます。最低6文字。[The password is too short. At least 6 characters.]");
define('MSG047', "画像の幅と高さが大きすぎるため続行できません。<br>[The size of the picture is too large. You can not continue.]");
define('MSG048', "不適切なURLがあります。<br>[There is an inappropriate URL.]");
define('MSG049', "拒絶されました。<br>[Rejected.]");
define('MSG050', "Cookieが確認できません。<br>[Cookie check failed.]");
define('MSG051', "連続したパスワードの誤入力を検知したためロックしています。<br>[Locked due to incorrect password attempts.]");
define('MSG053', "少し待ってください。[Please wait a little.]");
define("MSG054", "JavaScriptを有効にしてください。[Please enable JavaScript.]");

//文字色テーブル '値[,名称]'
$fontcolors = array('white,White'
,'lime,Green'
,'aquamarine,Aqua'
,'royalblue,Blue'
,'pink,Pink'
,'tomato,Red'
,'orange,Orange'
,'gold,Yellow'
,'silver,Silver'
);

//描画時間の書式
//※日本語だと、"1日1時間1分1秒"
//※英語だと、"1day 1hr 1min 1sec"
define('PTIME_D', '日');
define('PTIME_H', '時間');
define('PTIME_M', '分');
define('PTIME_S', '秒');

//＞が付いた時の書式
//※RE_STARTとRE_ENDで囲むのでそれを考慮して
//cssで設定するの推奨
define('RE_START', '<span class="resma">');
define('RE_END', '</span>');

//現在のページの書式
//※<PAGE> にページ数が入ります
define('NOW_PAGE', '<em class="thispage">[<PAGE>]</em>');

//他のページの書式
//※<PAGE> にページ数が入ります
//※<PURL> にURLが入ります
define('OTHER_PAGE', '<a href="<PURL>">[<PAGE>]</a>');


/* -------------------- */

//メインのテンプレートファイル
define('MAINFILE', "mono_main");

//レスのテンプレートファイル
define('RESFILE', "mono_main");

//その他のテンプレートファイル
define('OTHERFILE', "mono_other");

//お絵かきのテンプレートファイル
define('PAINTFILE', "mono_paint");
// define('PAINTFILE', "chickenpaintpaint");

//カタログのテンプレートファイル
define('CATALOGFILE', "mono_catalog");

//カタログモードで表示する記事の数
//X * Y の個数分表示
define('CATALOG_X', '4');
define('CATALOG_Y', '5');

//カタログの画像幅　これはcssで指定します
define('CATALOG_W', '150');

//編集したときの目印
//※記事を編集したら日付の後ろに付きます
define('UPDATE_MARK', ' *');

//日付の書式
//※<1> に漢字の曜日(土・日・月など)が入ります
//※<2> に漢字の曜日(土曜・日曜・月曜など)が入ります
//※他は下記のURL参照
//  http://www.php.net/manual/ja/function.date.php
//define(DATE_FORMAT, 'Y/m/d(<1>) H:i');
define('DATE_FORMAT', 'Y/m/d(D) H:i');


