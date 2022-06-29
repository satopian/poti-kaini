# お絵かき掲示板 PHPスクリプト POTI-board EVO

![POTI-board EVO](https://user-images.githubusercontent.com/44894014/130365226-565801a0-da27-4a13-a684-ef849769c0b4.png)

## お絵かき掲示板PHPスクリプトPOTI-boardを改良していくプロジェクトです。  

## 動作環境
PHP7.2～PHP8.1  
## そのほかのバージョン
English translated version is here. [POTI-board EVO-EN](https://github.com/satopian/poti-kaini-EN)  
繁體中文版本 [POTI-board EVO-zh-TW](https://github.com/satopian/poti-kaini-zh-TW)


## 古いバージョンに存在する重大なバグ
- [v2.26.0以前のPOTI-boardにはXSSの脆弱性があります。](https://github.com/satopian/poti-kaini/issues/11)  
悪意のあるJavaScriptが実行される可能性があります。

- v3.09.5以前のPOTI-boardのすべてのバージョンには重大な欠陥があります。  
すべてのログファイルを失う可能性があります。  

また、v3.x系統のPOTI-boardはPHP8.1で非推奨のエラーが発生します。  
現時点では警告ですがPHP9で動作が停止します。
そのためのv5.xの開発です。  
v5.xの利用をよろしくお願いします。

## 概要

v3.0で従来の[PaintBBS NEO](https://github.com/funige/neo/)、しぃペインターに加え高機能なHTML5のペイントアプリ[ChickenPaint](https://github.com/thenickdude/chickenpaint)の使えるようになりました。  
スクリプトの名称はPOTI-board EVO(Evolution)になりました。 
PHP8.1以降に対応するためテンプレートエンジンをBladeOneに変更しました。  
v3.x系統の開発は終了し、v5.xになりました。  
PHP8.1～PHP9に対応するためにテンプレートエンジンをBladeOneに変更し、potiboard.phpのコードの見直しを行いました。  
v3.xのテンプレートは使えなくなりました。v5.xに対応したテンプレートをご利用ください。  
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

SCSSファイルは`mono/css/dev/sass/`ディレクトリに入っています。
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

## 履歴 おもな変更のみ

