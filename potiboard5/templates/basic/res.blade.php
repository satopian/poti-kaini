<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	{{-- SNS --}}
	@if ($sharebutton)
	<meta name="Description" content="{{$oya[0][0]['descriptioncom']}}">

	<meta name="twitter:card" content="summary">
	<meta property="og:title"
		content="[{{$oya[0][0]['no']}}] {{$oya[0][0]['sub']}} by {{$oya[0][0]['name']}} - {{$title}}">
	<meta property="og:type" content="article">
	<meta property="og:url" content="{{$rooturl}}{{$self}}?res={{$oya[0][0]['no']}}">
	@if ($oya[0][0]['src'])
	<meta property="og:image" content="{{$rooturl}}{{$oya[0][0]['imgsrc']}}">
	@endif
	<meta property="og:site_name" content="">
	<meta property="og:description" content="{{$oya[0][0]['descriptioncom']}}">
	@endif
	{{-- ENDSNS --}}
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" href="{{$skindir}}basic.css?{{$ver}}">
	<link rel="preload" as="style" href="{{$skindir}}icomoon/style.css" onload="this.rel='stylesheet'">
	<link rel="preload" as="script" href="lib/{{$jquery}}">
	<link rel="preload" as="style" href="lib/lightbox/css/lightbox.min.css" onload="this.rel='stylesheet'">
	<link rel="preload" as="script" href="lib/lightbox/js/lightbox.min.js">
	<link rel="preload" as="script" href="{{$skindir}}js/basic_common.js?{{$ver}}">
	<link rel="preload" as="script" href="loadcookie.js">
	<style id="for_mobile"></style>

	<title>[{{$oya[0][0]['no']}}] {{$oya[0][0]['sub']}} by {{$oya[0][0]['name']}} - {{$title}}</title>
	{{-- title…掲示板タイトル --}}
</head>

