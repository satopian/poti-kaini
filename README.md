# お絵かき掲示板 PHPスクリプト POTI-board EVO

![POTI-board EVO](https://user-images.githubusercontent.com/44894014/130365226-565801a0-da27-4a13-a684-ef849769c0b4.png)

お絵かき掲示板PHPスクリプトPOTI-boardを改良していくプロジェクトです。  

## 動作環境
PHP7.2～PHP8.2  
## そのほかのバージョン
English translated version is here. [POTI-board EVO-EN](https://github.com/satopian/poti-kaini-EN)  
繁體中文版本 [POTI-board EVO-zh-TW](https://github.com/satopian/poti-kaini-zh-TW)


## 古いバージョンに存在する重大なバグ
- [v2.26.0以前のPOTI-boardにはXSSの脆弱性があります。](https://github.com/satopian/poti-kaini/issues/11)  
悪意のあるJavaScriptが実行される可能性があります。

- v3.09.5以前のPOTI-boardのすべてのバージョンには重大な欠陥があります。  
すべてのログファイルを失う可能性があります。  

また、v3.x系統のPOTI-boardはPHP8.1環境で非推奨のエラーがでます。  
現時点では警告ですがPHP9で動作が停止します。
そのためのv5.xの開発です。  
v5.xの利用をよろしくお願いします。

## 概要

v3.0で従来の[PaintBBS NEO](https://github.com/funige/neo/)、しぃペインターに加え高機能なHTML5のペイントアプリ[ChickenPaint](https://github.com/thenickdude/chickenpaint)の使えるようになりました。  
スクリプトの名称はPOTI-board EVO(Evolution)になりました。 
PHP8.1～PHP9に対応するためにテンプレートエンジンをBladeOneに変更し、potiboard.phpのコードの見直しを行いました。  
v3.x系統の開発は終了し、v5.xになりました。  
v3.xのテンプレートは使えなくなりました。  
v5.xに対応したテンプレートをご利用ください。  
v5.10.0で、新しいHTML5のペイントアプリ[klecks](https://github.com/bitbof/klecks)が使えるようになりました。  

[POI\-board EVO v5\.x で変わる事 · Discussion \#15](https://github.com/satopian/poti-kaini/discussions/15)

## POTI-board EVO (ChickenPaint対応版)

![ChickenPaint](https://user-images.githubusercontent.com/44894014/130365082-a94773a6-8d4f-4bd9-aad0-b35406951a38.png)


## 設置

設置はとても簡単です。  
potiboard5ディレクトリをアップロードして、アップロードしたディレクトリにアクセスするだけで設置できます。  
管理者パスワードの設定は必須です。  
config.phpの最初の数行に必須設定項目がありますので、変更してください。  
[お絵かき掲示板簡単設置方法](http://satopian.sblo.jp/article/189094093.html)

## サンプル/サポート

[お絵かき掲示板PHPスクリプトPOTI-board改公式サイト](https://paintbbs.sakura.ne.jp/poti/)と、[設置サポート掲示板](https://paintbbs.sakura.ne.jp/cgi/neosample/support/) をオープンしました。ご利用ください。  
設置サポート掲示板にはさとぴあが常駐しています。

## 古いPOTI-boardとの互換性
- ログファイルの形式は同じです。どのバージョンのPOTI-boardのログファイルでも動作します。 

## v3.x以前のPOTI-boardからのバージョンアップ

### 上書きアップデートが必要なファイル
- `potiboard.php`
- `search.php`
- `save.php` 
- `picpost.php` 
- `config.php`の再設定が必要です。新しい`config.php`を使用して再設定する必要があります。  

### 新しく追加されたファイル

- `saveklecks.php`

## 追加されたディレクトリ
- `lib/`  
- `chickenpaint/`
- `klecks/`
- `BladeOne/`
- `templates/`  

拡張子`blade.php`のファイルがHTML部分です。CSSファイルも`templates/`ディレクトリの中にあります。  
`parts/`ディレクトリにもいくつかの`blade.php`形式のファイルが入っています。
[laravel-blade - Visual Studio Marketplace](https://marketplace.visualstudio.com/items?itemName=cjhowe7.laravel-blade)を使うとBladeの文法にそって色分けされて表示されます。  
これによりBladeのHTMLファイルの編集が容易になります。  
エディタも拡張機能も無償で利用できます。  

## テンプレート機能について

この掲示板はテンプレートを入れ替える事ができます。  
`BASIC`と`MONO`2種類のテンプレートを同梱しました。  

#### 同梱テンプレート MONOの配色の変更について
MONOのHTMLとCSSをv3.07.5で大幅に更新しました。   
そのためv3.07.5より古いCSSファイルを使用すると一部のデザインが正しく表示されなくなります。  
たとえば、フッターやカタログの見た目が意図通りになりません。  
その場合は、カスタマイズしたCSSファイルと同じ配色のCSSと同じになるように作り直す必要があります。
もし配色のみを変更したいのであれば、SCSSファイルもありますのでどうぞご利用ください。

SCSSファイルは[mono/css/dev/sass/](https://github.com/satopian/poti-kaini/tree/master/potiboard5/templates/mono/css/dev/sass)ディレクトリに入っています。
配色とその他のデザインに設定が分かれているため、配色を容易に変更できます。  
[Visual Studio Code – コード エディター](https://azure.microsoft.com/ja-jp/products/visual-studio-code/)と拡張機能[DartJS Sass Compiler and Sass Watcher](https://marketplace.visualstudio.com/items?itemName=codelios.dartsass)
があればコンパイルできます。エディタと拡張機能どちらも無償で利用できます。

## 外部プログラム
[potiboard_plugin: お絵かき掲示板 POTI-boardのための外部phpプログラム](https://github.com/satopian/potiboard_plugin)  
パレットデータ(やこうさんパレット)、BBSNoteのログファイルをPOTI-board形式に変換するログコンバータなどがあります。

## 独自タグ

HTMLタグも旧独自タグも廃止してしまいましたが、urlの自動リンクは使えます。  
また、マークダウン形式のテキストリンクも使えます。

`[テキストリンク](https://example.com/)`と書くと  
[テキストリンク](https://example.com/)のようなテキストリンクを作成できます。

## 最新のリリース

- [リリースから安定版をダウンロードできます。](https://github.com/satopian/poti-kaini/releases/latest)

## 履歴

## [すべての履歴はこちら](./changelog.md)

## [2022/01/13] v5.55.8

### WAFによる誤検知のエラーを回避するためPaintBBS NEOの通信を生データからformDataに変更しました。
- 従来のお絵かき掲示板に投稿できるようにするために、生データを送信していたNEOを改造して、formDataでヘッダ、画像、動画データを送信できるようにしました。
この変更によって、従来のWAFがNEOの送信データを攻撃と判断して遮断する確率が低くなり投稿が成功する確率が飛躍的に高くなります。  
NEOはこれまで生データを古い掲示板との互換性を確保するために送信してきました。今回の独自拡張でによってそれが、formDataに変わります。
現時点では独自規格ですが規格が乱立するのはよくない事ですので、開発元にプルリクエストを出しています。  

#### 重要な変更点

- しぃペインターのデータの受信はこれまで通り、`picpost.php`で行います。  
しかし、PaintBBS NEOのデータの受信は、新しく追加した、`saveneo.php`で行います。  
このファイルのアップロードを忘れると、NEOからの投稿ができなくなりますので、必ずアップデートしてください。  
potiboard.phpと同じディレクトリに転送します。
- Paint画面のテンプレートの更新
```
mono_paint.blade.php  
paint.blade.php  

```
の更新をお願いします。
formDataで送信するモードに切り替えるためのパラメータが追加されています。
ここで重要なのは、neo.jsがブラウザによってキャッシュされている場合です。  
新しいバージョンのneo.jsがブラウザに読み込まれる前に、その他のファイルが更新された時は、saveneo.phpによる受信に失敗します。

### 使用するお絵かアプリの設定方法

> //PaintBBS NEOを使う 使う:1 使わない:0 
> define("USE_PAINTBBS_NEO", "1");
> //しぃペインターを使う 使う:1 使わない:0 
> define("USE_SHI_PAINTER", "1");
> //ChickenPaintを使う 使う:1 使わない:0 
> define("USE_CHICKENPAINT", "1");
> //klecksを使う 使う:1 使わない:0 
> define("USE_KLECKS", "1");
> //管理者は設定に関わらすべてのアプリを使用できるようにする する:1 しない:0
> define('ALLOW_ADMINS_TO_USE_ALL_APPS_REGARDLESS_OF_SETTINGS', '1');
> 

これまでは、PaintBBS NEOを使用するアプリから外す事ができませんでしたが、NEOを使う使わないも選択可能になりました。  
すべて使わないに設定すると、お絵かき機能を使用しない設定になります。  
Klecksだけ使う、ChickenPaintだけ使う設定にする事もできます。
使用するアプリが1つしか無い時はアプリ選択のプルダウンメニューが消えてすっきりした画面になります。    

### 描画時間による制限

たとえば1分以下で描いた線だけの投稿は拒絶したい時は、

```
//セキュリティタイマー(単位:秒)。設定しないなら""で
define("SECURITY_TIMER", "");

```
で必要最低限の描画時間を指定する事ができましたが、これまでは、しぃペインターと、PaintBBS NEOにのみ有効でした。  
今回の更新で、ChickenPaintやKlecksでもこの設定が有効になるようになりました。  
古い方式では、違反の時は別のサイトに飛ばす(例えば警視庁のサイト)がありましたが、その方式ではなく、｢描画時間が短すぎます。あと30秒。｣といった内容のアラートが開きます。  


## [2022/12/28] v5.52.2

### PaintBBS NEOの動画ファイルのアップロードペイントが簡単に
- PaintBBS NEOとJavaのしぃペインターの動画の管理者画面からのアップロードペイントがより簡単･便利になりました。  
これまで動画ファイルをキャンバスに読み込む前にキャンバスサイズを指定する必要がありました。  
v5.52で、動画ファイルからキャンバスサイズを自動的に取得できるようになりました。  
~~ただし、Java版のPaintBBSの動画ファイルのアップロード時にはキャンバスサイズの指定が必要です。~~(v5.22.8で解決)  
HTML5版のPaintBBS NEOの動画ファイルのアップロード時のキャンバスサイズは自動取得できます。  

![221227_005](https://user-images.githubusercontent.com/44894014/209773098-d83a702f-dd79-49e8-9030-c2cdedee266b.gif)
↑  
これは、しぃペインター、PaintBBS NEO、Klecks、ChickenPaintそれぞれの固有形式のファイルを管理者画面からアップロードした時の動作を紹介するために制作したGIFアニメです。  
キャンバスサイズは300x300のままですが、本来のサイズでキャンバスが開いています。  
PSDファイルのダウンロードができるのならアップロードは?と疑問に感じていた方への説明の意味も含めて、ChickenPaintの`.chi`ファイルと、Klecksの`.psd`ファイル(Photoshop形式)のアップロードも行い動画に記録しました。  


## [2022/03/25] v5.16.5

### 改善
### Klecksの日本語訳
![image](https://user-images.githubusercontent.com/44894014/160145766-395c519f-e90e-4397-a92e-03005648906e.png)

- Klecksを日本語に翻訳しました。  
POTI-boardにも、日本語対応版を同梱する事ができました。
この新しいバージョンのKlecksは、ブラウザの言語の優先順位を自動検出して言語を切り替えてくれます。  
また、ブラウザの言語の設定にかかわらず使用する言語を指定する事もできます。  
英語、ドイツ語、日本語が選択できます。  
中文は簡体字のみで細部はまだ英語のままです。  
日本語訳のリソースはすでに開発元に統合されています。

### アプリ固有ファイルのダウンロードボタンができました。
![image](https://user-images.githubusercontent.com/44894014/160225495-64b32f7f-cb3b-4aa9-bebd-2d7453e304b4.png)
#### アプリ固有形式一覧
- `.pch`ファイル(PaintBBS)
- `.chi`ファイル(ChickenPaint)
- `.psd`ファイル(Klecks)

Klecksのレイヤー情報を含むファイルはPhotoshop形式の`.psd`ファイルです。 
ダウンロードした`.psd`ファイルはクリスタやSAIそのほか多くのアプリで開く事ができます。  
`.pch`と、`.chi`は、それぞれNEOとChickenPaintで開く事ができます。    
管理者投稿過画面から`.pch`、`.chi`、`.psd`を添付してペイントボタンを押せば、キャンバスに読み込んで投稿できます。  

####  透過PNG、透過GIFのサムネイルの透明部分を白に変更  

- 透過PNGの透明部分がJPEG化する時に、真っ黒になっていたのを修正しました。  
透明色が黒も間違いではないのですが、意図しない結果になる事が多いため、透過GIF、透過PNGからJPEGに変換する時は、透明色を白に変換します。  

## [2022/03/8] v5.10.0

### 機能追加
- 新しいペイントアプリKlecksに対応しました。

![image](https://user-images.githubusercontent.com/44894014/157234120-d806d24f-2f2b-4600-9d29-515a5743efd6.png)

わかりやすいUIと強力なブラシが使えるアプリです。  
レイヤーは8枚使えます。    
数多くのフィルタが使えます。輝度を透明に変換、明るさ/コントラスト、色調補正など。  

このアプリの追加にともない、管理画面からアップロードできるファイル形式に｢PSD｣が追加されました。  
PSDファイルを選択してペイントボタンを押すとKlecksのキャンバスにPSD画像が読み込まれます。  

### 改善
- 複数の未投稿画像がある時に、一番新しい画像が投稿できるようになりました。    
これまでは、コメント欄のすぐ上の画像は投稿されず画面の一番上の画像が投稿されていました。  

## [2021/12/22] v3.19.5

- 返信画面の下に前後のスレッドと前後のスレッドの画像が表示されるようになりました。   

![image](https://user-images.githubusercontent.com/44894014/147068447-9fda9fbe-bfbe-473a-b318-72be33f54273.png)


- レスの画像からの続きを描く時は｢新規投稿｣もレス画像になりました。  
これまでは、レスの画像から｢新規投稿｣で続きを描くと新規スレッドが作成されていました。  
- 返信したあとに表示される画面がスレッドの返信画面になりました。
これまでは、どの位置のスレッドに返信しても、投稿処理が完了するとトップページが表示されていました。
- レスモード、カタログモードからの編集･削除の処理の完了時にもとの画面が表示されるようになりました。
- 続きを描いて投稿が完了した時にスレッドの返信画面が表示されるようになりました。  
これまでは、35ページ目にある画像から続きを描いた場合でも投稿が完了した時にトップページが表示されていました。  
そのため、投稿した画像がどこにあるのか探さなければならなくなっていました。

