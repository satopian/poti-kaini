# POTI-board改二 デフォルトスキン「MONO」

スキンの解説と履歴です。  
Skinnyのタグは[本家](http://skinny.sx68.net/tag/taglist.html)を見ていただくとして、変数名の解説を行います。

## 変数

### main.htmlで使っているもの

- echo(title) - 掲示板のタイトルです。
- echo(charset) - 文字コード。通常はUTF-8です。
- echo(skindir) - スキンのディレクトリを指します。スキンフォルダにcssや.jsファイルがある場合に使用します。
- def(notres) - 「レス表示モードでない場合」です。
- def(resno) - 「レス表示モードの場合」です。
- echo(rooturl) - 掲示板の設置URLです。ツイッターカードなどで使います。
- echo(self) - スクリプト自身の名前です。通常はpotiboard.phpです。
- echo(self2) - 入口の名前です。なにも変更していなければindex.htmlとなっています。
- def(applet) - 「お絵かきアプレットを使用する場合」です。
- echo(pdefw) - デフォルトのお絵かきサイズ幅です。
- echo(pdefh) - デフォルトのお絵かきサイズ高さです。
- def(anime) - 動画記録を使用するかどうかです。
- echo(animechk) - 動画記録をデフォルトで使用するかどうかです。
- def(form) - 通常投稿フォームを使用するかどうかです。
- echo(maxbyte) - 投稿できる最大ファイルサイズです。
- echo(usename) - 名前が必要な場合のマークです。
- echo(usesub) - タイトルが必要な場合のマークです。
- echo(resub) - 返信時のタイトルです。
- echo(usecom) - コメントが必要な場合のマークです。
- def(upfile) - ファイルアップロードを使うかどうかです。
- echo(maxw) - 画像の縮小表示を開始する幅です。
- echo(maxh) - 画像の縮小表示を開始する高さです。
- echo(maxkb) - 1ファイルの最大投稿データ容量です。
- each(oya) - スレッドです。
- echo(oya/no) - 親記事の番号です。
- echo(oya/sub) - 親記事のタイトルです。
- echo(oya/name) - 親記事を書いた人の名前です。
- echo(oya/trip) - 親記事を書いた人のトリップです。
- echo(oya/now) - 親記事の投稿時刻です。
- echo(oya/id) - 親記事を書いた人のIDです。
- echo(oya/url) - 親記事を書いた人のURLです。
- echo(oya/updatemark) - コメントの修正などをするとつくマークです。
- def(oya/src) - 親記事に画像があるかのチェックです。
- echo(oya/src) - 親記事の画像URLです。
- echo(oya/srcname) - 親記事の画像タイトルです。
- echo(oya/size) - 親記事の画像サイズです。
- def(oya/thumb) - サムネイル表示チェックです。
- def(oya/pch) - 動画があるかのチェックです。
- echo(oya/pch) - 親記事の動画です。
- echo(oya/imgsrc) - 親記事の画像です。
- def(oya/continue) - 続きから描くを使えるかのチェックです。
- echo(oya/tab) - tabindexに使います。
- echo(oya/srcname) - 画像ファイル名です。
- echo(oya/com) - 親記事のコメントです。
- def(oya/limit) - 「もうすぐ消える記事」のチェックです。
- def(oya/skipres) - レスが省略されているかのチェックです。
- each(oya/res) - スレッドのレスです。
- def(oya/res/src) - レスに画像があるかのチェックです。
- 以下、oya/res/... はスレッドの中でのものになりますので省略します。
- def(sharebutton) - SNSシェアボタンを付けるかどうかのチェックです。
- def(resform) - スレッドにレスフォームを付けるかどうかのチェックです。
- def(oya/disp_resform) - レスフォームを表示するか、のチェックです。経過日数で閉じる設定のときに使います。
- def(prev) - 前ページがあるかのチェックです。
- echo(prev) - 前ページのURLです。
- def(next) - 次ページがあるかのチェックです。
- echo(next) - 次ページのURLです。
- def(userdel) - ユーザー削除権限のチェックです。
- echo(ver),echo(verlot) - potiboardのバージョンです。
- echo(tver) - スキンのバージョンです。template_ini.phpを参照します。

### paint.htmlで使っているもの

- def(paint_mode) - お絵かきモードの時のチェックです。
- def(continue_mode) - 続きを描く時のモードのチェックです。
- echo(palettes) - palette.txtを呼び出します。
- echo(w),echo(h) - アプレットスクリプトの幅と高さです。
- echo(picw),echo(pich) - キャンバスの幅と高さです。
- 以下アプレットスクリプト内の説明は今は省略させてください…
- def(pch_mode) - 動画再生モードかどうかです。
- def(passflag) - 続きからか描くのpassの設定です。
- def(newpost_nopassword) - 新規投稿なら削除キーがなくても続きを描く事ができます。のチェックです。
- \<SIIHELP\> - 特殊タグ。siihelp.phpを呼び出します。

### catalog.htmlで使っているもの

- <% each(y) %><% each(y/x) %><% def(y/x/no) %>…　呪文です。tableタグを使用してカタログ表示をしていたころの名残があるためとてもややこしいです。

### other.htmlで使っているもの

- def(post_mode) - 新規投稿モードのチェックです。
- def(admin) - 管理者モードのチェックです。
- def(pictmp) - 投稿されずに残っている画像のチェックです。
- def(admin_in) - 管理モードへ入るための認証画面チェックです。
- def(admin_del) - 管理者削除モードのチェックです。
- echo(pass) - 管理パスです。
- echo(del/no) - 削除する記事の番号です。以下del/... は省略
- echo(all) - 全画像合計サイズです。
- def(err_mode) - エラー画面のチェックです。
- echo(mes) - どのようなエラーが出るかのメッセージです。

### その他

- 下記のような書き方をする事でHTMLに影響を与えないコメントは書くことが出来ます。ただし「展開処理に渡された結果何もしない」という処理を経ているので、コメントとして使えば使うほどページの展開速度は遅くなっていくのでご注意ください。
- \<% こんな風にタグ括弧内にコメントを書けますよ %>

## 注意点

- <% echo(var) %>はvarが存在しないとエラーを吐きます。変数が存在しない可能性がある場合は、必ず<% def(var) %> ~ <% /def %>で囲ってください。
- スキンフォルダ内の.htaccessファイルは、テンプレートのhtmlファイルに直接アクセスできないようにするためのものです。セキュリティ向上のために同梱しています。スキン作成の際はコピーしてお使いください。cssやjsファイルにはアクセスできます。

## 履歴

### [2020/05/16] v1.1.0

- poti2.2.0の経過日数でミニレスフォームを閉じる、に対応

### [2020/05/16] v1.0.10

- [prev][next]調整
- 削除、編集のselectの縦位置調整

### [2020/05/15] v1.0.9

- elsedef整理

### [2020/05/15] v1.0.8

- スマホ時の横幅を広く
- wondercatstudioへのリンクを削除
- レッツPHPへのリンク変更

### [2020/05/15] v1.0.7

- hrのスタイルが不安定なのを解消

### [2020/05/15] v1.0.6

- HTMLのコメントをHTMLとして正しく
- 「その他」（コメントに関して）追加

### [2020/05/15] v1.0.5

- readme整理
- Skinnyのバージョンを削除

### [2020/05/15] v1.0.4

- 一番下へボタン、一番上へボタン追加
- デザイン調整

### [2020/05/15] v1.0.3

- スレッドタイトルの背景など

### [2020/05/14] v1.0.0

- 初版