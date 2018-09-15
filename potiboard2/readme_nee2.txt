
POTI-board改二用テンプレート「nee2」v1.0.0 lot.180915
by sakots >> https://sakots.red/

このファイル一式はPOTI-board改二 v2.0.0 以降用に作成されたデザインテンプレートです。
標準でHTML5、レスポンシブ対応。PaintBBSNEOを組み込ませていただきました。

■追記

PaintBBSNEOの組み込みを許可していただきました。figuneさんありがとうございます。
https://github.com/funige/neo/
NEOのバージョンアップは、最新版のneo.jsファイルとneo.cssファイルを上書きしてください。
NEO専用ですのでアプレットのjarファイル要りません。


■各ファイル説明

template_ini.php  テンプレート設定ファイル
nee2_main.html     メイン＆レス テンプレート
nee2_other.html    その他 テンプレート
nee2_paint.html    お絵かき テンプレート
nee2_catalog.html  カタログ テンプレート
nee2_main.css      デザインスタイルシート
nee2_main.css.map  デバック用
nee2_main.scss     編集用sassファイル 使える人は使ってみて
_nee2_conf.scss    sassの色とかの設定ファイル ここで指定してsassをコンパイルするとすごく便利
siihelp.php       専用しぃHELP
palette.txt       専用パレットデータ
meta.php          head内追加メタファイル

■設定

[ config.php ]

お絵かき機能を使用する場合、設定は 2 にして下さい。
　define(USE_PAINT, 2);

利用するアプレットは何を選んでもNEO一択です。
　define(APPLET, 0);

動画機能は使えません。
　define(USE_ANIME, 0);
　define(DEF_ANIME, 0);

コンティニューは画像からできるようです。

■補足

独自タグ非対応、文字色変えも非対応。

■変更履歴

[2018/09/15]
・公開

■最後に

好きに改造していいので俺に生活費か仕事をくれませんかねえ。
