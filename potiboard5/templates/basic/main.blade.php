{{-- <!--********** メインテンプレート **********
// このテンプレートは、以下のモード用テンプレートです
// ・メインモード
--> --}}
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	{{-- SNS --}}
	@if ($sharebutton)
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="">
	<meta property="og:site_name" content="">
	<meta property="og:title" content="{{$title}}">
	<meta property="og:type" content="article">
	<meta property="og:description" content="">
	<meta property="og:image" content="">
	@endif
	{{--  ENDSNS --}}
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" href="{{$skindir}}basic.css?{{$ver}}">
	<link rel="preload" as="style" href="{{$skindir}}icomoon/style.css" onload="this.rel='stylesheet'">
	<link rel="preload" as="script" href="lib/{{$jquery}}">
	<link rel="preload" as="style" href="lib/lightbox/css/lightbox.min.css" onload="this.rel='stylesheet'">
	<link rel="preload" as="script" href="lib/lightbox/js/lightbox.min.js">
	<link rel="preload" as="script" href="{{$skindir}}js/basic_common.js?{{$ver}}">
	<link rel="preload" as="script" href="loadcookie.js">
	<style id="for_mobile"></style>
<title>{{$title}}</title>
	{{-- title…掲示板タイトル --}}
</head>

<body>
	<div id="top"></div>
	<div id="body">
		<header>
			<h1 id="bbs_title">{{$title}}</h1>
			{{-- resnoがある＝レスモード --}}
			<nav>
				<div class="bbsmenu">
					[<a href="{{$home}}" target="_top">ホーム</a>]
					[<a href="{{$self}}?mode=catalog">カタログ</a>]
					@if ($for_new_post)
					[<a href="{{$self}}?mode=newpost"><span class="menu_none">新規</span>投稿</a>]
					@endif
					[<a href="{{$self}}?mode=piccom">未<span class="menu_none">投稿画像</span></a>]
					@if($use_admin_link)[<a href="{{$self}}?mode=admin">管<span class="menu_none">理用</span></a>]@endif
					<a href="#bottom">▽</a>
			{{-- 
			// home…ホームページURL
			// self…POTI-boardのスクリプト名
			// self2…入口(TOP)ページのURL
			// resno…レス時の親記事No
			 --}}
				</div>
			</nav>
			{{--  1行広告用  --}}
			<div class="menu_pr"></div>
			<div class="clear"></div>
			{{-- お絵かきフォーム欄
			//実際のお絵かきフォーム
			//select_app ツールの選択メニューを出す時にtrueが入る
			//use_shi_painter しぃペインターを使う設定の時にtrueが入る
			//use_chickenpaint を使う設定の時にtrueが入る
			 --}}

			@if ($paint and !$diary)
			{{-- ペイントボタン --}}
			@include('parts.paint_form')
			@endif

			{{-- お絵かきフォーム欄のみ時に表示 --}}
			@if (!$diary or $addinfo)
			<div class="howtopaint">
				<ul id="up_desc">
					@if ($paint2 and !$diary)
					<li>お絵かきできる画像のサイズは横 {{$pminw}}px～{{$pmaxw}}px、縦 {{$pminh}}px～{{$pmaxh}}pxの範囲内です。</li>
					<li>幅 {{$maxw}}px、高さ {{$maxh}}pxを超える画像はサムネイルで表示されます。sage機能付き。</li>
					@endif
					{!!$addinfo!!}
				</ul>
				</div>
			@endif	
		{{-- 
		// pmaxw…お絵かき最大サイズ(横)
		// pmaxh…お絵かき最大サイズ(縦)
		// maxw…投稿サイズ(横)。レス時にはレス用の値が入る
		// maxh…投稿サイズ(縦)。レス時にはレス用の値が入る
		// addinfo…追加お知らせ
		--}}
		</header>
		{{-- 前、次のナビゲーション --}}
		@include('parts.prev_next')

		@foreach ($oya as $i=>$ress)

