## [2022/06/30] v5.19.1
- PHP7.1では動作しなくなっている事が確認されたため、必要な動作環境をPHP7.2以上に変更しました。  
PHP7.1環境では、起動せずPHPのバージョンが低い事を伝えるエラーメッセージを出します。  
- 未投稿画像のリンクはコメント未記入で画面から離れてしまったあとでも、再度投稿できるようにするためにあります。  
しかしながら、コメントの記入欄や画像のアップロード欄があり、未投稿画像がない時にも送信フォームが表示されていました。  
未投稿画像が存在しない時はフォームを表示しないようにしました。
- PaintBBSの画像を受け取り処理している`picpost.php`に画像とユーザーデータのファイルの存在確認を追加しました。  
それらの必要なファイルが存在しない時はお絵かき画面から推移せずエラーをアラートで表示します。  
画面を推移してしまうと、投稿に失敗したまま投稿画面の画像も消えてしまうためアラートで知らせます。  

## [2022/06/11] v5.18.25
### バグ修正
- レス省略件数の区切りの横線のレイアウトが崩れていたのを修正しました。  
(テンプレートMONO使用時)
### 改善
- ChickenPaintが全画面で起動するようになりました。
- futaba.phpのログファイルを読み込んで表示できるようになりました。  
カンマの数が一致しない事が原因で発生していたエラーを修正しました。  

## [2022/05/25] v5.18.9
### Klecks更新
Klecksを最新版にアップデートしました。
### CheerpJをv2.3へ
しぃペインター使用時にJavaアプレットをJavaScriptに変換するCheerpJをv2.3に更新しました。
### バグ修正
- テキストの編集時に、不要なスペースが入るバグを修正しました。
- スパム対策のための拒絶する文字列や拒絶するurlに、`/`(スラッシュ)が含まれていると正しく処理できなくなるバグを修正しました。
- テンポラリ不要ファイルの削除処理の経過日数の計算時に軽微なエラーが発生していたのを修正しました。
- 指定経過日数でレスフォームを閉じる時の日時の基準が親の投稿日時ではなく最新レスの投稿日時になっていたのを修正しました。
- Paintフォームの｢Size｣の文字の色指定が他の文字と異なっていたのを修正しました。

### コード整理
- forで記述されていた箇所をforeachへ。file()で開いていたログファイルをfopen()に変更しました。
- PCHアップロードペイントの作業ファイルの削除処理を正規表現を使用する重い関数からstrpos()に変更しました。

### 改善
- トリップ機能を再実装。
隠し機能的な再実装になりますので、テンプレート｢MONO｣でのみ表示できます。
BASICは非対応。
- 空行が存在するログファイルを処理できるようになりました。

