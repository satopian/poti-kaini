━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

  POTI-board改二
  by sakots >> https://poti-k.info/

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

　このスクリプトは「レッツPHP!」<http://php.s3.to/>の gazou.php を改造
した、「ふたば★ちゃんねる」<http://www.2chan.net/>の futaba.php を、
さらにお絵かきもできるようにして、HTMLテンプレートでデザイン変更できる
ように改造した「ぷにゅねっと」<http://www.punyu.net/php/>の
POTI-board v1.32 をさらにphp7に対応させて改造した
POTI-board改<https://poti-k.info/>を発展させたものです。

　「Skinny」<http://skinny.sx68.net/>
のおかげで、自由にデザインできるようになってます。

　ちなみに、名前は　Punyu.net　Oekaki　Template　Image　の頭文字を取っ
て「POTI」らしいです。


■ご注意

　万が一、このスクリプトにより何らかの損害が発生しても、その責任を私は
　負いません。自己の責任で利用して下さい。

　配布条件は「レッツPHP!」に準じます。改造、再配布は自由にどうぞ。

　このスクリプトの改造部分に関する質問は「レッツPHP!」,「ふたば★ちゃん
　ねる」,「ぷにゅねっと」に問い合わせても答えは得られません。


■バージョンアップ方法　※POTI-board改二 v2.0以降が前提

○本体
・解凍した config.php から、使用中のlot.番号(=日付)以降に追加された設定
を使用中の config.php に貼り付け。
※貼り付ける場所は、<?php ～ ?>の範囲内。

・貼り付けた分の設定をする。

・config.php 以外は解凍したファイルで置き換え。

○テンプレート
・解凍した template_ini.php から、使用中のlot.番号(=日付)以降に追加され
た設定を使用中の template_ini.php に貼り付け。
※貼り付ける場所は、<?php ～ ?>の範囲内。

・貼り付けた分の設定をする。

・template_ini.php 以外は解凍したファイルで置き換えるのが手っ取り早いが、
テンプレートを弄ってた場合は、こちらで用意している最新のテンプレートを
参考に修正して下さい（これもUTF-8で保存する）
※MONO に説明コメントをテンプレート内記載する予定です。

★準備が出来たらアップロードして、管理画面より「ログ更新」を行って下さい。



■設置方法

※以下、簡易説明

　srcディレクトリとthumbディレクトリを作ります。(さくらでは自動で作成されます)
　お絵かき機能を使用する場合は同様にtmpディレクトリも作ります。(さくらでは自動で作成されます)

　設定は、config.phpを書き換えて行います。
　各ファイルを置いたらpotiboard.phpをブラウザから呼出します(必要なファイ
　ルが自動設定されます)

【ディレクトリ構造】
./-- ルート
  ｜.htaccess
  ｜config.php
  ｜htmltemplate.inc
  ｜potiboard.php
  ｜thumbnail_gd.php
  ｜loadcookie.js
  ｜
  ｜※NEO本体
  ｜neo.js
  ｜neo.css
  ｜
  ｜template_ini.php
  ｜nee_catalog.html
  ｜nee_main.html
  ｜nee_other.html
  ｜nee_paint.html
  ｜nee.css
  ｜nee_main.css
  ｜nee_main.css.map
  ｜nee_main.scss
  ｜siihelp.php
  ｜_nee_conf.scss
  ｜
  ＋--./src/       ディレクトリ
  ＋--./thumb/     ディレクトリ
　＋--./skin/      ディレクトリ
    ｜.htaccess
    ｜template_ini.php
    ｜mono_catalog.html
    ｜mono_main.html
    ｜mono_other.html
    ｜mono_paint.html
    ｜mono_main.css
    ｜mono_main.css.map
    ｜mono_main.scss
    ｜siihelp.php
    ｜_mono_conf.scss


※お絵かき機能を使用する場合、下記を追加
./-- 同ルート
  ｜picpost.php
  ｜palette.txt
  ｜
  ＋--./tmp/       ディレクトリ
  ｜
＝＝＝以下のファイルはしぃちゃんのホームページ（Vector）より入手してください＝＝＝＝
  ｜            <http://hp.vector.co.jp/authors/VA016309/>
  ｜
  ｜PaintBBS.jar     バイナリ ※PaintBBSを使用する場合
  ｜spainter_all.jar バイナリ ※しぃペインターを使用する場合
  ｜PCHViewer.jar    バイナリ ※しぃペインター対応版
  ｜
＝＝＝NEOを使用する場合以下をfunigeさんのところから入手してください＝＝＝＝
  ｜           <https://github.com/funige/neo/>
  ｜
  ｜neo.js
  ｜neo.css
  ｜

※メール通知機能を使用する場合、下記を追加
./-- 同ルート
  ｜noticemail.inc
→php7対応版を同梱いたしました


■thanks!!

　　【ぷにゅねっと<https://www.punyu.net/>SakaQさん】
　POTI改の親です。

以下SakaQさんのthanks

　　【ちょむ工房<http://www.chomkoubou.com/>のTakeponG殿】
　picpost.cgi のPHP化ありがとうございます。これのおかげで開発する意欲が
沸きました。

　　【BBS NOTE, PaintBBS(藍珠CGI) その他のお絵かき系CGI】
　いろいろ‥かなり‥パクリました。特にBBS NOTE。やっぱ、BBS NOTEはスゲ
ーや。

　　【菅処】
　サムネイル作成でお世話になりました。ここのバイナリが無ければこのスク
リプトは日の目をみなかったでしょう。

　　【ふたば★ちゃんねる】
　ビバ！虹裏としあきーず・・・て、ち（ry

　　【レッツPHP!】
　いつも勉強になります。もうここ無しではPHP作れないって感じです。

　　【BBSに書き込んでくれる方々】
　不具合報告、貴重な意見等々・・・ホントに助かってます！



■著作権

　POTI-boaed改二                      by sakots

　POTI-board v1.32                   (C)SakaQ「ぷにゅねっと」

【オリジナルスクリプト】
　画像BBS v3.0                       (C)TOR「レッツPHP!」
　 + futaba.php v0.8 lot.031015      (C)futaba「ふたば★ちゃんねる」

【サムネイル側】
　repng2jpeg                         (C)すが「菅処」

【テンプレートクラス】
　Skinny                             (C)Kuasuki

【お絵かき側】
　PaintBBS(test by v2.22_8)
　しぃペインター(test by v1.071all)
　PCH Viewer(test by v1.12)          (C)しぃちゃん「しぃ堂」
　WCS 動的パレットコントロールセット (C)のらネコ「WonderCatStudio」<http://wondercatstudio.com/>


■変更履歴はgithub参照