{{-- スレッドのループ --}}
{{-- 親記事グループ --}}
<article>
	@if(isset($ress) and !@empty($ress))
	@foreach ($ress as $res)
	{{-- 親記事ヘッダ --}}
	@if ($loop->first)
	{{-- 最初のループ --}}
	<h2 class="article_title"><a href="{{$self}}?res={{$ress[0]['no']}}">[{{$ress[0]['no']}}]
			{{$ress[0]['sub']}}</a></h2>

	@else
	<hr>
	{{-- レス記事ヘッダ --}}
	<div class="res_article_wrap">
		<div class="res_article_title">[{{$res['no']}}] {{$res['sub']}}</div>
		@endif
		{{-- 記事共通ヘッダ --}}
		@if(!isset($res['not_deleted'])||$res['not_deleted'])
		<div class="article_info">
			<span class="article_info_name"><a href="{{$self}}?mode=search&page=1&imgsearch=on&query={{$res['encoded_name']}}&radio=2"
			target="_blank" rel="noopener">{{$res['name']}}</a></span>@if($res['trip'])<span class="article_info_trip">{{$res['trip']}}</span>@endif
			@if($res['url'])<span class="article_info_desc">[<a href="{{$res['url']}}" target="_blank"
					rel="nofollow noopener noreferrer">URL</a>]</span> @endif
			@if($res['id'])<span class="article_info_desc">ID:{{$res['id']}}</span>@endif
			<span class="article_info_desc">{{$res['now']}}</span>
			@if($res['painttime'])<span
			class="article_info">描画時間:{{$res['painttime']}}</span>@endif
			@if($res['tool'])<span class="article_info_desc">Tool:{{$res['tool']}}</span>@endif
			@if($res['updatemark'])<span class="article_info_desc">{{$res['updatemark']}}</span>@endif
			@if($res['thumb'])<span class="article_info_desc">- サムネイル表示中 -</span>@endif
			<div class="article_img_info">
				@if($res['src'])
				@if($res['continue'])<span class="article_info_continue">☆<a
						href="{{$self}}?mode=continue&no={{$res['continue']}}&resno={{$ress[0]['no']}}">続きを描く</a></span>@endif
				@if($res['spch'])<span class="for_pc">@endif @if($res['pch'])@if($res['continue'])| @endif<span
						class="article_info_animation">☆<a href="{{$self}}?mode=openpch&pch={{$res['pch']}}&resno={{$ress[0]['no']}}&no={{$res['no']}}"
							target="_blank">動画</a></span>@endif @if($res['spch'])</span>@endif
				@endif			
			</div>
		</div>
			{{-- 記事共通ヘッダここまで --}}

			@if($res['src'])<div class="posted_image" @if($res['w']>=750) style="margin-right:0;float:none;" @endif >
				<a href="{{$res['src']}}" target="_blank" rel="noopener" data-lightbox="{{$ress[0]['no']}}"><img
						src="{{$res['imgsrc']}}" width="{{$res['w']}}" height="{{$res['h']}}"
						alt="{{$res['sub']}} by {{$res['name']}} ({{$res['size_kb']}} KB)"
						title="{{$res['sub']}} by {{$res['name']}} ({{$res['size_kb']}} KB) @if($res['thumb'])サムネイル縮小表示 @endif"
						@if($i>4)loading="lazy"@endif>
					</a>
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

			@if ($loop->first)
			@if ($res['skipres'])
			<hr>
			<div class="article_skipres">レス{{$res['skipres']}}件省略中。</div>
			@endif
			@endif
	@if (!$loop->first)
	</div>
	@endif

	@endforeach
	@endif

			<div class="clear"></div>
			<div class="margin_resbutton_res">
				<div class="res_button_wrap">

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
					<form action="{{$self}}?res={{$ress[0]['no']}}" method="post"><input type="submit"
						value="@if($ress[0]['disp_resbutton']) 返信 @else 表示 @endif" class="res_button"></form></div>
			</div>
			{{-- end thread --}}
		</article>
		<hr>

		@endforeach
		{{-- 親記事グループここまで --}}
		<div class="clear"></div>

		{{-- ページネーション --}}
		@include('parts.paging')
		{{-- 前、次のナビゲーション --}}
		@include('parts.prev_next')
		{{-- メンテナンスフォーム欄 --}}
		@include('parts.mainte_form')

		<footer>
			{{-- 著作権表示 削除しないでください --}}
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
