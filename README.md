# POTI-board改二
phpお絵かき掲示板スクリプトPOTI-boardをさらに改良していくプロジェクトです。
  
<a href="https://github.com/funige/neo/">PaintBBS NEO</a>  
<a href="https://github.com/sakots/poti-kai/">POTI-board改</a>  
  
## 概要
POTI-board改で使用しているテンプレートエンジン「htmltemplate.inc」はphp7だとエラーが出てしまうので今後が危ない…  
ということでなんか新しいテンプレートエンジンはないか探したところ、
  
<a href="http://skinny.sx68.net/">Skinny</a>  
  
見つけました！これに移植します！

## 現状

### 各モードの動作確認
htmlが生成されないため、各モードの表示の確認作業を  
- potiboard.php?res=1
- potiboard.php?mode=newpost
- potiboard.php?mode=catalog
- potiboard.php?mode=piccom
- potiboard.php?mode=admin

のように手動で貼り付けて行う事になります。




## 履歴

### [2020/05/13] v2.0.0a4

- htmlは生成されないが、動く。

### [2020/05/07] v2.0.0a3

- いちからつくりなおす。
- ログが生成されるのは確認、HTML生成されず

### [2018/09/16] v2.0.0a2

- 記録

### [2018/09/15] v2.0.0a1

- プロジェクト開始
- ログが生成されるのは確認、HTML生成されず