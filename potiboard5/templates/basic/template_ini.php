<?php
/*
	* Template - BASIC by (C) 2022 satopian >> https://paintbbs.sakura.ne.jp/poti/
	* original script by 黒鋼彗牙 >> https://draclaw.com/ 
  *
*/

//テンプレートのバージョン
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


/* ---------- ADD:2004/06/22 ---------- */
//エラーメッセージ
define('MSG001', "該当記事がみつかりません。");
define('MSG002', "絵が選択されていません。");
define('MSG003', "アップロードに失敗しました。<br>サーバーがサポートしていない可能性があります。");
define('MSG004', "アップロードに失敗しました。<br>画像ファイル以外は受け付けません。");
define('MSG005', "アップロードに失敗しました。<br>同じ画像がありました。");
define('MSG006', "CSRFトークンが一致しません。");
define('MSG007', "画像がありません。");
define('MSG008', "何か書いて下さい。");
define('MSG009', "名前がありません。");
define('MSG010', "題名がありません。");
define('MSG011', "本文が長すぎます。");
define('MSG012', "名前が長すぎます。");
define('MSG013', "メールアドレスが長すぎます。");
define('MSG014', "題名が長すぎます。");
define('MSG015', "異常です。");
define('MSG016', "拒絶されました<br>このHOSTからの投稿は受け付けません。");
define('MSG017', "ＥＲＲＯＲ！　公開ＰＲＯＸＹ規制中！！(80)");
define('MSG018', "ＥＲＲＯＲ！　公開ＰＲＯＸＹ規制中！！(8080)");
define('MSG019', "ログの読み込みに失敗しました。");
define('MSG020', "連続投稿はもうしばらく時間を置いてからお願い致します。");
define('MSG021', "画像連続投稿はもうしばらく時間を置いてからお願い致します。");
define('MSG022', "このコメントで一度投稿しています<br>別のコメントでお願い致します。");
define('MSG023', "ツリーの更新に失敗しました。");
define('MSG024', "ツリーの削除に失敗しました。");
define('MSG025', "スレッドがありません。");
define('MSG026', "スレッドが最後の1つなので削除できません。");
define('MSG027', "削除に失敗しました。(ユーザー)");
define('MSG028', "該当記事が見つからないかパスワードが間違っています。");
define('MSG029', "パスワードが違います。");
define('MSG030', "削除に失敗しました(管理者権限)。");
define('MSG031', "記事Noが未入力です。");
define('MSG032', "不適切な文字列があります。");
define('MSG033', "削除に失敗しました<br>ユーザーに削除権限がありません。");
define('MSG034', "アップロードに失敗しました<br>規定の画像容量をオーバーしています。");
define('MSG035', "日本語で何か書いてください。");
define('MSG036', "本文にURLを書く事はできません。");
define('MSG037', "この名前は使えません。");
define('MSG038', "このタグは使えません。");
define('MSG039', "コメントのみの新規投稿はできません。");
define('MSG040', "管理者パスワードが設定されていません。");
define('MSG041', "がありません。");
define('MSG042', "を読めません。");
define('MSG043', "に書けません。");
define('MSG044', "最大ログ数が設定されていないか、数字以外の文字列が入っています。");
define('MSG045', "アップロードペイントに対応していないファイルです。<br>対応フォーマットはpch、spch、chi、psdです。");
define('MSG046', "パスワードが短すぎます。最低6文字。");
define('MSG047', "画像の幅と高さが大きすぎるため続行できません。");
define('MSG048', "不適切なURLがあります。");
define('MSG049', "拒絶されました。");
define('MSG050', "Cookieが確認できません。");
define('MSG051', "連続したパスワードの誤入力を検知したためロックしています。");
define('MSG053', "少し待ってください。");

/* ---------- ADD:2004/03/16 ---------- */

//文字色テーブル '値[,名称]'
$fontcolors = array('#000000,黒'
,'#666666,灰'
,'#003399,青'
,'#990000,赤'
,'#669900,緑'
,'#cc3399,紫'
,'#ff6633,橙'
,'#cccc00,黄'
);

//デフォルト文字色 (旧ログ互換用)
define('DEF_FONTCOLOR', '#666666');


/* ---------- ADD:2004/02/03 ---------- */

//描画時間の書式
//※日本語だと、"1日1時間1分1秒"
//※英語だと、"1day 1hr 1min 1sec"
define('PTIME_D', '日');
define('PTIME_H', '時間');
define('PTIME_M', '分');
define('PTIME_S', '秒');

//＞が付いた時の書式
//※RE_STARTとRE_ENDで囲むのでそれを考慮して
define('RE_START', '');
define('RE_END', '');

//現在のページの書式
//※<PAGE> にページ数が入ります
define('NOW_PAGE', '<span class="parentheses">[<span class="page_number"><strong><PAGE></strong></span>]</span>');

//他のページの書式
//※<PAGE> にページ数が入ります
//※<PURL> にURLが入ります
define('OTHER_PAGE', '<span class="parentheses">[<span class="page_number"><a href="<PURL>"><PAGE></a></span>]</span>');

/* -------------------- */

//メインのテンプレートファイル
define('MAINFILE', 'main');
//レスのテンプレートファイル
define('RESFILE', 'res');

//その他のテンプレートファイル
define('OTHERFILE', 'other');

//お絵かきのテンプレートファイル
define('PAINTFILE', 'paint');
// define('PAINTFILE', 'chickenpaintpaint.html');

//カタログのテンプレートファイル
define('CATALOGFILE', 'catalog');

//カタログの画像幅
define('CATALOG_W', '300');

//編集したときの目印
//※記事を編集したら日付の後ろに付きます
define('UPDATE_MARK', '(編集)');

//日付の書式
//※<1> に漢字の曜日(土・日・月など)が入ります
//※<2> に漢字の曜日(土曜・日曜・月曜など)が入ります
//※他は下記のURL参照
//  http://www.php.net/manual/ja/function.date.php
//define(DATE_FORMAT, 'Y/m/d(<1>) H:i');
define('DATE_FORMAT', 'Y/m/d(D) H:i');

//管理画面(削除モード)の奇数行カラー
define('ADMIN_DELKISU', '#fff');

//管理画面(削除モード)の偶数行カラー
define('ADMIN_DELGUSU', '#fff0f3');

