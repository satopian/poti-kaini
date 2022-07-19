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
	<link rel="stylesheet" href="{{$skindir}}basic.css">
	<link rel="stylesheet" href="{{$skindir}}icomoon/style.css">
	<title>カタログモード - {{$title}}</title>
	<!--
	// title…掲示板タイトル
	// charset…文字コード
	-->

	{{-- <!--クッキー読込み用JavaScript(必須)--> --}}
	<script src="loadcookie.js"></script>
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
			@foreach ($oya as $ress)
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
							height="{{$res['h']}}" @endif loading="lazy"></a></div>@endif
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
		{{-- <!--メイン時ページング表示--> --}}
		<div id="paging_wrap">{!!$paging!!}</div>
		{{-- 前、次のナビゲーション --}}
		@include('parts.prev_next')

		{{-- <!-- メンテナンスフォーム欄 --> --}}
		@include('parts.mainte_form')

		<!--JavaScriptの実行(クッキーを読込み、フォームに値をセット)-->
		<script>
			l(); //LoadCookie
		</script>
		<footer>
			<!--著作権表示 削除しないでください-->
			@include('parts.copyright')
		</footer>
	</div>
	<div id="bottom"></div>
	<div id="page_top"><a href="#" class="icon-angles-up-solid"></a></div>
	<script src="{{$skindir}}jquery-3.5.1.min.js"></script>
	<script>
			// https://cotodama.co/pagetop/
	jQuery(function() {
		var pagetop = $('#page_top');   
		pagetop.hide();
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {  //100pxスクロールしたら表示
				pagetop.fadeIn();
			} else {
				pagetop.fadeOut();
			}
		});
		pagetop.click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 500); //0.5秒かけてトップへ移動
			return false;
		});
	});
	</script>

</body>

</html>