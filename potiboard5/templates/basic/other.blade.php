{{-- <!--********** その他テンプレート **********
// このテンプレートは、以下のモード用テンプレートです
// ・投稿モード
// ・管理モード(認証)モード
// ・管理モード(削除)モード
// ・エラーモード
--> --}}
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" href="{{$skindir}}basic.css">
	<link rel="preload" as="script" href="lib/{{$jquery}}">
	<title>@if($post_mode and !$rewrite) 投稿フォーム @endif @if($rewrite)
		編集モード @endif @if($admin_in) 管理用 @endif @if($admin) 管理人による投稿 @endif
		@if($admin_del) 記事削除 @endif @if($err_mode) エラー！ @endif - {{$title}} </title>
	{{-- <!-- 
// title…掲示板タイトル
--> --}}
<style id="for_mobile"></style>
<script>
	function is_mobile() {
		if (navigator.maxTouchPoints && (window.matchMedia && window.matchMedia('(max-width: 768px)').matches)){
			return	document.getElementById("for_mobile").textContent = ".for_pc{display: none;}";
		}
		return false;
	}
	document.addEventListener('DOMContentLoaded',is_mobile,false);
</script>
</head>

<body>
	<div id="body">
		<header>
			<h1 id="bbs_title">@if($post_mode and !$rewrite )投稿フォーム @endif @if($rewrite)
				編集モード @endif @if($admin_in) 管理用 @endif @if($admin) 管理人による投稿
				@endif @if($admin_del) 記事削除 @endif @if($err_mode) エラー！ @endif - <span
					class="title_name_wrap">{{$title}}</span></h1>
			{{-- <!-- 
投稿モード
// 【新規投稿、お絵かき投稿、編集】
//
// post_mode…投稿モードのとき true が入る
// regist…新規投稿のとき true が入る
// admin…管理モードのとき 管理者パスワード が入る
// home…ホームページURL
// self…POTI-boardのスクリプト名
// self2…入口(TOP)ページのURL
// pictmp…お絵かき投稿モードフラグ。通常投稿:0、お絵かき絵なし:1、お絵かき絵あり:2
// notmp…お絵かき投稿時に絵がなかったとき true が入る
// tmp…一時保存絵用配列
// tmp/src…一時保存絵URL
// tmp/srcname…一時保存絵ファイル名
// tmp/date…一時保存絵保存日
// ptime…描画時間
// rewrite…編集のとき 記事No が入る
// pwd…編集のとき 記事Pass が入る
// resno…お絵かきレス時 レス記事No が入る
// maxbyte…最大投稿サイズ(Byte)
// maxkb…最大投稿サイズ(KB)
// ipcheck…IPチェック機能がONのとき true が入る
// usename…名前が必須だと ' *' が入る
// usesub…題名が必須だと ' *' が入る
// usecom…本文が必須だと ' *' が入る
// name…編集用の投稿者名
// email…編集用のメールアドレス
// url…編集用のURL
// sub…編集用の題名
// com…編集用の本文
// fctable…文字色配列
// fctable/color…色コードまたは色名
// fctable/chk…編集時、指定文字色なら true が入る
// upfile…添付ファイル入力フォームを表示させたいとき true が入る
--> --}}
			@if($post_mode)
			<!--クッキー読込みは新規投稿のみ-->
			@if($regist)
			<script src="loadcookie.js"></script>
			@endif
			<nav>
				<div id="self2">
					[<a href="{{$self2}}">{{$title}}</a>] </div>
			</nav>
		</header>
		@if($admin)
		@if($regist)

		{{-- ペイントフォーム --}}
		@include('parts.paint_form',['admin'=>$admin])

		@endif
		@endif
		<!--投稿待ちのお絵かき画像表示-->
		@if($pictmp)
			@if($notmp)
			<div class="error_mesage">
			画像が見当たりません。
			<br><a href="#" onclick="javascript:window.history.back(-1);return false;">もどる</a>
			</div>
			@endif
			@if($tmp)
			@foreach ($tmp as $tmpimg)
			<div class="posted_img_form"><img src="{{$tmpimg['src']}}" border="0" alt="{{$tmpimg['srcname']}}"></div>
			{{$tmpimg['srcname']}}<br>
			[{{$tmpimg['date']}}]
			@endforeach
			@endif
		@endif
		@if($ptime)
		<div class="centering">
			描画時間： {{$ptime}}
		</div>
		@endif

		{{-- 未投稿画像の画像が無い時はフォームを表示しない --}}
		@if(!$notmp)

		<form action="{{$self}}" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="token" value="{{$token}}">
			<!--モード指定:新規投稿-->
			@if($regist)
			<input type="hidden" name="mode" value="regist">
			@endif
			<!--モード指定:編集-->
			@if($rewrite)
			<input type="hidden" name="mode" value="rewrite">

			@if($thread_no)<input type="hidden" name="thread_no" value="{{$thread_no}}">@endif
			@if($logfilename)<input type="hidden" name="logfilename" value="{{$logfilename}}">@endif
			@if($mode_catalog)<input type="hidden" name="mode_catalog" value="{{$mode_catalog}}">@endif
			@if($catalog_pageno)<input type="hidden" name="catalog_pageno" value="{{$catalog_pageno}}">@endif
			@if(!$catalog_pageno)<input type="hidden" name="catalog_pageno" value="0">@endif

			<input type="hidden" name="no" value="{{$rewrite}}">
			<input type="hidden" name="pwd" value="{{$pwd}}">
			@endif
			@if($admin)
			<input type="hidden" name="admin" value="{{$admin}}">
			@endif
			@if($pictmp)
			<input type="hidden" name="pictmp" value="{{$pictmp}}">
			@endif
			@if($ptime)
			<input type="hidden" name="ptime" value="{{$ptime}}">
			@endif
			<!--レスお絵かき対応-->
			@if($resno)
			<input type="hidden" name="resto" value="{{$resno}}">
			@endif
			<input type="hidden" name="MAX_FILE_SIZE" value="{{$maxbyte}}">
			<table id="post_table">
				@if($ipcheck) <tr>
					<td colspan="2" style="text-align: center;" class="post_table_submit td_noborder">- IPアドレスチェック中 -
					</td>
				</tr> @endif
				<tr>
					<td class="post_table_title">名前 @if($usename) (必須) @endif</td>
					<!--編集時、valueに名前をセット-->
					<td><input type="text" name="name" @if($name) value="{{$name}}" @endif class="post_input_text"
							autocomplete="username"></td>
				</tr>
				<tr>
					<td class="post_table_title">E-mail</td>
					<!--編集時、valueにメールアドレスをセット-->
					<td><input type="text" name="email" @if($email) value="{{$email}}" @endif class="post_input_text"
							autocomplete="email"></td>
				</tr>
				<tr>
					<td class="post_table_title">URL</td>
					<!--編集時、valueにURLをセット-->
					<td><input type="url" name="url" @if($url) value="{{$url}}" @endif class="post_input_text"
							autocomplete="url"></td>
				</tr>
				<tr>
					<td class="post_table_title">題名@if($usesub) (必須) @endif</td>
					<!--編集時、valueに題名をセット-->
					<td><input type="text" name="sub" @if($sub) value="{{$sub}}" @endif class="post_input_text"
							autocomplete="off"></td>
				</tr>
				<tr>
					<td class="post_table_title">本文 @if($usecom) (必須) @endif</td>
					<!--編集時、textarea内に本文をセット-->
					<td><textarea name="com" wrap="soft" class="post_input_com">@if($com){{$com}}@endif</textarea>
					</td>
				</tr>
				<!--ファイルアップロード欄-->
				@if($upfile)
				<tr>
					<td class="post_table_title">添付画像</td>
					<td><input type="file" name="upfile" accept="image/*">
					</td>
				</tr>
				@endif
				<!--お絵かき画像選択欄-->
				@if($tmp)
				@php 
				rsort($tmp);
				@endphp

				<tr>
					<td class="post_table_title">画像</td>
					<td><select name="picfile" class="post_select_image">
							@foreach ($tmp as $tmpimg)
							<option value="{{$tmpimg['srcname']}}">{{$tmpimg['srcname']}}</option>
							@endforeach
						</select></td>
				</tr>
				@endif
				<!--新規投稿時は削除キー入力-->
				@if($regist)
				<tr>
					<td class="post_table_title">削除キー</td>
					<td><input type="password" name="pwd" value="" class="post_input_pass"
							autocomplete="current-password">
						<span class="howtoedit">(記事の編集削除用。英数字で)</span></td>
				</tr> @endif
				<tr>
					<td colspan="2" style="text-align: center;" class="post_table_submit td_noborder"><input
							type="submit" value="送信する" class="post_submit"></td>
				</tr>
				<tr>
					<td colspan="2" class="td_noborder">
						<!--新規投稿説明-->
						<ul class="howtowrite">
							@if($regist)
							@if($upfile)
							<li>最大投稿データ量は {{$maxkb}} KB までです。sage機能付き。</li>
							@endif
							@endif
							<!--編集説明-->
							@if($rewrite)
							<li>E-mail以外の項目は 未入力(空白)にすると内容はそのままです。</li>
							<li>編集では クッキーは保存されません。さらにsageを入れても位置は変わりません。</li>
							@endif
							<!--以下共通-->
						</ul>
					</td>
				</tr>
			</table>
		</form>
		@endif
		<script src="lib/{{$jquery}}"></script>
		<script>
		jQuery(function() {
			window.onpageshow = function () {
				var $btn = $('[type="submit"]');
				//disbledを解除
				$btn.prop('disabled', false);
				$btn.click(function () { //送信ボタン2度押し対策
					$(this).prop('disabled', true);
					$(this).closest('form').submit();
				});
			}
		});
		</script>

		<!--新規投稿のみクッキーを読込み-->
		@if($regist)
		<script>
			document.addEventListener('DOMContentLoaded', (e) => {
				l();//LoadCookie
			});
		</script>
		@endif
		@endif
		<!--投稿モード ここまで-->
		<!--管理モード(認証)-->
		@if($n)
		<!-- 
