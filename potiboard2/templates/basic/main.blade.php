{{-- <!--********** メインテンプレート **********
// このテンプレートは、以下のモード用テンプレートです
// ・メインモード
--> --}}
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	{{-- <!--SNS--> --}}
	@if ($sharebutton)
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="" />
	<meta property="og:site_name" content="">
	<meta property="og:title" content="{{$title}}">
	<meta property="og:type" content="article">
	<meta property="og:description" content="">
	<meta property="og:image" content="">
	@endif
	<!-- ENDSNS-->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" href="{{$skindir}}basic.css">
	<link rel="stylesheet" href="{{$skindir}}icomoon/style.css">
	<style>
		.input_disp_none {
			display: none;
		}

		span.canvas_size_wrap {
			display: inline-block;
			padding: 8px 0 0;
		}
	</style>
	<style id="for_mobile"></style>
	<title>{{$title}}</title>
	{{-- <!--
	// title…掲示板タイトル
	// charset…文字コード
	--> --}}
	{{-- <!--クッキー読込み用JavaScript(必須)--> --}}
	<script src="loadcookie.js"></script>
</head>

<body>
	<div id="top"></div>
	<div id="body">
		<header>
			<h1 id="bbs_title">{{$title}}</h1>
			{{-- <!--resnoがある＝レスモード--> --}}
			<nav>
				<div class="bbsmenu">
					[<a href="{{$home}}" target="_top">ホーム</a>]
					[<a href="{{$self}}?mode=catalog">カタログ</a>]
					@if ($for_new_post)
					[<a href="{{$self}}?mode=newpost"><span class="menu_none">新規</span>投稿</a>]
					@endif
					[<a href="{{$self}}?mode=piccom">未<span class="menu_none">投稿画像</span></a>]
					[<a href="{{$self}}?mode=admin">管<span class="menu_none">理用</span></a>]
					<a href="#bottom">▽</a>
			{{-- <!--
			// home…ホームページURL
			// self…POTI-boardのスクリプト名
			// self2…入口(TOP)ページのURL
			// resno…レス時の親記事No
			--> --}}
				</div>
			</nav>
			{{-- <!-- 1行広告用 --> --}}
			<div class="menu_pr"></div>
			<div class="clear"></div>
			{{-- <!--お絵かきフォーム欄-->
			<!--実際のお絵かきフォーム-->
			<!--
			//select_app ツールの選択メニューを出す時にtrueが入る
			//use_shi_painter しぃペインターを使う設定の時にtrueが入る
			//use_chickenpaint を使う設定の時にtrueが入る
			--> --}}
			<script>
				function is_mobile() {
					if (navigator.maxTouchPoints && (window.matchMedia && window.matchMedia('(max-width: 768px)').matches))
					return true;
					return false;
				}
				if (is_mobile()) {
					document.getElementById("for_mobile").textContent = ".for_pc{display: none;}";
				}
			</script>

			@if ($paint)
			{{-- ペイントフォームの外部化 --}}
			@include('parts.paint_form')
			@endif

			{{-- <!--お絵かきフォーム欄のみ時に表示--> --}}
			@if ($paint2)
			<div class="howtopaint">
				<ul id="up_desc">
					<li>お絵かきできる画像のサイズは横 300～{{$pmaxw}}、縦 300px～{{$pmaxh}}pxの範囲内です。</li>
					<li>画像は横 {{$maxw}}px、縦 {{$maxh}}pxを超えると縮小表示されます。sage機能付き。</li>
					{{$addinfo}}
				</ul>
			</div>
			@endif
		{{-- <!--
		// pmaxw…お絵かき最大サイズ(横)
		// pmaxh…お絵かき最大サイズ(縦)
		// maxw…投稿サイズ(横)。レス時にはレス用の値が入る
		// maxh…投稿サイズ(縦)。レス時にはレス用の値が入る
		// addinfo…追加お知らせ
		--> --}}
		</header>
		{{-- 前、次のナビゲーション --}}
		@include('parts.prev_next')

		@foreach ($oya as $i=>$ress)