リリースから安定版をダウンロードできます。  
[POTI-board EVO v5.18.9 リリース](https://github.com/satopian/poti-kaini/releases/latest)


## [2022/04/27] v5.16.8

### Klecksを更新しました。
- iPadOSで発生するいくつかの問題が修正されました。
- 使用可能な言語に繁体字中文が追加されました。

### テンプレートエンジンBladeOneを更新しました。

- BladeOneをv4.5.3に更新しました。

### 改善

- klecksの送信失敗の原因がサーバーエラーの時はエラー番号をアラートで表示します。
例えば、Klecksのデータを受信する`saveklecks.php`が存在しない時は、｢エラー404｣というアラートを表示します。

- ファイルサイズが指定サイズよりも大きなときに、PNGからJPEGに変換する処理の作業ディレクトリを`TEMP_DIR`に変更しました。
これにより、処理に失敗して作業ファイルのゴミが残っても、テンポラリの掃除機能で不要なファイルとして自動的に削除されるようになります。

### バグ修正
- 動画(PCH)保存ディレクトリ`define('PCH_DIR', 'src/');`に、`'src/'`以外のディレクトリが指定されている時にディレクトリの自動作成が機能せず、NEOの動画、ChickenPaintの`.chi`ファイル、klecksの`.psd`ファイルが保存できなくなっていたのを修正しました。ディレクトリが存在しない時は自動的に作成するようになりました。


## [2022/04/02] v5.16.5.1
### Klecks更新
- レイヤーの最大枚数が8枚から16枚に増えました。
### バグ修正
- テンプレートBASICのバグを修正しました。  
search画面の画像の一覧のリンクが機能していなかったのを修正しました。  
原因はHTMLの文法のミスでした。    
- search画面のHTMLの文法エラーを修正しました。 
`checked="checked"`のクオートがエスケープされて文法チェッカーでエラーになっていました。


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

### バグ修正

- 管理者ログイン時に使うアップロードペイントアプリ固有形式、pch、chi、psdなどの不要になったファイルの自動削除機能の動作時に軽微なエラーが発生するケースがあったのを修正しました。

## [2022/03/12] v5.12.0
### バグ修正
- Apple Pencilでメニューが操作できなくなっていたのを修正しました。  
ChickenPaintやKlecksのメニュー操作がで操作できなくなっていたのを修正しました。  
v3.19.5でペイント関連のテンプレートに追加したJavascriptが原因でした。  
該当のJavascriptを削除して正常に動作することを確認しました。    
### Klecksを更新
- Klecksを最新版にアップデート。  
新しいブラシが追加されました。ミラーペインティングができるようになりました。


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

### バグ修正
- 強制sageが機能しなくなっていたのを修正しました。
- 未定義エラーを含む多くのマイナーなバグが修正されました。

### レガシーなコードを整理
- 古いコードを整理ました。投稿する前にプルダウンメニューでJPEG/PNGを切り替える機能やペイント画面から新しい設定でお絵かきする機能は削除されました。 
- 同梱テンプレートは対応していないものの、機能としては残っているのは文字色選択機能だけになりました。  

## [2022/02/10] v5.05.0

### バグ修正
#### テンプレートBASIC

- テンプレートBASICで管理者モードの時に｢投稿フォーム｣という文字列が｢投稿フォーム｣以外の時にも表示されていたバグを修正しました。
- img.logとtree.logの内容が一致しない時にレス画面に前後の画像を表示する機能で未定義エラーが発生する問題を修正しました。  
しかし、img.logとtree.logの内容が一致しないという時点でそのログファイルは壊れています。  
ログファイルが壊れるようなテストを行っていた過程でみつけた問題です。通常の使用ではログファイルは壊れないと思います。 

### 機能追加
#### 拒絶するURL  
拒絶する文字列で指定された文字列がURLに存在する時は拒絶するようになりました。  
また、拒絶する文字列とは別に使用できないURLの設定項目も追加しました。
```
//拒絶するurl
$badurl = array("example.com","www.example.com");
```
これまでは、URLのスパムワードチェックは何も行われていませんでした。  
### 改善
#### 日記モード

日記モードに設定しても、ペイントボタン下に表示される説明文が表示されたままになっていたのを改善しました。  
しかし、追加の説明文 `$addinfo`は表示する必要があるため、`$addinfo`が存在するときは表示するように工夫しました。

####   古いスレッドでは続きを描くのリンクを表示しない。続きを描くを許可しない。

指定日数を超えた記事の編集をロックするだけでなく、続きを描く(画像の編集)もロックするようにしました。
これらの設定項目を作ったのはパスワードが第三者によって侵害されて記事が改変されるのを防ぐためです。
記事の編集はロックされますがユーザーによる削除はできます。  
また管理者は指定日数を過ぎていてもテキストの編集ができます。    

しかし、一定の指定日数でロックがかかると困る方もいらっしゃると思います。

`define('ELAPSED_DAYS','365');`

`365`で1年以上経過したスレッドはロックされますが、

`define('ELAPSED_DAYS','0');`
  
`0`に設定するとロックされません。

- 描いている最中に指定日数を過ぎてしまった時は新規投稿になります。  
また描いている最中にスレッドが削除されていた時も新規投稿になるようにしました。    


## [2022/01/27] v5.01.03
### 概要

noteにまとめました。
[PHP8\.1対応作業。テンプレートエンジンに苦しめられる。｜さとぴあ｜note](https://note.com/satopian/n/nf69c79b75a4a)

### テンプレートエンジンをbladeOneに変更

PHP8.1環境でSkinny.phpから非推奨のエラーが発生するため、テンプレートエンジンをbladeOneに変更しました。  
しかし、それはテンプレートの互換性がなくなる事を意味します。  
拡張子`HTML`のテンプレートは、拡張子`blade.php`のテンプレートに置き換えられました。  
拡張子が`HTML`ではないのでカスタマイズが難しそうに感じられるかもしれません。
しかし、中身は従来のテンプレートとほとんど同じです。
 
同梱したテンプレートは、これまで同梱していたPINKとMONOをBladeOneで使えるように修正したものです。
PINKの背景色を白に変更。名称もBASICに変更しました。  

BASICは 黒鋼彗牙さんのCOOL SOLIDをベースにして作成したものです。  
著作表記はテンプレートの[LICENCE](https://github.com/satopian/poti-kaini/blob/master/potiboard5/templates/basic/LICENCE.md)にあります。

### テンプレートエンジンの変更で変わった事
#### PHP7.4
- PHP5.6環境でも動作するように開発していましたが、BladeOneのv4.2はPHP7.4以上の環境でなければ動作しない事がわかりました。  
POTI-board EVO v5.xにはPHP7.4以上の環境が必要になりました。  

### 改善
- 日記モードを調整しました。新規投稿は管理者のみに設定してもペイントボタンは表示されたままで、絵を描き終わって投稿を完了させようと思ったら管理パス以外での投稿はできないというエラーになっていました。  
新規投稿には管理パスが必要と設定した時点で新規投稿のためのペイントボタンが非表示になるようにしました。  
管理者投稿画面にお絵かき機能を実装して、管理者はそこからお絵かき投稿が可能になるように作り直しました。


## [2022/01/18] v3.22.8

- 今後のPHPのバージョンアップで文字列の処理にnullを入力できなくなりますが、採用しているテンプレートエンジンSkinny.phpでその箇所のエラーが発生しました。現時点では今後は使えなくなるという警告にどどまっていますがPHP9では動作が停止します。      
そのエラーがでなくなるように修正したのが今回のバージョンになります。  
しかしながら、採用しているテンプレートエンジンでエラーがでるような状況のまま使い続けるわけにもいきませんので、次のバージョンで、**BladeOneにテンプレートエンジンを入れ替え**ます。  
**バージョン3.x系統の開発を今回のバージョンで終了**し、次のメジャーバージョンアップ、**バージョン5にとりかかります**。  
ログファイルの互換性は確保します。  

リリースから安定版をダウンロードできます。  
[POTI-board EVO v3.22.8 リリース](https://github.com/satopian/poti-kaini/releases/tag/v3.22.8)

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

- ChickenPaintの画面の特定の箇所でスワイプすると画面が上下に動く問題がありました。該当箇所をJavaScriptで制御しました。
- 初期設定では、index.html、設定を変更すればfoo.htmlに変更可能なトップページへのリンクが`<a href="./"></a>`となっている箇所が数箇所見つかりました。ほとんどのケースでは問題はでませんが、実害がでてしまっているサイトも存在しているため修正しました。  


## [2021/12/04] v3.15.3
- 新規設置の時に必要なindex.phpを更新しました。  
PHPのバージョンがPHP5.3以下の時にもPHPのバージョンが古い事が原因で動作しない事をエラーメッセージで表示するようにしました。  
これまでは、致命的エラーになっていました。  
そのため設置が成功しない原因がわからなくなっていました。    
- ChickenPaintのパレットを長押しした時にコンテキストメニュー(名前を付けて保存ほか)が開く問題に対応
ChickenPaintのパレットをペンで長押しした時に、不要なマウスの右クリックメニューが開いてしまう問題に対応しました。  
この問題はwindows inkをonにしている時や、Apple Pencil、またはスマホなどで発生していました。
各テーマのPaint画面のテンプレートにJavaScriptを追加する形で対応しましたので、Paint画面のテーマの更新をお願いします。  
同梱したテーマは対応ずみですが、他の作者の方が作成したテーマはまだ未対応かもしれませんし、今後も対応しないかもしれません。  
その場合は各作者の方に対応してもらうか、自分でコードを追加するなどの対応をお願いします。
```
<script>
	function fixchicken() {
		document.addEventListener('dblclick', function(e){ e.preventDefault()}, { passive: false });
		document.querySelector('#chickenpaint-parent').addEventListener('contextmenu', function (e){
			e.preventDefault();
			e.stopPropagation();
		}, { passive: false });
		}
	window.addEventListener('DOMContentLoaded',fixchicken,false);
</script>

```
(同梱テーマは対応ずみ)

- PaintBBS NEOで、コピーやレイヤー結合を行う時に画面が上下に動く問題に対応しました。  
長方形の選択を行う事でコピーやレイヤー結合の操作を行うため、キャンバスからペンが少しはみ出る操作になる事があります。  
この時にNEOのキャンバスが上下に動く事があります。  
windows inkや、Apple Pencilを使っている時に発生します。  
iPad以上の画面の横幅を検出した時にはNEOのキャンバスの周囲の網目の上でスワイプしても画面が動かなくなるようにしました。  
スマホの時は従来と同じ動作としました。ピンチアウトでキャンバスを拡大したときにスワイプできなくなると操作不能に陥るからです。  
こちらも、同梱テーマのみの対応になる可能性があります。  
その場合は各作者の方に対応してもらうか、自分でコードを追加するなどの対応をお願いします。  
```
<script>
	function fixneo() {

		if(screen.width>767){//iPad以上の横幅の時は、NEOの網目のところでtouchmoveしない。
			console.log(screen.width);
			document.querySelector('#NEO').addEventListener('touchmove', function (e){
				e.preventDefault();
				e.stopPropagation();
			}, { passive: false });
		}
	}
	window.addEventListener('DOMContentLoaded',fixneo,false);
</script>

```
(同梱テーマは対応ずみ)

- picpost.php  
エラーメッセージの日本語･英語自動切り替えがiPadの`ja-jp`に対応していなかったを修正しました。  
これまでは、iPadまたは`ja-jp`を返す端末でエラーが発生した時に英語のエラーメッセージが表示されていました。

## [2021/11/23] v3.15.2
### `potiboard.php`の更新内容

- chiアップロードペイント後のファイルの削除処理  
管理者投稿でChickenPaint固有ファイル、chi形式のファイルをアップロードしてキャンバスに読み込んだあとのchiファイルの削除処理が抜けていたのを修正、追加しました。  
今回の修正でアップロードから5分経過していればtempディレクトリから削除されるようになりました。この修正を行う前でも、数日経過すれば不要になったファイルは削除されていました。

- 画像のALT文の見直し。続きを描く時の画像にもイラストのタイトルと作者名  
続きを描く時に表示される画像のALT文にタイトルと作者名が入るようになりました。


## [2021/11/16] v3.12.2

### potiboard.phpの更新内容

- 続きを描く時のthumbnail画像の幅と高さやHTMLの画像の幅と高さの計算方法を修正しました。  
connfig.phpの設定値を最大値としてセットし計算を最初からやり直す形になりました。  
ChickenPaintでは、画像の縦横を回転により変更可能ですが、これまでは回転するたびにサムネイル画像のサイズが小さくなっていました。  
- cookieに実際のキャンバスサイズがセットされるようになりました。これまでは、ユーザーが入力した値がそのままセットされていました。キャンバスサイズには最大値があるため、例えば最大で800pxの時に、8000pxと入力しても、実際に開くキャンバスサイズは800pxです。  
これまではこのようなケースでもcookieに8000pxがセットされていました。  
- 不正な長さのファイル名が入力された時はエラーを返すようになりました。 
- レスナンバーの長さをチェックして不正な長さの時はエラーにを返すようになりました。 
- 返信画面に表示される記事の説明文に親のコメントの全文が表示される仕様を修正し、300バイト以上は省略するようになりました。 

potiboard.phpのアップデートをお願いします。  
### picpost.phpとsave.phpの更新内容
- 外部サイトからの不正な投稿を緩和するため、投稿処理時のusercodeとcookieにセットされたusercodeをチェックするようになりました。

picpost.phpとsave.phpのアップデートをお願いします。

### テーマMONOの単語の修正 

｢書き込む｣を｢送信する｣に変更するなどいくつかのテーマのHTMLの変更を行いましたが機能としては同じなので、v3.12.2のままです。    
リリースのタグもv3.12.2のままですが、zipファイルの中身は更新されています。  

## [2021/10/31] v3.10.1 入力値チェックを強化
- パスワードの長さチェックを追加しました。
- 各入力項目の長さチェックを処理の前半に移動しました。
- 管理画面を表示した時に発生していた軽微なエラーを修正しました。

この問題を修正するために必要なファイルは、`potiboard.php`です。  
`potiboard.php`の上書きアップデートをお願いします。  

## [2021/10/27] v3.10.0 重大バグ修正

- 従来のすべてのバージョンのPOTI-boardに存在する重大な欠陥が見つかりました。  
すべてのログファイルを失う可能性があります。早急に最新版にバージョンアップしてくださいますようお願いいたします。  
- POTI-board v2(改二)を利用されている方へ。   
`potiboard.php`の差し換えのみではv3系統の全機能を使う事はできませんが、この問題に対処する事はできます。  
`potiboard.php`の上書きアップデートをお願いします。  


### [2021/10/27] v3.09.5

- 脆弱なパスワードの使用を防ぐためパスワードが5文字以下の時はエラーメッセージを出すようになりました。エラーメッセージは｢パスワードが短すぎます。最低6文字。｣。
- 第三者による記事の改ざんを防ぐため設定した日数より古いスレッドへの返信をロックする機能を拡張し古い記事の編集もロックするようになりました。  
削除はできます。また管理者は編集･削除ともに従来通り可能です。  

- 以下の設定項目が無い古いconfig.phpを使用すると、画像なしのチェックを入れたり外したりする必要がありました。  

>//画像なしのチェックボックスを使用する する:1 しない:0   
>define('USE_CHECK_NO_FILE', '0');  

このデフォルト値を｢する:1｣ から ｢しない:0｣ に変更になりました。
config.phpのバージョンが古い場合でも｢画像なし｣のチェックを入れたり外したりする必要はなくなりました。  
- サイトの著作リンクの変更。 [https://paintbbs.sakura.ne.jp/poti/](https://paintbbs.sakura.ne.jp/poti/)
 

### [2021/10/14] v3.08.1.1 

- POTI-board EVO v3.08.1 のバグを修正しました。  
必要なJavaScriptを誤って削除していたため、テーマMONOの配色の切り替えに不具合が発生していました。  
このバグの影響を受けるのは、テーマMONOです。PINKには配色切り替え機能がないためこの影響を受けません。    


### [2021/10/09] v3.08.1 

- ブラウザのヒストリーバックやエラー画面の戻るで元の画面に戻った時に送信ボタンが無効化されたままになり操作できなくなる不具合を修正しました。  

### [2021/09/28] v3.07.5
#### 細かなバグの修正
- ブラウザの言語が日本語以外の時にPaintBBSのメニューの表示がおかしくなっていたのを修正しました。 
- 描画時間計算をするしないを判断している箇所の計算方法が間違っていたのを修正しました。描画開始時間が存在しない時にも計算がはじまっていました。
- 投稿処理の途中でエラーが発生しても、未投稿画像からお絵かき画像の再投稿ができるようにしました。ワークファイルの削除を投稿処理のほぼ最後の箇所に移動しました。これまでは、投稿処理の後半でエラーが発生すると、投稿したイラストはサーバに残るものの掲示板には表示できなくなっていました。
#### IDの表示条件の仕様変更

#### 個人識別のためのId

日付が変わってもipアドレスが同じ時は同じIDを表示するようになりました。  
1日の投稿件数が数十件に及ぶケースでは一日限りのIDでも使いみちがありますが、数日間に数件しか投稿がない掲示板ではIDが意味をなさないからです。  
他のPOTI-board系統の掲示板でも同じIDが表示される可能性があります。それを回避したいときは、`config.php`で
```
//ID生成の種
define('ID_SEED', 'IDの種');

```  
を変更すれば、その掲示板で生成されるIDがユニークなものになります。  

#### UI UXを改善

- MONOのスレッドのタイトルをリンクに。
- search の画面の配色を掲示板に近づけました。

#### Chrome、Firefoxのオートコンプリートの改善

記事の編集削除の時に記事番号を入力して編集ボタンを押すと、ユーザー名を記事番号としたセットでパスワードが保存される事がありました。  

この問題を回避するためCSSで非表示にした入力欄を別途作成しました。  
これにより名前をユーザー名としたパスワードの保存が容易になります。

### [2021/08/25] search.php
- config.phpで設定したタイムゾーンがsearchに反映されず、searchの設定を変更しない限り｢Asia/Tokyo｣のままになっていたのを修正しました。  
日本時間に設定していた人の表示はなにも変わりません。


### [2021/08/22] v3.06.8 lot.210822

- ChickenPaintのアイコンが一新されました。

- テーマ MONOの配色を変更しました。  
原色系の配色を見直しました。

-  管理者削除画面  
セキュリティ向上。XSS対策を強化しました。  
1ページに表示する件数を2000件から1000件に変更しました。  

-  アップロードペイントのエラーメッセージを修正  
ファイルをアップロードしてキャンバスに読み込む機能にChickenPaintの｢chi｣ファイルも対応しているため、対応フォーマットの説明に｢chi｣を追加しました。

2021/08/23 ChickenPaintの新しいアイコンが入っていませんでした。  
修正版をリリースしましたのでお手数ですが、ChickenPaintディレクトリの上書きアップデートをお願いします。  
(v3.06.8.1) で修正済み。


### [2021/08/11] v3.05.3 lot.210811
- Tweetや通知メールがHTMLエスケープされた文字化けした文字になるためデコード処理を追加。
- Tweetに使用する、題名と名前に相当する出力の変数を追加。
#### テーマ作者向けの情報
`<% def(oya/share_sub)><% echo(oya/share_sub) %><% else %><% echo(oya/sub|urlencode) %><% /def %>`    
`<% def(oya/share_name)><% echo(oya/share_name) %><% else %><% echo(oya/name|urlencode) %><% /def %>`  
POTI-board本体のバージョンが低い時は新しく追加した変数が未定義になります。  
それを回避するため、テーマのHTMLで、変数が存在していたら新しく設定したTweet用の変数を使い、でなければ古い形式のまま出力としました。

### [2021/08/06] v3.05.2.2
- ChickenPaintがアップデートし、iOS関連の多くの不具合が解消されました。  
パームリジェクション関連の不具合が解消されました。    
手のひらとApple Pencilの識別ができるようになりました。これまでは、意図しない直線が発生していまた。  

### [2021/08/03] v3.05.2 lot.210803
- iPadでChickenPaintを使う時に、意図しないダブルタップズームが発生し、描画が困難になる問題に暫定対応しました。  
各テーマのPaint画面のHTMLの更新をお願いします。
- `<img loading="lazy">`。各テーマの`img`タグに`loading="lazy"`を追加しました。  
ディスプレイに表示されていない範囲の画像を読み込まなくなるので転送量が少しだけ減ります。  


### [2021/07/18] v3.05.1 lot.210716
- 固定トークンを使った、CSRF対策を導入しました。
サイト外部からの不正な投稿を拒絶する事ができます。  
テーマのHTMLがトークンに対応していない時は、  
`define('CHECK_CSRF_TOKEN', '1');`  
を    
`define('CHECK_CSRF_TOKEN', '0');`　
に変更します。テーマが対応していない時にこの設定を有効にすると投稿ができなくなります。  
この設定項目がconfig.phpに存在しない時は、  
`define('CHECK_CSRF_TOKEN', '0');`  
と同じ扱いになります。  
- 出力時にHTMLをチェックする方式に移行しました。管理者もHTMLタグの使用ができなくなりました。  
すでに入力済みのHTMLタグは除去されます。  
除去してさらにエスケープ処理を行ったものを出力します。 
- トップページのフォームと、各スレッドに表示するミニレスフォームを廃止しました。    
静的HTMLファイルにはCSRFトークンをセットする事ができないからです。  
- ChickenPaintがスマホ対応になりました。

### [2021/06/22] テーマMONO
- MONOのCSS切り替えのJavaScriptを大幅に更新。  
非推奨の古いJavaScriptの関数の使用をやめました。  
CSSファイルを外部からセットするのではなく、あらかじめ用意したものを読み込むかどうか指定する形になりました。  
themeディレクトリのHTML全5ファイルの上書きアップデートをお願いします。  

### [2021/06/20] メール通知クラス lot.210620
- 投稿を通知する処理を行っている`noticemail.inc`を改修。多国語対応に。

### [2021/06/17] v3.02.0 lot.210617
- ChickenPaintの画面が選択される問題に対応。
- PaintBBS NEOとしぃペインターの時は、Windows inkや二本指によるジェスチャーでブラウザバックしないようにした。
- potiboard.phpのコードを整理。global変数削減、コンティニュー時の処理をまとめた。
- MONOのCSS切り替えをプルダウンメニューに。

### [2021/06/05] v3.01.9 lot.210605
- 日本語に翻訳されたChickenPaintの最新版に更新。  
ブラウザの言語が日本語以外の場合は英語で表示。ブラウザの言語が日本語なら日本語で表示。  

- 管理画面のページング
2000件単位で改ページ。  
- メインページとカタログページのページングを改良。  
35頁単位でページングする方式に移行しました。  
- しぃペインターが起動しないCheerpJのバージョンに対処。    
CheerpJの起動に必要なJavaScriptのurlをpotiboard.phpで管理するようになりました。  

### [2021/05/23] v3.00.3 lot.210523
- ChickenPaintを日本語訳対応版にアップデートしました。
- PaintBBS NEOをv1.5.11にアップデートしました。
- `picpost.php`更新。PaintBBS NEOv1.5.11の、エラー発生時はペイント画面にとどまるようにする機能に対応しました。  
- NEOの画像から続きを描く時にJavaのPaintBBSが起動するバグを修正しました。

### [2021/05/15] v3.00.1 lot.210514
- ChickenPaintに対応しました。
- v2.xからv3.xになりました。
- それにともない、改二からEVOに名称変更しました。
- 改二のテーマも引き続き利用できます。

### [2021/04/26] v2.26.8 lot.210426
各テーマの[POTI改公式サイト](https://paintbbs.sakura.ne.jp/poti/)のURLを変更しました。  
著作表記を(C)POTI改 POTI-board redevelopment team.に変更しました。  
テーマの細かな修正を行いました。
別リポジトリで配布していたテーマファイル、[PINK](https://github.com/satopian/pink_for_poti-kaini)を同梱しました。  

### [2021/04/13] v2.26.7 lot.210410

- png2jpgの作業ディレクトリをsrcのリアルパスに。関数化される前と同じ動作になるようにしました。
### [2021/03/20] v2.26.6 lot.210320.0

- レス先が無い投稿の時に添付ファイルでアップロードした画像が画像ディレクトリに残るバグを修正。
- 続きから描いた時に画像の縦横比が正しくセットされないバグを修正。
- v2.12.7 lot.200822 から関数化されたpng2jpgの作業ディレクトリが、srcやtmpではなく、potiboard.phpと同じディレクトリだったのを変更。
- `config.php`の設定例にドメイン名の例示のために予約されているセカンドレベルドメインexample.comを使用。
- テーマのcss修正。

(by さとぴあ)


### [2021/03/09] v2.26.5 lot.210308.0

- v2.26.3の「e-mailとして不正な形式のものはリンクに出さないようにした」に関するバグの修正。

### [2021/03/07] v2.26.3 lot.210306.0

- レス先が存在しないレス投稿の時にE_WARNINGレベルのエラーが発生するのを修正 (by さとぴあ)
  - POTIv1.33b1とは別の方法で、img.logへの書き込み処理が発生しないようにした。
- ユーザー削除のエラー処理でfopen()したファイルが閉じられていなかったのを修正。
- 管理者の削除画面のバグを修正 (by さとぴあ)
  - メールアドレスを検証フィルタに通し、e-mailとして不正な形式のものはリンクに出さないようにした。
  - MD5が表示されなくなっていたのを修正。

### [2021/02/17] v2.26.2 lot.210217.0

- E_WARNINGレベルのエラーが発生していたのを修正 (by さとぴあ)
  - `potiboard.php`のほかに`picpsot.php`に変更があります。

### [2021/02/15] v2.26.1 lot.210215.0

- ログに記録されているメールやURLの形式が正しく無い時は、出力時にチェックしてリンクに出さないよう修正 (by さとぴあ)
- 記事のHTML更新の時に、form()関数がHTMLの枚数分コールされていたのを変数に代入して一回ですむようにした (by さとぴあ)
  - ごくわずかな、わからないぐらいの差です。

### [2021/02/13] v2.26.0 lot.210213.0

- Cookieにセットできない文字列があったのを修正 (by さとぴあ)

### [2021/02/13] v2.23.9 lot.210212.1

- アニメファイル(.pch/.spch)アップロード時のエラーメッセージをtemplate_ini.phpで設定できるようにした (by さとぴあ)

### [2021/02/12] v2.23.8 lot.210212.0

- 最大ログ保持数が未設定または未定義の時はエラーになるようにした (by さとぴあ)
- また、最大ログ保持数の最低値を1000件に設定 (by さとぴあ)
  - 誤った設定によりログファイルと投稿画像を失うリスクの軽減です。
- v2.23.5 lot.210209.0で発生していた、最終ページが10件未満の時に直前のページのログが入り込むバグを修正 (by さとぴあ)
  - おかしくなっていたのは表示部分でログファイルへの影響はありません。
- 最大ログ数をオーバーした時のコードを書き直した  (by さとぴあ)

### [2021/02/10] v2.23.7 lot.210210.0

- 管理者パスワードが未定義の時はエラーにするように (by さとぴあ)
- 管理モードでのみ規制するための文字列が通常の書き込みでも拒絶されていたのを修正 (by さとぴあ)
  - themeの `template_ini.php` にメッセージの追加があります。

### [2021/02/09] v2.23.6 lot.210209.1

- v2.23.5で発生したバグ修正 (by さとぴあ)

### [2021/02/09] v2.23.5 lot.210209.0

- パスワードまたはadminがNULL時かつ、管理パスの変数が設定されていない時に管理モードが開いてしまう事があるのを修正 (by さとぴあ)
config.phpが正しく設定されていればこれまでのバージョンでも問題ありません。

### [2021/02/07] v2.23.3 lot.210207.0

- お絵かきのCookieが無い時に、通常のコメントのCookieがエラーで取得できなくなっていたのを修正 (by さとぴあ)
 `loadcookie.js`の上書きアップデートをお願いします。


### [2021/02/04] v2.23.2 lot.210204.0

- コード整理 (by さとぴあ)
  - コメントのエスケープの関数、入力チェック、改行コードの関数を統合。

### [2021/02/03] v2.23.1 lot.210203.0

- メアド欄にメールアドレスとして正しい文字列が入っていないとリンクを作成しないように修正 (by さとぴあ)
  - sage とか。
- 定数に置き換えたはずのメッセージに日本語が残っていたのを修正 (by さとぴあ)
- ログ保持件数を超えた時にログファイルに大量の空行が発生する現象を修正 (by さとぴあ)
- クッキーの二重Encodeを修正 (by さとぴあ)
- readme.txt 改定 (by さこつ)


### [2021/02/02] v2.23.0 lot.210202.0

- filter_input()で取得可能な変数を関数の引数に使用しない (by さとぴあ)
- 入力チェックの関数化 (by さとぴあ)

### [2021/01/30] v2.22.6 lot.210130.0

- picpost.systemlogの設定をpicpost.phpに移動 (by さとぴあ)


### [2021/01/26] v2.22.3 lot.210126.0

- レス0件省略と表示される事があるバグを修正 (by さとぴあ)

### [2021/01/18] search.php

- PHP8環境で致命的エラーが出るバグを修正 (by さとぴあ)
- 1発言分のログが4096バイト以上の時に処理できなくなるバグを修正 (by さとぴあ)

### [2021/01/05] v2.22.2 lot.210105.0

- 多国語対応。投稿通知メールのメッセージをtemplate_ini.phpで設定できるようにした。(by さとぴあ)
  - `theme/template_ini.php` に設定項目が増えていますが、そもままでも大丈夫です。

### [2021/01/02] v2.22.1 lot.210102.0

- php8でタイムスタンプがログに存在しない時に致命的エラーが発生するのを回避 (by さとぴあ)

### [2021/01/01] picpost.php

- picpost.systemlogのパーミッションもconfig.phpで設定できるようにした。(前回の作業の漏れ)


### [2020/12/24] v2.22.0 lot.201224.0

- config.phpの設定項目を分類しなおし (by さとぴあ)

### [2020/12/22] v2.21.6 lot.201222.0

- タイムゾーンをconfig.phpで設定できるようにした (by さとぴあ)

`potiboard.php` `picpsot.php` を上書き、`config.php` に設定追加。

### [2020/12/21] v2.21.5 lot.201221.2

- 定数が2重定義になるバグを修正 (by さとぴあ)
- 投稿者名の敬称の設定がthemeのHTMLに反映されるようにした (by さとぴあ)
  - 対応テーマが必要です。(mono、nee2は対応済み)

### [2020/12/21] v2.21.4 lot.201221.1

- template_ini_phpで設定した投稿者名の敬称がthemeのHTMLに自動的に反映されるように (by さとぴあ)
  - 主に外国語版向け機能です。

### [2020/12/21] v2.21.3 lot.201221

- 多国語対応。template_ini.phpで、すべてのメッセージを設定できるようにした。(by さとぴあ)

### [2020/12/20] v2.21.2 lot.201220a

- ログファイルに投稿時間(UNIXtimestamp)が記録されていない時に致命的エラーが発生するバグを修正。(by さとぴあ)

### [2020/12/20] v2.21.1 lot.201220

- PHPが出力するファイル、ディレクトリのパーミッションの値を設定できるようにした（by さとぴあ）

### [2020/12/18] thumbnail_gd.php

- webp形式からのサムネイル作成に対応（by さとぴあ）

### [2020/12/18] v2.21.0 lot.201218

- **重要** php8環境で画像から続きを描くとエラーになるのを修正（by さとぴあ）
  - 新しいpicpost.php、search.phpへの差し換えをお願いします。PHP5.5～PHP7.xでも動作します。
- 動画表示モード、続きを描くでの時に画像がない時はエラーにする（by さとぴあ）
  - 画像が無い時はエラー表示「記事がありません」になります。
- webp仮対応（by さとぴあ）
  -画像がアップロードできるだけです。サムネイルは作成されません。しぃペインターやオリジナルのPaintBBSはwebpから続きを描けないので、何を選択してもNEOが起動します。

potiboard.php、picpost.php、search.php のアップデートをお願いします。

### [2020/12/14] v2.20.8 lot.201214

- $_REQUESTによる$modeの取得を廃止

### [2020/12/10] v2.20.5 lot.201209

- `config.php`
  - 「新規投稿でコンティニューする時にも削除キーが必要 必要:1 不要:0」のデフォルト値を0に変更。（パスワードを公開しなくても合作ができる事がわかりにくく、パスワードが公開される事例が多いため。）

- `picpost.php` `readme.txt`
  - 著作リンク（ちょむ工房URL）が現在はまったく別のサイトになっているのを修正。

### [2020/12/07] v2.20.3 lot.201207

- php8ではE_WARNINGレベルのエラーになるUndefined offsetを修正（by さとぴあ）
- `palette.txt` せぴあ→セピア(ひらがなからカタカナへ)

### [2020/12/02] v2.20.2 lot.201130

- 旧PaintBBSのPCHファイルの動画再生と続きを描くに対応
- 旧PaintBBSのPCHファイルアップロードペイントが可能に
  - (テンプレートに更新があります）

### [2020/11/27] v2.20.1 lot.201127

- 描画時間関連の軽微なエラーを修正（by さとぴあ）

### [2020/11/25] v2.20.0 lot.201123

- 続きを描いた時の描画時間を合計表示に
  - 従来は1時間10分2秒+2分6秒のように+で描画時間をつないでいましたが、1時間12分8秒のような描画時間の合計になります。従来の表記も選択可能です。
- 今回更新が必要なファイルは、`potiboard.php`、`thumbnail_gd.php`（できれば）、`config.php`（設定を変更したい場合のみ）です。

### [2020/11/22] v2.19.5 lot.201121

- 動画から続きを描く時に動画ファイルをしらべて、元のアプレットで開くようにする処理を追加しました。
- 設定を変更してお絵かきできるテーマを使用した時に発生していたバグおよび問題を修正しました。（by さとぴあ）

### [2020/11/21] v2.19.3 lot.201120

- 続きを描く時に元の画像と違うサイズのキャンバスが開くことがあるバグを修正(by さとぴあ)
  - v2.18.10 lot.201103でキャンバスサイズをCookieに記録するようになりましたが、そのキャンバスサイズが続きを描く時のキャンバスサイズにも反映されてしまうバグが見つかり報告がありました。続きを描く時のキャンバスにCookieのキャンバスサイズは使用されなくなります。

### [2020/11/17] v2.19.2 lot.201117

- lot.201110（2.19.0～）の投稿完了時間が記録されないバグを修正。
  - picpost.phpの上書きアップデートが必要です。

### [2020/11/13] v2.19.1 lot.201112

- フォームが閉じられているスレッドへの投稿はエラーにする(by さとぴあ)

### [2020/11/11] v2.19.0 lot.201110

- 未投稿画像からの投稿でもレス先への投稿になるように(by さとぴあ)
  - potiboard.phpとpicpost.phpの更新が必要です。

### [2020/11/08] v2.18.11 lot.201108

- ファイルサイズが2MBを超えている時のエラー処理の追加(by さとぴあ)
  - `$_FILES['userfile']['error']`を使ったエラーチェックを行うようにし、ファイルサイズが大きすぎる時のエラー処理が入るようにしました。サイズが大きすぎて画像がアップロードされなかった時はエラー表示になりスクリプトの実行は中断されます。

### [2020/11/04] v2.18.10 lot.201103

- キャンバスサイズ、パレット、アプレット選択の値をCookieに保存(by さとぴあ)
  - potiboard.phpとloadcookie.jsの更新が必要です。

### [2020/11/02] v2.18.9 lot.201101

- リファクター及びオートリンクの仕様変更とloadcookie.jsの更新(by さとぴあ)

### [2020/10/30] v2.18.8 lot.201028

- 逆変換テーブルのリファクターと関連するバグを修正(by さとぴあ)

### [2020/10/28] v2.18.7 lot.201026

- 軽微なエラーの修正とわかりやすい変数名への変更(by さとぴあ)

### [2020/10/24] v2.18.6 lot.201024

- 描画時間の$ptimeが未定義変数になるケースがあったのを修正。(by さとぴあ)

### [2020/10/24] v2.18.5 lot.201023

- 書き込み可能かどうかのチェックの必要がないファイルをチェックから除外。関数整理。（by さとぴあ）

### [2020/10/09] v2.18.3 lot.201008

- 画像なしのチェックボックスによるチェックは面倒なので、その機能を使用しないオプションを追加(by さとぴあ)

### [2020/10/02] v2.18.2 lot.201002

- 管理パスの厳密化(by さとぴあ)
- hiddenフィールドにパスワードの入力値がそのまま表示されていたのを修正(by さとぴあ)
- search.php
  - 波ダッシュと全角チルダを区別しない、ログの区切りのカンマの数がひとつ多かったのを修正(by さとぴあ)
- config.php
  - ログ保存件数1000は少なすぎるので2000に増やした

### [2020/09/22] theme、NEO

- 一度投稿ボタンを押すと2度目は無効になる、jQueryを使ったスクリプトをthemeに追加。
- NEO更新
  - 投稿ボタン連打でテンポラリに同じ画像が何枚も入る、続きを描く時にNEOの投稿ボタンを連打→画像がありませんとなる、このような問題を回避できます。

### [2020/09/15] v2.18.1 lot.200915

- potiboardphp search.php search.htmlに変更があります。
  - potiboard.php コード整理。行数を30行短縮。
  - search.php search.htmlの不具合の修正
  - ページ番号未入力の時にページ数が正しく認識されていなかったバグを修正。
  - 反復処理が入れ子になっていた箇所を修正。

### [2020/09/10] v2.18.0 lot.200910

- パレット切り替え機能でパレット名を任意に設定できるように(by さとぴあ)
  - potiboard.phpとconfig.phpに変更があります

### [2020/09/08] v2.17.0 lot.200908

- 記事編集しても投稿日時を変更しないようにする設定をconfig.phpに追加他(by さとぴあ)
  - potiboard.php、config.php、thumbnail_gd.php に変更があります。

### [2020/09/06] v2.16.3 lot.200906

- コード整理(by さとぴあ)
  - function filter_input_default 一箇所でしか使っていない、他の変数で使う訳でもない、ユーザー定義関数を整理
  - thumbnail_gd.php サムネイルの作成に失敗したときの返り値をFalseに変更

### [2020/09/02] v2.16.0 lot.200902

- パレットデータファイル切り替え機能を追加(by さとぴあ)
  - **config.phpに設定の追加があります**
- クリックしても何も起きない箇所のlabelタグを整理(by さとぴあ)

### [2020/08/31] v2.15.2 lot.200831

- コード整理(by さとぴあ)
- thumbnail_gd.php
  - サムネイルの作成に失敗していても、幅と高さの情報が返り値に入る可能性があったのを修正(by さとぴあ)

### [2020/08/31] v2.15.1 lot.200831

- **重要** 親の投稿が最新のときにレス画面が表示されないバグ修正

### [2020/08/30] v2.15.0 lot.200830

- 投稿途中の画像の本人確認の処理を修正 (by さとぴあ)
  - thumbnail_gd.phpも更新。


### [2020/08/29] v2.14.1 lot.200829

- コード整理(by さとぴあ)
  -「お絵かきコメント」「画像差し換え」のglobal変数をローカル変数に。
  - 描画時間の計算を「投稿フォーム」から「お絵かきコメント」に移動。

### [2020/08/28] v2.14.0 lot.200828

- 「投稿途中の絵」からの投稿でも描画時間がでるように (by さとぴあ)
- 描画時間に関する情報をuserdataに記録する方式への移行 (by さとぴあ)
  - コメントを記入しなかったお絵かき画像の投稿は「投稿途中の絵」からの投稿になります。しかし、その場合は描画時間を表示する事ができませんでした。また、描画時間が入っていても信頼性がかなり低い状態でした。 これらの問題を解決するため、描画時間の元となるお絵かき開始時間と終了時間を、userdataに記録するようにしました。**potiboard.phpだけでなく、picpost.phpの更新も必要になります。picpost.phpの上書きアップデートを同時に行わなければ描画時間は表示されなくなります。**


### [2020/08/25] v.2.12.11 lot.200825

- カタログのHTMLの縦横比が正しくなかったの修正(by さとぴあ)
- ソースコード整理(by さとぴあ＆きつねこ)
  - 使用されていない定数USE_MBを削除
  - create_res() にオプション引数を追加して、動画チェックを行うかどうかを選べるようにした
  - 親レスでしか使われていない値のセットをcreate_res() の外に出した


### [2020/08/23] v.2.12.9 lot.200823

- ソースコード整理(by きつねこ)
  - img.log 行からレス表示用データの生成ロジックを関数化など

### [2020/08/23] v.2.12.8 lot.200823

- $pictmp,$picfileを関数内に移動。カタログモードの時の画像のHTMLHTMLの幅と高さを出力できるようにした。(by さとぴあ)


### [2020/08/18] v.2.12.6 lot.200822

- v2.8.9の削除キー未入力時のバグを修正(by さとぴあ)

### [2020/08/18] v.2.12.5 lot.200818

- template_ini.phpのパスと未定義定数の確認(by さとぴあ)

### [2020/08/17] v.2.12.4 lot.200817

- 異常系を前に出してネストを浅くした(by きつねこ)

### [2020/08/17] v.2.12.3 lot.200817

- ソースコード整理(by きつねこ)

### [2020/08/13] v2.12.0 lot.200813

- テンプレートが利用できない場合にもエラーを出せるよう修正(by きつねこ)

### [2020/08/12] v2.11.0 lot.200812

- 動画表示時には `$shi` がなくても動画ファイルの存在で種類をチェックするよう修正(by きつねこ)

### [2020/08/10] v2.10.2 lot.200810

- 元画像、サムネ、動画　を削除している箇所を関数化(by きつねこ)

### [2020/08/10] v2.10.1 lot.200810

- pchかspchかチェックする場所を関数化(by きつねこ)
- is_file ～ unlink を関数化

### [2020/08/10] v2.10.0 lot.200810

- サーバーのPHPバージョンが古い場合エラーを出して動作を停止するよう修正
  - POTI-board改二の動作にはphp5.5以上の環境が必要です。

### [2020/08/08] v2.9.13 lot.200808

- ソースコード整理(by きつねこ)
  -描写時間計算ロジックを関数化

### [2020/08/05] v2.9.10 lot.200806

- ソースコード整理(by きつねこ)
  - 参照代入を値代入に変更、不要なunsetを削除
  - foreach内で1行ずつ改行コードを追加しているのを implodeで挟むよう修正


### [2020/08/03] v2.9.8 lot.200803

- カタログにレス数を表示できるように変数を追加(by funige)

### [2020/08/01] v2.8.14 lot.200801

- 新規投稿時に画像ファイルがあるときは、画像のアップロードが成功しましたとでていたが、でなくなっていたのを修正。
- オートリンク関連(by さとぴあ)


### [2020/07/31] v2.8.7 lot.200731

- ソースコード整理(by きつねこ)
  - 必ず代入される箇所を三項演算子に置換
  - 各種処理後のリダイレクトを関数化

### [2020/07/31] v2.8.6 lot.200731

- 続きを描くでneoのpchなのにしぃペインターが起動してしまうバグ修正(by さとぴあ)

### [2020/07/29] v2.8.5 lot.200729

- トリップ廃止の後方互換性確保
- `function head()` → `function basicpart()`

### [2020/07/29] v2.8.3 lot.200729

- トリップ廃止
- メールアドレスが入っていてもIDを表示。

### [2020/07/26] v2.8.0 lot.200726

- 管理者画面にアップロード欄を出す時の処理を変更(by さとぴあ)
  - 画像アップ禁止コメントのみも禁止の時は投稿フォームをださない

### [2020/07/25] v2.7.9 lot.200725

- 画像アップロード禁止でも管理者は許可
- コメントのみの新規投稿を拒否するしないの新規設定項目を追加。

### [2020/07/25] v2.7.8 lot.200725

- 画像アップロード機能を使う、使わないを設定可能できるように

### [2020/07/24] v2.7.7 lot.200723

- 負荷削減。カタログモードの時はpchの存在確認の処理をしない(by さとぴあ)

### [2020/07/23]

- index.php(初期動作用)を同梱
  - 設置がより簡単になりました。

### [2020/07/14] v2.7.6 lot.200714

- `<% echo (oya/encoded_name) %>` `<% echo (oya/res/encoded_name) %>`追加(by さとぴあ)
- search.phpをリポジトリに統合

### [2020/07/13] v2.7.5 lot.200712

- 文字列のエラーチェックを先に行いGDを使った画像関連の処理はそのあとで(by さとぴあ)

### [2020/07/12] v2.7.4 lot.200711

- 規定容量を超えるとJPEGに変換、JPEGとPNGを比較してファイルサイズが小さなほうを出力(by さとぴあ)

### [2020/07/10]

- テーマ開発用のファイルを削除しリポジトリを分離[poti-kaini-themes](https://github.com/satopian/poti-kaini-themes)

### [2020/07/10] v2.7.3 lot.200708

- 投稿されたPNG画像が指定kbを超えた時にJPEG化する処理の調整(by さとぴあ)

### [2020/07/05] v2.7.2 lot.200704

- 本文へのURLの書き込みを禁止時、通常の投稿でも削除キーが管理パスと一致すればurlの投稿ができるように

### [2020/07/01] v2.7.1 lot.200701

- neoのpchかどうかの確認時に使用する関数をバイナリセーフなものに(by さとぴあ)

### [2020/06/30] v2.7.0 lot.200630

- 動画再生の時にNEOのpchかJavaのpchかを判定(by さとぴあ)

### [2020/06/26] v2.6.8 lot.200625

- php5.6,php7.2の時に致命的エラーが発生していたv2.6.3以降のバージョンの文法ミスを修正。
- 画像アップロードやNEOのPNGファイルも設定したファイルサイズの上限を超過した時はJPEGに変換、そのJPEG画像がファイルサイズに違反していなければ投稿できるようにした。
- それにともないHTMLのフォームによるファイルサイズの制限を2MB、picpost.phpで受信できる画像のファイルサイズを3MBにそれぞれ緩和。


### [2020/06/02] v2.6.4 lot.200602

- 文字色選択のバグ修正
- config初期値変更
- メール通知設定整理 (by さとぴあ)

### [2020/06/02]

- loadcookie.js with文の見直し

### [2020/05/27]

- Skinny.php 設定変更（キャッシュを1時間→1日に）

### [2020/05/22]

- suEXECを導入してあるサーバーで動かない可能性があるのを修正(Skinny.php)


### [2020/05/20] v2.5.0 lot.200520

- スキン/テンプレートの呼び名を「テーマ(テンプレート)」に
- デフォルトテーマ(テンプレート)のディレクトリ名変更

### [2020/05/19] v2.4.0 lot.200519

- Firefox、およびcheerpJのインストールなしでもchromeでしぃペインターが使用可能に

### [2020/05/18] v2.3.3 lot.200518a

- 強制サムネイル機能を削除 (thumbnail_gd.phpのバージョンアップがあります)

### [2020/05/17] v2.3.0 lot.200517e

- ユーザー削除権限の変更(config.phpに変更があります) (by さとぴあ)

### [2020/05/17] v2.2.7 lot.200517c

- 「投稿者名をコピー」機能搭載。(by さとぴあ)

### [2020/05/17] v2.2.5 lot.200517a

- configの説明追加、デフォルト値変更。
- アプレットのセキュリティチェックに引っかかった場合のURL用htmlファイルを同梱。
  - デフォルト設定ではお絵かき掲示板のindex.htmlに飛ばされてしまうため、なぜ投稿失敗したのかがわからないから。
  - セキュリティにヒットした場合の飛び先を define('SECURITY_URL', './security_c.html'); に設定変更してください。


### [2020/05/16] v2.2.0 lot.200516b

- ミニレスフォームを日数経過で閉じる機能追加（スキンの仕様が変わりました）
- v2.1までとconfigの互換性がなくなっていますので注意。（CRYPT_PASSが大文字になっただけです）
- configデフォルト変更

### [2020/05/15] v2.0.6　lot.200515

- PROXY_CHECK関連のコードを削除(by さとぴあ)

### [2020/05/15] v2.0.4　lot.200515

- 改行の抑制とProxyチェックを廃止(by さとぴあ)

### [2020/05/15] v2.0.2　lot.200515

- palette.txtの読み込み処理(by さとぴあ)

### [2020/05/15] v2.0.1　lot.200515

- 独自タグ廃止に関するエラー修正。(2.0.0動かないです)
- スキン修正

### [2020/05/15] v2.0.0　lot.200515

- $_GETで記事の編集をできないように変更(byさとぴあ)
- 独自タグ廃止
- noticemailのutf-8以外を削除
- 満を持して2.0.0として公開

### [2020/05/14] v2.0.0a6

- デフォルトスキン変更、スキンフォルダ作成 (config.php要再設定！)
- palleteの問題に暫定対処

### [2020/05/14] v2.0.0a5

- htmlの生成に成功(byさとぴあ) 大感謝。
- スキンのエラー修整。

### [2018/09/15] v2.0.0a1

- プロジェクト開始
- ログが生成されるのは確認、HTML生成されず