//
// admin_in…管理モード(認証)のとき true が入る
// home…ホームページURL
// self…POTI-boardのスクリプト名
// self2…入口(TOP)ページのURL
-->
		@endif
		@if($admin_in)
		<div id="self2">
			[<a href="{{$self2}}">{{$title}}</a>]</div>
		</header>
		<form action="{{$self}}" method="post">
			<div class="centering">
				<div class="margin_radio">
					<label class="radio"><input type="radio" name="admin" value="update" checked>ログ更新 </label>
					<label class="radio"><input type="radio" name="admin" value="del">記事削除 </label>
					<label class="radio"><input type="radio" name="admin" value="post">管理人投稿</label>
				</div>
				<input type="hidden" name="mode" value="admin">
				<input type="password" name="pass" size="8" autocomplete="current-password" class="adminpass">
				<input type="submit" value=" 認証 " class="admin_submit">

			</div>
		</form>
		@endif
		{{-- <!--管理モード(認証) ここまで--> --}}
		{{-- <!--管理モード(削除)--> --}}
		{{-- <!-- 
//
// admin_del…管理モード(削除)のとき true が入る
// home…ホームページURL
// self…POTI-boardのスクリプト名
// self2…入口(TOP)ページのURL
// pass…認証パスワード
// del…削除テーブルグループ
// del/bg…削除テーブルの背景色
// del/no…記事No
// del/now…書込み日付
// del/sub…題名(半角10文字まで)
// del/name…名前(半角10文字まで)
// del/com…本文(半角20文字まで)
// del/host…ホストアドレス
// del/clip…画像へのリンクデータ
// del/size…画像サイズ(Byte)
// del/chk…画像MD5
// all…画像データ合計サイズ(KB)
--> --}}
		@if($admin_del)
		<div id="self2">
			[<a href="{{$self2}}">{{$title}}</a>] </div>
		</header>
		<div class="centering">
			<p>
				削除したい記事のチェックボックスにチェックを入れ、削除ボタンを押して下さい。<br>
				<span class="hensyu">（記事Noをクリックすると編集できます）</span></p>
			<p>
				<form action="{{$self}}" method="post">
					<input type="hidden" name="admin" value="update">
					<input type="hidden" name="mode" value="admin">
					<input type="hidden" name="pass" value="{{$pass}}">
					<input type="submit" value="ログ更新" class="admin_submit">
				</form>
			</p>
			<p>
				<form id="delete" action="{{$self}}" method="POST">
					<input type="hidden" name="mode" value="admin">
					<input type="hidden" name="admin" value="del">
					<input type="hidden" name="pass" value="{{$pass}}">

					<input type="submit" value="削除する"><input type="reset" value="リセット">
					<label class="checkbox"><input type="checkbox" name="onlyimgdel" value="on">画像だけ消す</label>
				</form>
			</p>
			<table class="admindel_table">
				<tr class="deltable_tr">
					<th class="nobreak">削除</th>
					<th class="nobreak">記事No</th>
					<th class="nobreak">投稿日</th>
					<th class="nobreak">題名</th>
					<th class="nobreak">投稿者</th>
					<th class="nobreak">コメント</th>
					<th class="column_non">ホスト名</th>
					<th class="column_non">添付(KB)</th>
					<th class="column_non">md5</th>
				</tr>

				@if($dels)
				@foreach ($dels as $del)

				<tr style="background-color:{{$del['bg']}}">
					<th class="delcheck"><label class="checkbox_nt"><input form="delete" type="checkbox" name="del[]"
								value="{{$del['no']}}"></label></th>

					<th class="nobreak">
						<form action="{{$self}}" method="post" id="form{{$del['no']}}">
							<input type="hidden" name="del[]" value="{{$del['no']}}"><input type="hidden" name="pwd"
								value="{{$pass}}"><input type="hidden" name="mode" value="edit">
							<a href="javascript:form{{$del['no']}}.submit()">{{$del['no']}}</a></form>
					</th>
					<td><small>{{$del['now']}}</small></td>
					<td>{{$del['sub']}}</td>
					<td class="nobreak"><b>{!!$del['name']!!}</b></td>
					<td><small>{{$del['com']}}</small></td>
					<td class="column_non">{{$del['host']}}</td>
					<td class="column_non">{!!$del['clip']!!}({{$del['size_kb']}})</td>
					<td class="column_non">{{$del['chk']}}</td>
				</tr>
				@endforeach
				@endif
			</table>
			<p>
				<input form="delete" type="submit" value="削除する"><input form="delete" type="reset" value="リセット">
				<label class="checkbox"><input form="delete" type="checkbox" name="onlyimgdel" value="on">画像だけ消す</label>
			</p>
			@if($del_pages)
			@foreach($del_pages as $del_page)
			<span class="del_page">[
				<form action="{{$self}}" method="post" id="form_page{{$del_page['no']}}">
					<input type="hidden" name="mode" value="admin">
					<input type="hidden" name="admin" value="del">
					<input type="hidden" name="pass" value="{{$pass}}">
					<input type="hidden" name="del_pageno" value="{{$del_page['no']}}">
					@if($del_page['notlink'])
					{{$del_page['pageno']}}
				</form>
				]</span>
			@else
			<a href="javascript:form_page{{$del_page['no']}}.submit()">{{$del_page['pageno']}}</a></form>
			]</span>
			@endif

			@endforeach
			@endif
			<p>【 画像データ合計 : <b>{{$all}}</b> KB 】</p>
		</div>
		@endif
		<!--管理モード(削除) ここまで-->
		<!--エラー画面-->
		@if($n)
		<!-- 
//
// err_mode…エラー画面のとき true が入る
// home…ホームページURL
// self…POTI-boardのスクリプト名
// self2…入口(TOP)ページのURL
// mes…エラーメッセージ
-->
		@endif
		@if($err_mode)

		<div id="self2">
			[<a href="{{$self2}}">{{$title}}</a>] </div>
		</header>
		<div class="error_mesage">
			{!!$mes!!}
			<br><a href="#" onclick="javascript:window.history.back(-1);return false;">もどる</a>
		</div>

		@endif
		<!--エラー画面 ここまで-->
		<footer>
			<!--著作権表示 削除しないでください-->
			@include('parts.copyright')
		</footer>
	</div>
</body>

</html>