{{-- スレッドのループ --}}
{{-- <!--親記事グループ--> --}}
<article>
	@if(isset($ress) and !@empty($ress))
		
	@foreach ($ress as $res)
	{{-- <!--親記事ヘッダ--> --}}
	@if ($loop->first)
	{{-- 最初のループ --}}
	<h2 class="article_title">@if($notres)<a href="{{$self}}?res={{$ress[0]['no']}}">@endif[{{$ress[0]['no']}}]
			{{$ress[0]['sub']}}@if($notres)</a>@endif</h2>

	@else
	<hr>
	{{-- <!-- レス記事ヘッダ --> --}}
	<div class="res_article_wrap">
		<div class="res_article_title">[{{$res['no']}}] {{$res['sub']}}</div>
		@endif
		{{-- <!-- 記事共通ヘッダ --> --}}
		<div class="article_info">
			<span class="article_info_name"><a href="search.php?page=1&imgsearch=on&query={{$res['encoded_name']}}&radio=2"
					target="_blank" rel="noopener">{{$res['name']}}</a></span>@if($res['url'])<span
				class="article_info_desc">[<a href="{{$res['url']}}" target="_blank"
					rel="nofollow noopener noreferrer">URL</a>]</span> @endif
			@if($res['id'])<span class="article_info_desc">ID:{{$res['id']}}</span>@endif
			<span class="article_info_desc">{{$res['now']}}</span>@if($res['painttime'])<span
				class="article_info">描画時間:{{$res['painttime']}}</span>@endif
			@if($res['src']) @endif
			@if(['updatemark'])<span class="article_info_desc">{{$res['updatemark']}}</span>@endif
			@if($res['thumb'])<span class="article_info_desc">- サムネイル表示中 -</span>@endif
			<div class="article_img_info">
				@if($res['continue'])<span class="article_info_continue">☆<a
						href="{{$self}}?mode=continue&no={{$res['continue']}}">続きを描く</a></span>@endif
				@if($res['spch'])<span class="for_pc">@endif @if($res['pch'])@if($res['continue'])| @endif<span
						class="article_info_animation">☆<a href="{{$self}}?mode=openpch&pch={{$res['pch']}}"
							target="_blank">動画</a></span>@endif @if($res['spch'])</span>@endif
			</div>


			{{-- <!-- 記事共通ヘッダここまで --> --}}

			@if($res['src'])<div class="posted_image" @if($res['w']>=750) style="margin-right:0;float:none;" @endif >
				@if($res['thumb'])<a href="{{$res['src']}}" target="_blank" rel="noopener">@endif<img
						src="{{$res['imgsrc']}}" width="{{$res['w']}}" height="{{$res['h']}}"
						alt="{{$res['sub']}} by {{$res['name']}} ({{$res['size']}} B)"
						title="{{$res['sub']}} by {{$res['name']}} ({{$res['size']}} B) @if($res['thumb'])サムネイル縮小表示 @endif"
						loading="lazy">@if($res['thumb'])</a>@endif
			</div>
			@endif
			<div class="comment"> {!!$res['com']!!}</div>
			{{-- // $res/tab…TAB順用連番
			// $res/imgsrc…サムネイルがあるとき、サムネイルURL。サムネイルがないとき、画像URL
			// $res/w…画像サイズ(横)
			// $res/h…画像サイズ(縦)
			// $res/srcname…画像ファイル名
			// $res/size…画像ファイルサイズ
			// $res/com…本文 --}}
			@if ($loop->first)
			@if ($res['skipres'])
			<hr>
			<div class="article_skipres">レス{{$res['skipres']}}件省略中。</div>
			@endif
			@endif
			@if (!$loop->first)
		</div>
		@endif
	</div>

	@endforeach
	@endif

			<div class="clear"></div>
			<div class="margin_resbutton_res">
				<div class="res_button_wrap">

					@if($sharebutton)
					{{-- シェアボタン --}}
					<span class="share_button">
						<a target="_blank"
							href="https://twitter.com/intent/tweet?text=%5B{{$ress[0]['encoded_no']}}%5D%20{{$ress[0]['share_sub']}}%20by%20{{$ress[0]['share_name']}}%20-%20{{$encoded_title}}&url={{$encoded_rooturl}}{{$encoded_self}}?res={{$ress[0]['encoded_no']}}"><span
								class="icon-twitter"></span>tweet</a>
						<a target="_blank" class="fb btn"
							href="http://www.facebook.com/share.php?u={{$encoded_rooturl}}{{$encoded_self}}?res={{$ress[0]['encoded_no']}}"><span
								class="icon-facebook2"></span>share</a>
					</span>
					@endif
					<form action="{{$self}}?res={{$ress[0]['no']}}" method="post"><input type="submit"
							value="@if($ress[0]['disp_resbutton']) 返信 @else 表示 @endif" class="res_button"></form><span
						class="page_top"><a href="#top">△</a></span></div>
			</div>
			<!-- /thread -->
		</article>
		<hr>

		@endforeach
		<!--親記事グループここまで-->
		<div class="clear"></div>

		{{-- <!--メイン時ページング表示--> --}}
		<div id="paging_wrap">{!!$paging!!}</div>

		{{-- 前、次のナビゲーション --}}
		@include('parts.prev_next')
		{{-- <!-- メンテナンスフォーム欄 --> --}}
		@include('parts.mainte_form')

		<footer>
			{{-- <!--著作権表示 削除しないでください--> --}}
			@include('parts.copyright')
		</footer>
	</div>
	<div id="bottom"></div>
	<script src="{{$skindir}}jquery-3.5.1.min.js"></script>
	<script>
		window.onpageshow = function () {
			var $btn = $('[type="submit"]');
			//disbledを解除
			$btn.prop('disabled', false);
			$btn.click(function () { //送信ボタン2度押し対策
				$(this).prop('disabled', true);
				$(this).closest('form').submit();
			});
		}
	</script>
</body>

</html>