<body>
	<div id="top"></div>
	<div id="body">
		<header>
			<h1 id="bbs_title">[{{$oya[0][0]['no']}}] {{$oya[0][0]['sub']}} @if($oya[0][0]['name'])<span class="title_name_wrap">by
					{{$oya[0][0]['name']}} さんへ返信</span>@endif</h1>
			<nav>
				<div id="self2">
					[<a href="{{$self2}}">{{$title}}</a>]
					<span class="menu_home_wrap">
						[<a href="{{$home}}" target="_top">ホーム</a>]</span>
					<a href="#bottom">▽</a>
				</div>
			</nav>
			{{-- <!--
	// home…ホームページURL
	// self…POTI-boardのスクリプト名
	// self2…入口(TOP)ページのURL
	// resno…レス時の親記事No
	--> --}}
		</header>

		@foreach ($oya as $i=>$ress)

		{{-- <!--親記事グループ--> --}}
		{{-- 個別スレッドのループここから --}}
		{{-- スレッドのループ --}}
		{{-- <!--親記事グループ--> --}}
		<article>
			@if(isset($ress) and !@empty($ress))
		
			@foreach ($ress as $i => $res)
			{{-- <!--親記事ヘッダ--> --}}
			@if ($loop->first)
			{{-- 最初のループ --}}
			<h2 class="article_title"><a href="{{$self}}?res={{$ress[0]['no']}}">[{{$ress[0]['no']}}]
					{{$ress[0]['sub']}}</a></h2>
		
			@else
			<hr>
			{{-- <!-- レス記事ヘッダ --> --}}
			<div class="res_article_wrap">
				<div class="res_article_title" id="{{$res['no']}}">[{{$res['no']}}] {{$res['sub']}}</div>
				@endif
				{{-- <!-- 記事共通ヘッダ --> --}}
				@if(!isset($res['not_deleted'])||$res['not_deleted'])
				<div class="article_info">
					<span class="article_info_name"><a href="{{$self}}?mode=search&page=1&imgsearch=on&query={{$res['encoded_name']}}&radio=2"
							target="_blank" rel="noopener">{{$res['name']}}</a></span>@if($res['url'])<span
						class="article_info_desc">[<a href="{{$res['url']}}" target="_blank"
							rel="nofollow noopener noreferrer">URL</a>]</span> @endif
					@if($res['id'])<span class="article_info_desc">ID:{{$res['id']}}</span>@endif
					<span class="article_info_desc">{{$res['now']}}</span>@if($res['painttime'])<span
					class="article_info">描画時間:{{$res['painttime']}}</span>@endif
					@if($res['tool'])<span class="article_info_desc">Tool:{{$res['tool']}}</span>@endif
					@if($res['updatemark'])<span class="article_info_desc">{{$res['updatemark']}}</span>@endif
					@if($res['thumb'])<span class="article_info_desc">- サムネイル表示中 -</span>@endif
					<div class="article_img_info">
						@if($res['src'])
						@if($res['continue'])<span class="article_info_continue">☆<a
								href="{{$self}}?mode=continue&no={{$res['continue']}}">続きを描く</a></span>@endif
						@if($res['spch'])<span class="for_pc">@endif @if($res['pch'])@if($res['continue'])| @endif<span
								class="article_info_animation">☆<a href="{{$self}}?mode=openpch&pch={{$res['pch']}}"
									target="_blank">動画</a></span>@endif @if($res['spch'])</span>@endif
						@endif			
					</div>
				</div>
				
					{{-- <!-- 記事共通ヘッダここまで --> --}}
		
					@if($res['src'])<div class="posted_image" @if($res['w']>=750) style="margin-right:0;float:none;" @endif >
						<a href="{{$res['src']}}" target="_blank" rel="noopener" data-lightbox="{{$ress[0]['no']}}"><img
								src="{{$res['imgsrc']}}" width="{{$res['w']}}" height="{{$res['h']}}"
								alt="{{$res['sub']}} by {{$res['name']}} ({{$res['size_kb']}} KB)"
								title="{{$res['sub']}} by {{$res['name']}} ({{$res['size_kb']}} KB) @if($res['thumb'])サムネイル縮小表示 @endif"
								@if($i>4)loading="lazy"@endif
								></a>
					</div>
					@endif
					<div class="comment">{!!$res['com']!!}</div>
					{{-- // $res/tab…TAB順用連番
					// $res/imgsrc…サムネイルがあるとき、サムネイルURL。サムネイルがないとき、画像URL
					// $res/w…画像サイズ(横)
					// $res/h…画像サイズ(縦)
					// $res/srcname…画像ファイル名
					// $res/size…画像ファイルサイズ
					// $res/com…本文 --}}
				@endif
				@if(isset($res['not_deleted'])&&!$res['not_deleted'])
				この記事はありません。
				@endif
				@if (!$loop->first)
			</div>
			@endif
					
			@endforeach
			@endif
					{{-- ここまで --}}
			<div class="clear"></div>
			<div class="margin_resbutton_res">
				<div class="res_button_wrap">
					@if($form)
					@if($resname)
					<script>
					function add_to_com() {
						var textField = document.getElementById("p_input_com");
						var postername = "{!! htmlspecialchars($resname,ENT_QUOTES,'utf-8') !!}{{$_san}}";
						// テキストフィールドの現在のカーソル位置を取得
						var startPos = textField.selectionStart;
						var endPos = textField.selectionEnd;
						// カーソル位置に指定した文字列を挿入
						textField.value = textField.value.substring(0, startPos) + postername + textField.value.substring(endPos);
						// カーソル位置を更新
						var newCursorPosition = startPos + postername.length;
						textField.setSelectionRange(newCursorPosition, newCursorPosition);						// テキストフィールドにフォーカスを設定
						textField.focus();
					}
					</script>
		
					{{-- コピーボタン --}}
					<button class="copy_button" onclick="add_to_com()">投稿者名をコピー</button>
					@endif
					@endif

					@if($sharebutton)
					{{-- シェアボタン --}}
					<span class="share_button">
					@if($switch_sns)
						<a href="{{$self}}?mode=set_share_server&encoded_t={{$ress[0]['encoded_t']}}&amp;encoded_u={{$ress[0]['encoded_u']}}" onclick="open_sns_server_window(event,{{$sns_window_width}},{{$sns_window_height}})"><span class="icon-share-from-square-solid"></span>
						SNSで共有する</a>
					@else
						<a target="_blank"
						href="https://twitter.com/intent/tweet?text={{$ress[0]['encoded_t']}}&url={{$ress[0]['encoded_u']}}"><span
						class="icon-twitter"></span>Tweet</a>
						<a target="_blank" class="fb btn"
						href="http://www.facebook.com/share.php?u={{$ress[0]['encoded_u']}}"><span
						class="icon-facebook2"></span>Share</a>
					@endif
					</span>
					@endif


				</div>
			</div>
			<!-- /thread -->
		</article>
		@endforeach
		{{-- <!--親記事グループここまで--> --}}
		<div class="clear"></div>
		{{-- <!--お絵かきフォーム欄--> --}}
		@if($paintform)
		{{-- <!--実際のお絵かきフォーム--> --}}
		<div id="res_paint_form">

			@include('parts.paint_form')

		</div>

		@endif

		{{-- <!--投稿フォーム欄--> --}}
		@if($form)
		<form action="{{$self}}" method="POST" enctype="multipart/form-data" id="comment_form">
			<input type="hidden" name="token" value="{{$token}}">
			<input type="hidden" name="mode" value="regist">
			<input type="hidden" name="resto" value="{{$resno}}">
			<input type="hidden" name="MAX_FILE_SIZE" value="{{$maxbyte}}">
			{{-- <!--
			// maxbyte…最大投稿サイズ(Byte)
			--> --}}
			<table id="post_table">
				<tr>
					<td class="post_table_title">名前@if($usename)(必須)@endif</td>
					<td><input type="text" name="name" class="post_input_text" autocomplete="username"></td>
				</tr>
				<tr>
					<td class="post_table_title">E-mail</td>
					<td><input type="text" name="email" class="post_input_text" autocomplete="email"></td>
				</tr>
				@if($use_url_input)
				<tr>
					<td class="post_table_title">URL</td>
					<td><input type="url" name="url" class="post_input_text" autocomplete="url"></td>
				</tr>
				@endif
				<tr>
					<td class="post_table_title">題名@if($usesub)(必須)@endif</td>
					<td><input type="text" name="sub" value="{{$resub}}" class="post_input_text" autocomplete="off">
					</td>
				</tr>
				<tr>
					<td class="post_table_title">本文@if($usecom)(必須)@endif</td>
					<td><textarea name="com" class="post_input_com" id="p_input_com"></textarea></td>
				</tr>
				{{-- <!--
				// usename…名前が必須だと ' *' が入る
				// usesub…題名が必須だと ' *' が入る
				// usecom…本文が必須だと ' *' が入る
				// resub…レス時の返信用題名(Re: ～)
				// --> --}}
				{{-- <!--ファイルアップロード欄--> --}}
				@if($upfile)

				<tr>
					<td class="post_table_title">添付画像</td>
					<td><input type="file" name="upfile" accept="image/*">
					</td>
				</tr>
				@endif
				<tr>
					<td class="post_table_title">削除キー</td>
					<td><input type="password" name="pwd" value="" class="post_input_pass"
							autocomplete="current-password">
						<span class="howtoedit">(記事の編集削除用。英数字で)</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center;" class="post_table_submit td_noborder"><input
							type="submit" value="送信する" class="post_submit"></td>
				</tr>
				<tr>
					<td colspan="2" class="td_noborder">
						<!--ファイルアップロード時の説明-->
						<ul class="howtowrite">
							@if($upfile) 
							<li>添付可能なファイル形式はGIF、JPG、PNG、およびWEBPです。</li>
							<li>横 {{$maxw_px}}px、縦 {{$maxh_px}}pxを超える添付画像は縮小されます。</li>
							@endif
							@if($paintform or $upfile)
							<li>幅 {{$maxw}}px、高さ {{$maxh}}pxを超える画像はサムネイルで表示されます。</li>
							<li>最大投稿データ量は {{$maxkb}} KB までです。sage機能付き。</li>
							@endif
							{!!$addinfo!!}
						</ul>
					</td>
				</tr>
			</table>
		</form>
		@endif
		<hr>

		<nav>
			<div class="pagelink pcdisp">
				@if($res_prev)<a href="{{$self}}?res={{$res_prev['no']}}">≪{{$res_prev['substr_sub']}}</a>@endif
				<div class="pagelink_top"><a href="{{$self2}}">掲示板トップ</a></div>
				@if($res_next)<a href="{{$self}}?res={{$res_next['no']}}">
					{{$res_next['substr_sub']}}≫</a>@endif
			</div>
			<div class="mobiledisp">
				@if($res_prev)
				前: <a href="{{$self}}?res={{$res_prev['no']}}">{{$res_prev['sub']}}</a>
				<br>
				@endif
				@if($res_next)
				次: <a href="{{$self}}?res={{$res_next['no']}}">{{$res_next['sub']}}</a>
				<br>
				@endif
			</div>
@if($view_other_works)
<div class="view_other_works">
@foreach($view_other_works as $view_other_work)<div><a
 href="{{$self}}?res={{$view_other_work['no']}}"><img src="{{$view_other_work['imgsrc']}}" alt="{{$view_other_work['sub']}} by {{$view_other_work['name']}}" title="{{$view_other_work['sub']}} by {{$view_other_work['name']}}" width="{{$view_other_work['w']}}" height="{{$view_other_work['h']}}" loading="lazy"></a></div>@endforeach
</div>
@endif

		</nav>

		{{-- <!-- メンテナンスフォーム欄 --> --}}
		@include('parts.mainte_form')
	
		<footer>
			{{-- <!--著作権表示 削除しないでください--> --}}
			@include('parts.copyright')
		</footer>
	</div>
	<script src="loadcookie.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded',l,false);
	</script>
	<div id="bottom"></div>
	<div id="page_top"><a class="icon-angles-up-solid"></a></div>
	<script src="lib/{{$jquery}}"></script>
	<script src="lib/lightbox/js/lightbox.min.js"></script>
	<script src="{{$skindir}}js/basic_common.js?{{$ver}}"></script>
</body>
</html>
