@if($n)
<!--(********** カタログテンプレート **********
// このテンプレートは、カタログモード用テンプレートです
-->
@endif
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" href="{{$skindir}}basic.css?{{$ver}}">
	<link rel="preload" as="style" href="{{$skindir}}icomoon/style.css" onload="this.rel='stylesheet'">
	<link rel="preload" as="script" href="lib/{{$jquery}}">
	<link rel="preload" as="script" href="{{$skindir}}js/basic_common.js?{{$ver}}">
	<link rel="preload" as="script" href="loadcookie.js?{{$ver}}">
	<title>カタログモード - {{$title}}</title>

</head>

<body>
	<div id="body">
		<header>
			<h1 id="bbs_title">カタログモード - <span class="title_name_wrap">{{$title}}</span></h1>
			<nav>
				<div id="self2">
					[<a href="{{$self2}}">{{$title}}</a>]
					<span class="menu_home_wrap">
						[<a href="{{$home}}" target="_top">ホーム</a>]</span>
					<a href="#bottom">▽</a>
				</div>
			</nav>
		</header>
		{{-- <!-- 
		// home…ホームページURL
		// self…POTI-boardのスクリプト名
		// self2…入口(TOP)ページのURL
		--> --}}
		<div class="catalog_desc_wrap">
			<!--カタログ配列-->
			@if(isset($oya) and !(empty($oya)))
			@foreach ($oya as $i => $ress)
			@foreach ($ress as $res)@if($res['no'])<div class="catalog_wrap">
				<div class="catalog_info_wrap">
					<div class="catalog_title"><a
							href="{{$self}}?res={{$res['no']}}">[{{$res['no']}}]&nbsp;{{$res['sub']}}</a></div>
					<div class="catalog_name">{{$res['name']}}</div>
					<div class="catalog_time">{{$res['now']}}</div>
				</div>
				{{-- <!--画像があれば・・・--> --}}
				@if($res['imgsrc'])<div class="catalog_img"><a href="{{$self}}?res={{$res['no']}}"><img
							src="{{$res['imgsrc']}}" alt="{{$res['sub']}} by {{$res['name']}}"
							title="{{$res['sub']}} by {{$res['name']}}" width="{{$res['w']}}" @if($res['h'])
							height="{{$res['h']}}" @endif @if($i>14)loading="lazy"@endif></a></div>@endif
				{{-- <!--文字のみならば・・・--> --}}
				@if($res['txt'])<div class="catalog_noimg"><a href="{{$self}}?res={{$res['no']}}">画像なし</a></div>@endif
			</div>@endif @endforeach @endforeach
		</div>
		@endif
		{{-- <!-- 
		// $res…カタログ配列
		// $resno…No
		// $resimgsrc…サムネイル画像URL
		// $ressub…題名
		// $resname…名前
		// $resw…画像幅(横)
		// $restxt…文字のみの場合 true が入る
		// $resnow…投稿日
		// $resupdatemark…編集マーク
		// $resid…ID
		// $respch…動画ファイル用引数(フラグ兼用)
		// $resnoimg…記事が無い場合 true が入る
		--> --}}
		<hr>
		{{-- ページネーション --}}
		@include('parts.paging')
		{{-- 前、次のナビゲーション --}}
		@include('parts.prev_next')

		{{--  メンテナンスフォーム欄  --}}
		@include('parts.mainte_form')

		<!--JavaScriptの実行(クッキーを読込み、フォームに値をセット)-->
		<footer>
			<!--著作権表示 削除しないでください-->
			@include('parts.copyright')
		</footer>
	</div>
	<script src="loadcookie.js?{{$ver}}"></script>
	<script>
		document.addEventListener('DOMContentLoaded',l,false);
	</script>
	<div id="bottom"></div>
	<div id="page_top"><a href="#" class="icon-angles-up-solid"></a></div>
	<script src="lib/{{$jquery}}"></script>
	<script src="{{$skindir}}js/basic_common.js?{{$ver}}"></script>
</body>

</html>