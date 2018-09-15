━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

  POTI-board改二 v2.0.0a2 lot.180916
  by sakots >> https://sakots.red/poti/

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

　このスクリプトは「レッツPHP!」<http://php.s3.to/>の gazou.php を改造
した、「ふたば★ちゃんねる」<http://www.2chan.net/>の futaba.php を、
さらにお絵かきもできるようにして、HTMLテンプレートでデザイン変更できる
ように改造した「ぷにゅねっと」<http://www.punyu.net/php/>の POTI-board
v1.32 を、さらにさらにphp7に対応させて改造したものです。

　「テンプレートエンジンSkinny」<http://skinny.sx68.net/>
のおかげで、自由にデザインできるようになってます。

　ちなみに、名前は　Punyu.net　Oekaki　Template　Image　の頭文字を取っ
て「POTI」らしいです。


■ご注意

　万が一、このスクリプトにより何らかの損害が発生しても、その責任を私は
　負いません。自己の責任で利用して下さい。

　配布条件は「レッツPHP!」に準じます。改造、再配布は自由にどうぞ。

　画像のリサイズは、GD版とrepng2jpeg版を用意しています。
　これのチェックスクリプトが当サイト<http://www.punyu.net/php/oekaki.php#check>
　にありますので、これでチェックした後どちらを使用するか決めて下さい。
　repng2jpeg版を利用するには「菅処」<http://sugachan.dip.jp/download/>
　の repng2jpeg が必要です。下記URLから入手してください。
http://sugachan.dip.jp/download/komono.php#repng2jpeg

　このスクリプトの改造部分に関する質問は「レッツPHP!」,「ふたば★ちゃん
　ねる」,「菅処」「ぷにゅねっと」に問い合わせても答えが得られない場合があります。


■設置方法

※以下、nee2を例に簡易説明

　所望のディレクトリのパーミッションを777にします。(さくらでは変更の必要なし)
　srcディレクトリとthumbディレクトリを作り、パーミッションを777にします。(さくらでは自動で作成されます)
　お絵かき機能を使用する場合は同様にtmpディレクトリも作ります。(さくらでは自動で作成されます)

　設定は、config.phpを書き換えて行います。
　各ファイルを置いたらpotiboard.phpをブラウザから呼出します(必要なファイ
　ルが自動設定されます)

【ディレクトリ構造】( )内はパーミッション値。変更の必要がない者は省略。
./-- ルート (動かなければ777)
  ｜config.php
  ｜Skinny.php
  ｜potiboard.php
  ｜thumbnail_gd.php
  ｜thumbnail_re.php
  ｜loadcookie.js
  ｜
  ｜※repng2jpeg版 を使用する場合、以下も必要
  ｜repng2jpeg バイナリ
  ｜
  ｜※NEO本体
  ｜neo.js
  ｜neo.css
  ｜
  ｜※テンプレート「nee2」（同梱）
  ｜template_ini.php
  ｜nee2_catalog.html
  ｜nee2_main.html
  ｜nee2_other.html
  ｜nee2_paint.html
  ｜nee2.css
  ｜nee2_main.css
  ｜nee2_main.css.map
  ｜nee2_main.scss
  ｜siihelp.php
  ｜meta.php
  ｜
  ＋--./src/       (777) ディレクトリ
  ＋--./thumb/     (777) ディレクトリ


※お絵かき機能を使用する場合、下記を追加
./-- 同ルート
  ｜picpost.php
  ｜palette.txt
  ｜
  ＋--./tmp/ (777) ディレクトリ
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
  ｜noticemail.inc (644)
☆ファイルは<http://www.punyu.net/php/>より入手してください
→php7対応版を同梱いたしました


■thanks!!

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

　POTI-boaed改二                     by sakots「赤原文庫」

　POTI-board v1.32                   (C)SakaQ「ぷにゅねっと」

【オリジナルスクリプト】
　画像BBS v3.0                       (C)TOR「レッツPHP!」
　 + futaba.php v0.8 lot.031015      (C)futaba「ふたば★ちゃんねる」

【サムネイル側】
　repng2jpeg                         (C)すが「菅処」

【HTMLテンプレートクラス】
　Skinny                             (C)Kuasuki

【お絵かき側】
　PaintBBS(test by v2.22_8)
　しぃペインター(test by v1.071all)
　PCH Viewer(test by v1.12)          (C)しぃちゃん「しぃ堂」
　WCS 動的パレットコントロールセット (C)のらネコ「WonderCatStudio」
                                        <http://wondercatstudio.com/>


　
■変更履歴
[2018/09/15] v2.0.0a2 lot.180916
・記録

[2018/09/15] v2.0.0a1 lot.180915
・公開
