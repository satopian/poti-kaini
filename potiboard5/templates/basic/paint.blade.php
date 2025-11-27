{{-- ********** お絵かきテンプレート **********
// このテンプレートは、以下のモード用テンプレートです
// ・お絵かきモード
// ・動画表示モード
// ・コンティニューモード
--}}
<!DOCTYPE html>

<html lang="ja">

<head>
	<meta charset="utf-8">
	@if($paint_mode)
	<meta name="robots" content="noindex,follow">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	@endif
	@if($pch_mode)
	<meta name="viewport" content="width=device-width,initial-scale=1.0">@endif
	@if($continue_mode)
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<link rel="preload" as="script" href="lib/{{$jquery}}">
	<link rel="preload" as="script" href="{{$skindir}}js/basic_common.js?{{$ver}}">
	@endif
	<link rel="stylesheet" type="text/css" href="{{$skindir}}basic.css?{{$ver}}">
	<title>@if($paint_mode)お絵かきモード@endif @if($continue_mode)続きを描く@endif @if($pch_mode)動画表示モード@endif - {{$title}}</title>
	{{--
	// title…掲示板タイトル
	// charset…文字コード
	--}}
	@if($continue_mode)
	<style>
		/* index.cssを更新しない人がいるかもしれないためインラインでも記述 */
		#span_cont_paint_same_thread {
			display: none;
		}
	</style>
	@endif
	@if($paint_mode)
	<style>
		body {
			overscroll-behavior-x: none !important;
		}

		div#chickenpaint-parent,
		div.appstage {
			letter-spacing: initial;
			word-break: initial;
			overflow-wrap: initial;
		}

		a {
			text-decoration-skip-ink: initial;
		}
	</style>
	@endif
	@if($chickenpaint)
	<style>
		li {
			margin: 0 0 0 1em;
		}

		:not(input),
		div#chickenpaint-parent :not(input) {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
	</style>
	<script>
		document.addEventListener('DOMContentLoaded',function(){
		document.addEventListener('dblclick', function(e){ e.preventDefault()}, { passive: false });
		const chicken=document.querySelector('#chickenpaint-parent');
		chicken.addEventListener('contextmenu', function(e){
			e.preventDefault();
			e.stopPropagation();
		}, { passive: false });
	});
	</script>

	<script src="chickenpaint/js/chickenpaint.min.js?{{$parameter_day}}&{{$ver}}"></script>

	<link rel="stylesheet" href="chickenpaint/css/chickenpaint.css?{{$parameter_day}}&{{$ver}}">

	@else
	<!-- NEOを使う -->
	<script>
		document.paintBBSCallback = function (str) {
		console.log('paintBBSCallback', str)
		if (str == 'check') {
			return true;
		} else {
			return;
		}
		}
	</script>
	@if($useneo)
	<link rel="stylesheet" href="neo.css?{{$parameter_day}}&{{$ver}}">
	<script src="neo.js?{{$parameter_day}}&{{$ver}}"></script>
	<script>
		Neo.handleExit=()=>{
	@if($rep)
    // 画像差し換えに必要なフォームデータをセット
    const formData = new FormData();
    formData.append("mode", "picrep"); 
    formData.append("no", "{{$no}}"); 
    formData.append("pwd", "{{$pwd}}"); 
	formData.append("repcode", "{{$repcode}}");

    // 画像差し換え

	fetch("{{$sefl}}", {
        method: 'POST',
		mode: 'same-origin',
		headers: {
			'X-Requested-With': 'PaintBBS'
			,
		},
       body: formData
    })
    .then(response => {
// console.log("response",response);
		if (response.ok) {

			if (response.redirected) {
				return window.location.href = response.url;
			}
			response.text().then((text) => {
				 //console.log(text);
				if (text.startsWith("error\n")) {
					console.log(text);
					return window.location.href = "?mode=piccom&stime={{$stime}}";
				}
			})
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
		return window.location.href = "?mode=piccom&stime={{$stime}}";
    });
	@else
	return window.location.href = "?mode=piccom&stime={{$stime}}";
	@endif
	}
	</script>
	@endif
	@if($paint_mode)
	@if(!$chickenpaint)
	<script>
		//Firefoxのメニューバーが開閉するのため、Altキーのデフォルトの処理をキャンセル
		document.addEventListener('keyup', function(e) {//しぃペインター NEO共通
			// e.key を利用して特定のキーのアップイベントを検知する
			if (e.key.toLowerCase() === 'alt') {
				e.preventDefault(); // Alt キーのデフォルトの動作をキャンセル
			}
		});
	</script>
	@endif
	@endif
	@if($pch_mode and $type_neo)
	<link rel="stylesheet" href="neo.css?{{$parameter_day}}&{{$ver}}">
	<script src="neo.js?{{$parameter_day}}&{{$ver}}"></script>
	@endif
	@if(($paint_mode and !$useneo) or ($pch_mode and !$type_neo))
	<!-- Javaが使えるかどうか判定 -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var jEnabled = navigator.javaEnabled();
			if(!jEnabled){
				var sN = document.createElement("script");
				sN.src = "{{$cheerpj_url}}";
				sN.integrity="{{$cheerpj_hash}}";
				sN.crossOrigin="anonymous";
				var s0 = document.getElementsByTagName("script")[0];
				s0.parentNode.insertBefore(sN, s0);
				sN.addEventListener("load", function(){ cheerpjInit({!!htmlspecialchars($cheerpj_preload,ENT_NOQUOTES)!!}); }, false);
			}
		});
	</script>
	@endif
	@endif
	<style id="for_mobile"></style>

</head>

<body>
	<header>
		@if($paint_mode)
		@if(!$chickenpaint)
		<h1 style="min-width:calc({{$w}}px + 176px)" id="bbs_title">お絵かきモード - <span
				class="title_name_wrap">{{$title}}</span></h1>
		@endif

		@else
		<h1 id="bbs_title">@if($continue_mode) 続きを描く@endif @if($pch_mode) 動画表示モード@endif - <span
				class="title_name_wrap">{{$title}}</span></h1>@endif
		{{-- お絵かきモード --}}
		{{--
		// 【お絵かき(通常/続き)】
		//
		// paint_mode…お絵かきモードのとき true が入る
		// home…ホームページURL
		// self…POTI-boardのスクリプト名
		// self2…入口(TOP)ページのURL
		// palettes…パレット配列データ
		// paintbbs…PaintBBSを選択したとき true が入る
		// normal…しぃペインターを選択したとき true が入る
		// pro…しぃペインターProを選択したとき true が入る
		// w…アプレット領域サイズ(横)
		// h…アプレット領域サイズ(縦)
		// layer_count…レイヤー数(しぃペインター)
		// quality…クオリティ値(しぃペインター)
		// picw…キャンバスサイズ(横)
		// pich…キャンバスサイズ(縦)
		// image_jpeg…JPEG保存を許可してるなら true が入る(AUTO or JPEG)
		// image_size…JPEG変換(AUTO)もしくは減色処理(PNG)の判定値(KB)
		// compress_level…PNGの減色率とJPEGの圧縮率
		// undo…アンドゥの回数
		// undo_in_mg…アンドゥを幾つにまとめて保存しておくか
		// mode…投稿モード指示
		// stime…描画開始時間(UNIXタイムスタンプ)
		// anime…動画記録ONなら true が入る
		// pchfile…動画ファイル名(動画から続きを描く場合)
		// imgfile…画像ファイル名(画像から続きを描く場合)
		// usercode…ユーザーコード(投稿者認識用)
		// palsize…パレット総数
		// dynp…パレットの名前配列データ
		// applet…しぃペインターを使用するとき true が入る
		// usepbbs…しぃペインターとPaintBBSの両方を使用するとき true が入る
		// palette…パレット選択用データ(selectタグ用option配列)
		// newpaint…新規お絵かきのとき true が入る(コンティニューは false)
		// savetypes…保存タイプ選択用データ(selectタグ用option配列)
		// animeform…動画記録出来るときに true が入る(画像から続きを描く場合は false)
		// qualitys…クオリティ値選択用データ(selectタグ用option配列)
		// resno…レス時の親記事No
		// no…記事No(コンティニュー)
		// pch…動画ファイル名(コンティニュー)
		// ctype…動画からの続きか、画像からの続きか(コンティニュー)
		// type…差し換えか、新規投稿か(コンティニュー)
		// pwd…記事Pass(コンティニュー)
		// ext…画像拡張子(コンティニュー)
		--}}
		@if($paint_mode)
		@if($chickenpaint)

		<div id="chickenpaint-parent"></div>
		<p></p>

		<script>
			document.addEventListener("DOMContentLoaded", function() {
		new ChickenPaint({
			uiElem: document.getElementById("chickenpaint-parent"),
			canvasWidth: {{$picw}},
		canvasHeight: {{$pich}},

		@if($imgfile) loadImageUrl: "{{$imgfile}}",@endif
		@if($img_chi) loadChibiFileUrl: "{{$img_chi}}",@endif
		saveUrl: "?mode=saveimage&tool=chi&usercode={!!$usercode!!}",
		postUrl: "?mode={!!$mode!!}&stime={{$stime}}",
		exitUrl: "?mode={!!$mode!!}&stime={{$stime}}",

			allowDownload: true,
			resourcesRoot: "chickenpaint/",
			disableBootstrapAPI: true,
			fullScreenMode: "force",
			post_max_size: {{$max_pch}}
		});
	});

	const handleExit=()=>{
	@if($rep)
    // 画像差し換えに必要なフォームデータをセット
    const formData = new FormData();
    formData.append("mode", "picrep"); 
    formData.append("no", "{{$no}}"); 
    formData.append("pwd", "{{$pwd}}"); 
	formData.append("repcode", "{{$repcode}}");

    // 画像差し換え

	fetch("{{$sefl}}", {
        method: 'POST',
		mode: 'same-origin',
		headers: {
			'X-Requested-With': 'PaintBBS'
			,
		},
       body: formData
    })
    .then(response => {
// console.log("response",response);
		if (response.ok) {

			if (response.redirected) {
				return window.location.href = response.url;
			}
			response.text().then((text) => {
				 //console.log(text);
				if (text.startsWith("error\n")) {
						console.log(text);
						return window.location.href = "?mode=piccom&stime={{$stime}}";
					}
			})
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
		return window.location.href = "?mode=piccom&stime={{$stime}}";
    });
	@else
	return window.location.href = "?mode=piccom&stime={{$stime}}";
	@endif
	}
		</script>


		@else

		<nav>
			<div style="min-width:calc({{$w}}px + 176px)" id="self2"> [<a href="{{$self2}}">{{$title}}</a>]
				@if($useneo)
				<span class="nts_radiowrap">ツールを
					<input type="radio" name="1" id="1" onclick="Neo.setToolSide(true)" class="nts_radio"><label class="ntslabel"
						for="1">左へ</label>
					<input type="radio" name="1" id="2" onclick="Neo.setToolSide(false)" checked="checked"
						class="nts_radio"><label class="ntslabel" for="2">右へ</label>
				</span>
				@endif
			</div>
		</nav>
	</header>
	<!--動的パレットスクリプト ここから-->
	<script>
		"use strict";
//	BBS Note 動的パレット＆マトリクス 2003/06/22
//	(C) のらネコ WonderCatStudio http://wondercatstudio.com/
var DynamicColor=1,Palettes=[];
// パレット配列作成
@if($palettes) 
{!!htmlspecialchars($palettes,ENT_NOQUOTES)!!}
@endif
function setPalette(){document.paintbbs.setColors(Palettes[document.forms.Palette.select.selectedIndex]);document.forms.grad.view.checked&&GetPalette()}async function PaletteSave(){Palettes[0]=String(await document.paintbbs.getColors())}var cutomP=0;
async function PaletteNew(){var a=String(await document.paintbbs.getColors());const b=document.forms.Palette.select;Palettes[b.length]=a;cutomP++;a=prompt("\u30d1\u30ec\u30c3\u30c8\u540d","\u30d1\u30ec\u30c3\u30c8 "+cutomP);null==a||""==a?cutomP--:(b.options[b.length]=new Option(a),30>b.length&&(b.size=b.length),PaletteListSetColor())}async function PaletteRenew(){Palettes[document.forms.Palette.select.selectedIndex]=String(await document.paintbbs.getColors());PaletteListSetColor()}
function PaletteDel(){const a=Palettes.length,b=document.forms.Palette.select;let c=b.selectedIndex;if(-1!=c&&confirm("\u300c"+b.options[c].text+"\u300d\u3092\u524a\u9664\u3057\u3066\u3088\u308d\u3057\u3044\u3067\u3059\u304b\uff1f")){for(b.options[c]=null;a>c;)Palettes[c]=Palettes[c+1],c++;30>b.length&&(b.size=b.length)}}
async function P_Effect(a){a=parseInt(a);let b,c=1;255==a&&(c=-1);const f=document.paintbbs;let e=String(await f.getColors()).split("\n");const d=e.length;let g="";for(b=0;d>b;b++){let h=a+parseInt("0x"+e[b].substring(1,3))*c,k=a+parseInt("0x"+e[b].substring(3,5))*c,l=a+parseInt("0x"+e[b].substring(5,7))*c;255<h?h=255:0>h&&(h=0);255<k?k=255:0>k&&(k=0);255<l?l=255:0>l&&(l=0);g+="#"+Hex(h)+Hex(k)+Hex(l)+"\n"}f.setColors(g);PaletteListSetColor()}
async function PaletteMatrixGet(){const a=Palettes.length;var b=document.forms.Palette;const c=b.select;let f=b.setr;switch(b.m_m.selectedIndex){default:f.value="";let e=b=0;for(;a>b;)null!=c.options[b]&&(f.value=f.value+"\n!"+c.options[b].text+"\n"+Palettes[b],e++),b++;alert("\u30d1\u30ec\u30c3\u30c8\u6570\uff1a"+e+"\n\u30d1\u30ec\u30c3\u30c8\u30de\u30c8\u30ea\u30af\u30b9\u3092\u53d6\u5f97\u3057\u307e\u3057\u305f");break;case 1:f.value="!Palette\n"+String(await document.paintbbs.getColors()),alert("\u73fe\u5728\u4f7f\u7528\u3055\u308c\u3066\u3044\u308b\u30d1\u30ec\u30c3\u30c8\u60c5\u5831\u3092\u53d6\u5f97\u3057\u307e\u3057\u305f")}f.value=
f.value.trim()+"\n!Matrix"}
function PalleteMatrixSet(){var a=document.forms.Palette;const b=a.select;switch(a.m_m.selectedIndex){default:a=confirm("\u30d1\u30ec\u30c3\u30c8\u30de\u30c8\u30ea\u30af\u30b9\u3092\u30bb\u30c3\u30c8\u3057\u307e\u3059\u3002\n\u73fe\u5728\u306e\u5168\u30d1\u30ec\u30c3\u30c8\u60c5\u5831\u306f\u5931\u308f\u308c\u307e\u3059\u304c\u3088\u308d\u3057\u3044\u3067\u3059\u304b\uff1f");break;case 1:a=confirm("\u30d1\u30ec\u30c3\u30c8\u30de\u30c8\u30ea\u30af\u30b9\u3092\u30bb\u30c3\u30c8\u3057\u307e\u3059\u3002\n\u73fe\u5728\u4f7f\u7528\u3057\u3066\u3044\u308b\u30d1\u30ec\u30c3\u30c8\u3068\u7f6e\u304d\u63db\u3048\u307e\u3059\u304c\u3088\u308d\u3057\u3044\u3067\u3059\u304b\uff1f");break;
case 2:a=confirm("\u30d1\u30ec\u30c3\u30c8\u30de\u30c8\u30ea\u30af\u30b9\u3092\u30bb\u30c3\u30c8\u3057\u307e\u3059\u3002\n\u73fe\u5728\u306e\u30d1\u30ec\u30c3\u30c8\u60c5\u5831\u306b\u8ffd\u52a0\u3057\u307e\u3059\u304c\u3088\u308d\u3057\u3044\u3067\u3059\u304b\uff1f")}a&&(PaletteSet(),b.size=30>b.length?b.length:30,DynamicColor&&PaletteListSetColor())}
function PalleteMatrixHelp(){alert("\u2605PALETTE MATRIX\n\u30d1\u30ec\u30c3\u30c8\u30de\u30c8\u30ea\u30af\u30b9\u3068\u306f\u30d1\u30ec\u30c3\u30c8\u60c5\u5831\u3092\u5217\u6319\u3057\u305f\u30c6\u30ad\u30b9\u30c8\u3092\u7528\u3044\u308b\u4e8b\u306b\u3088\u308a\n\u81ea\u7531\u306a\u30d1\u30ec\u30c3\u30c8\u8a2d\u5b9a\u3092\u4f7f\u7528\u3059\u308b\u4e8b\u304c\u51fa\u6765\u307e\u3059\u3002\n\n\u25a1\u30de\u30c8\u30ea\u30af\u30b9\u306e\u53d6\u5f97\n1)\u300c\u53d6\u5f97\u300d\u30dc\u30bf\u30f3\u3088\u308a\u30d1\u30ec\u30c3\u30c8\u30de\u30c8\u30ea\u30af\u30b9\u3092\u53d6\u5f97\u3057\u307e\u3059\u3002\n2)\u53d6\u5f97\u3055\u308c\u305f\u60c5\u5831\u304c\u4e0b\u306e\u30c6\u30ad\u30b9\u30c8\u30a8\u30ea\u30a2\u306b\u51fa\u307e\u3059\u3001\u3053\u308c\u3092\u5168\u3066\u30b3\u30d4\u30fc\u3057\u307e\u3059\u3002\n3)\u3053\u306e\u30de\u30c8\u30ea\u30af\u30b9\u60c5\u5831\u3092\u30c6\u30ad\u30b9\u30c8\u3068\u3057\u3066\u30d5\u30a1\u30a4\u30eb\u306b\u4fdd\u5b58\u3057\u3066\u304a\u304f\u306a\u308a\u3057\u307e\u3057\u3087\u3046\u3002\n\n\u25a1\u30de\u30c8\u30ea\u30af\u30b9\u306e\u30bb\u30c3\u30c8\n1\uff09\u30b3\u30d4\u30fc\u3057\u305f\u30de\u30c8\u30ea\u30af\u30b9\u3092\u4e0b\u306e\u30c6\u30ad\u30b9\u30c8\u30a8\u30ea\u30a2\u306b\u8cbc\u308a\u4ed8\u3051(\u30da\u30fc\u30b9\u30c8)\u3057\u307e\u3059\u3002\n2)\u30d5\u30a1\u30a4\u30eb\u306b\u4fdd\u5b58\u3057\u3066\u3042\u308b\u5834\u5408\u306f\u3001\u305d\u308c\u3092\u30b3\u30d4\u30fc\u3057\u8cbc\u308a\u4ed8\u3051\u307e\u3059\u3002\n3)\u300c\u30bb\u30c3\u30c8\u300d\u30dc\u30bf\u30f3\u3092\u62bc\u305b\u3070\u4fdd\u5b58\u3055\u308c\u305f\u30d1\u30ec\u30c3\u30c8\u304c\u4f7f\u7528\u3067\u304d\u307e\u3059\u3002\n\n\u4f59\u5206\u306a\u60c5\u5831\u304c\u3042\u308b\u3068\u30d1\u30ec\u30c3\u30c8\u304c\u6b63\u3057\u304f\u30bb\u30c3\u30c8\u3055\u308c\u307e\u305b\u3093\u306e\u3067\u3054\u6ce8\u610f\u4e0b\u3055\u3044\u3002")}
function PaletteSet(){var a=document.forms.Palette;const b=a.setr.value,c=a.select;var f=a.m_m.selectedIndex;a=b.length;let e;if(1>a)alert("\u30de\u30c8\u30ea\u30af\u30b9\u60c5\u5831\u304c\u3042\u308a\u307e\u305b\u3093\u3002");else{var d;switch(f){default:for(d=c.length;0<d;)d--,c.options[d]=null;case 2:f=c.options.length;d=b.indexOf("!",0)+1;if(0==d)return;for(;d<a;){var g=b.indexOf("\n#",d);if(-1==g)return;const h=b.substring(d,g+1);d=b.indexOf("!",g);if(-1==d)return;e=b.substring(g+1,d+-1);"Palette"!=
h?(0<=f&&(c.options[f]=new Option(h)),Palettes[f]=e,f++):document.paintbbs.setColors(e);d+=1}break;case 1:d=b.indexOf("!",0)+1;if(0==d)return;g=b.indexOf("\n#",d);d=b.indexOf("!",g);0<=g&&(e=b.substring(g+1,d-1));document.paintbbs.setColors(e)}PaletteListSetColor()}}function PaletteListSetColor(){let a;const b=document.forms.Palette.select;for(a=1;b.options.length>a;a++){const c=Palettes[a].split("\n");b.options[a].style.background=c[4];b.options[a].style.color=GetBright(c[4])}}
function GetBright(a){let b=parseInt("0x"+a.substring(1,3)),c=parseInt("0x"+a.substring(3,5));a=parseInt("0x"+a.substring(5,7));a=b>=c?b>=a?b:a:c>=a?c:a;return 128>a?"#FFFFFF":"#000000"}function Chenge_(){const a=document.forms.grad,b=a.ped.value;isNaN(parseInt("0x"+a.pst.value))||isNaN(parseInt("0x"+b))||GradView()}
function ChengeGrad(){var a=document.forms.grad,b=a.pst.value,c=a.ped.value;Chenge_();var f=parseInt("0x"+b.substring(0,2)),e=parseInt("0x"+b.substring(2,4)),d=parseInt("0x"+b.substring(4,6));b=Math.trunc((f-parseInt("0x"+c.substring(0,2)))/15);a=Math.trunc((e-parseInt("0x"+c.substring(2,4)))/15);c=Math.trunc((d-parseInt("0x"+c.substring(4,6)))/15);isNaN(b)&&(b=1);isNaN(a)&&(a=1);isNaN(c)&&(c=1);let g="",h;for(h=0;14>h;h++,f-=b,e-=a,d-=c){if(255<f||0>f)b*=-1,f-=b;if(255<e||0>e)a*=-1,e-=a;if(255<d||
0>d)c*=-1,e-=c;g+="#"+Hex(f)+Hex(e)+Hex(d)+"\n"}document.paintbbs.setColors(g)}function Hex(a){a=Math.trunc(a);0>a&&(a*=-1);let b="";for(var c;16<a;)c=a,16<a&&(a=Math.trunc(a/16),c-=16*a),c=Hex_(c),b=c+b;c=Hex_(a);for(b=c+b;2>b.length;)b="0"+b;return b}function Hex_(a){isNaN(a)?a="":10==a?a="A":11==a?a="B":12==a?a="C":13==a?a="D":14==a?a="E":15==a&&(a="F");return a}
async function GetPalette(){var a=String(await document.paintbbs.getColors());if("null"!=a&&""!=a){a=a.split("\n");var b=document.forms.grad,c=b.p_ed.selectedIndex;b.pst.value=a[b.p_st.selectedIndex].substring(1,7);b.ped.value=a[c].substring(1,7);GradSelC();PaletteListSetColor()}}
async function GradSelC(){var a=String(await document.paintbbs.getColors());if("null"!=a&&""!=a){a=a.split("\n");var b=document.forms.grad,c;if(b.view.checked){var f=a.length,e="";for(c=0;f>c;c++){let d=255+-1*parseInt("0x"+a[c].substring(1,3)),g=255+-1*parseInt("0x"+a[c].substring(3,5)),h=255+-1*parseInt("0x"+a[c].substring(5,7));255<d?d=255:0>d&&(d=0);255<g?g=255:0>g&&(g=0);255<h?h=255:0>h&&(h=0);e+="#"+Hex(d)+Hex(g)+Hex(h)+"\n"}e=e.split("\n");for(c=0;f>c;c++)b.p_st.options[c].style.background=
a[c],b.p_st.options[c].style.color=e[c],b.p_ed.options[c].style.background=a[c],b.p_ed.options[c].style.color=e[c]}}}function GradView(){}function showHideLayer(){const a=document.forms.grad;var b=document.getElementById("psft");(b=b?b.style:null)&&!a.view.checked&&(b.visibility="hidden");b&&a.view.checked&&(b.visibility="visible",GetPalette())};
</script>
	<!--動的パレットスクリプト ここまで-->
	<noscript>
		<h3>JavaScriptが有効でないため正常に動作致しません。</h3>
	</NOSCRIPT>
	<div class="appstage">
		<div class="app" style="width:{{$w}}px; height:{{$h}}px">
			<!--applet～の～部分の詳しい事は、PaintBBS及びしぃペインターのReadmeを参照-->
			<!--PaintBBS個別設定-->
			@if($paintbbs)
			<!-- NEOを使う時はアプレットを読み込まないように -->
			@if($useneo) <applet-dummy @else<applet @endif CODE="pbbs.PaintBBS.class" ARCHIVE="./PaintBBS.jar" NAME="paintbbs"
				WIDTH="{{$w}}" HEIGHT="{{$h}}" MAYSCRIPT>
				@if(isset($max_pch))
				<param name="neo_max_pch" value="{{$max_pch}}">
				@endif
				<param name="neo_send_with_formdata" value="true">
				<param name="neo_validate_exact_ok_text_in_response" value="true">
				<param name="neo_confirm_layer_info_notsaved" value="true">
				<param name="neo_confirm_unload" value="true">
				<param name="neo_show_right_button" value="true">
				<param name="neo_animation_skip" value="true">
				<param name="neo_disable_grid_touch_move" value="true">
				<param name="neo_enable_zoom_out" value="true">
				@endif
				<!--しぃペインター個別設定-->
				@if($normal)
				<applet code="c.ShiPainter.class" archive="spainter_all.jar" name="paintbbs" WIDTH="{{$w}}" HEIGHT="{{$h}}"
					MAYSCRIPT>
					<param name=dir_resource value="./">
					<param name="tt.zip" value="tt_def.zip">
					<param name="res.zip" value="res.zip">
					{{-- しぃペインターv1.05_9以前を使うなら res_normal.zip に変更 --}}
					<param name=tools value="normal">
					<param name=layer_count value="{{$layer_count}}">
					@if($quality)
					<param name=quality value="{{$quality}}">
					@endif
					@endif
					<!--しぃペインターPro個別設定-->
					@if($pro)
					<applet code="c.ShiPainter.class" archive="spainter_all.jar" name="paintbbs" WIDTH="{{$w}}" HEIGHT="{{$h}}"
						MAYSCRIPT>
						<param name=dir_resource value="./">
						<param name="tt.zip" value="tt_def.zip">
						<param name="res.zip" value="res.zip">
						<param name=tools value="pro">
						<param name=layer_count value="{{$layer_count}}">
						@if($quality)
						<param name=quality value="{{$quality}}">
						@endif
						@endif
						<!--共通設定(変更不可)-->
						<param name="send_header_count" value="true">
						<param name="send_header_timer" value="true">
						<param name="image_width" value="{{$picw}}">
						<param name="image_height" value="{{$pich}}">
						<param name="image_jpeg" value="{{$image_jpeg}}">
						<param name="image_size" value="{{$image_size}}">
						<param name="compress_level" value="{{$compress_level}}">
						<param name="undo" value="{{$undo}}">
						<param name="undo_in_mg" value="{{$undo_in_mg}}">
						<param name="poo" value="false">
						<param name="send_advance" value="true">
						<param name="tool_advance" value="true">
						<param name="thumbnail_width" value="100%">
						<param name="thumbnail_height" value="100%">
						@if($useneo)
						{{-- neo --}}
						<param name="url_save" value="{{$self}}?mode=saveimage&amp;tool=neo">
						<param name="send_header" value="usercode={{$usercode}}&amp;tool={{$tool}}">
						<param name="url_exit" value="{{$self}}?mode={{$mode}}&amp;stime={{$stime}}">
						@else
						{{-- しぃペインター --}}
						<param name="url_save" value="{{$self}}?mode=picpost">
						<param name="send_header"
							value="usercode={{$usercode}}&amp;tool={{$tool}}&amp;rep={{$rep}}&amp;no={{$no}}&amp;pwd={{$pwd}}">
						@if($rep)
						<param name="url_exit" value="{{$self}}?res={{$oyano}}&amp;resid={{$no}}">
						@else
						<param name="url_exit" value="{{$self}}?mode=piccom&amp;stime={{$stime}}">
						@endif
						@endif
						@if($anime)
						<param name="thumbnail_type" value="animation">
						@endif
						@if($pchfile)
						<param name="pch_file" value="{{$pchfile}}">
						@endif
						@if($imgfile)
						<param name="image_canvas" value="{{$imgfile}}">
						@endif
						<!--共通設定(変更不可) ここまで-->
						<!--アプレットのカラー設定(変更可)-->
						<!--アプレットのカラー設定(変更可) ここまで-->
						@if($useneo)
			</applet-dummy>
			@else
			</applet>
			@endif
		</div>
		<!--動的パレット制御関連-->
		<div class="palette_wrap">
			<div class="palette">
				<FORM name="Palette">
					<span class="palette_desc">PALETTE</span> <INPUT type="button" VALUE="一時保存" OnClick="PaletteSave()"><br>
					<select name="select" size="{{$palsize}}" onChange="setPalette()" class="palette_select">
						<option>一時保存パレット</option>
						@if($dynp)
						@foreach ($dynp as $p)
						<option>{{$p}}</option>
						@endforeach

						@endif
						@endif
						@if($chickenpaint)
						@else

					</select><br>
					<INPUT type="button" VALUE="作成" OnClick="PaletteNew()">
					<INPUT type="button" VALUE="変更" OnClick="PaletteRenew()">
					<INPUT type="button" VALUE="削除" OnClick="PaletteDel()"><br>
					<INPUT type="button" VALUE="明＋" OnClick="P_Effect(10)">
					<INPUT type="button" VALUE="明－" OnClick="P_Effect(-10)">
					<INPUT type="button" VALUE="反転" OnClick="P_Effect(255)">
					<hr class="palette_hr"><span class="palette_desc">MATRIX</span>
					<SELECT name="m_m">
						<option value="0">全体</option>
						<option value="1">現在</option>
						<option value="2">追加</option>
					</SELECT><br>
					<INPUT name="m_g" type="button" VALUE="取得" OnClick="PaletteMatrixGet()">
					<INPUT name="m_s" type="button" VALUE="セット" OnClick="PalleteMatrixSet()">
					<INPUT name="m_h" type="button" VALUE=" ? " OnClick="PalleteMatrixHelp()"><br>
					<TEXTAREA rows="1" name="setr" cols="13" onMouseOver="this.select()"></TEXTAREA><br>
				</FORM>
			</div>
			<div class="palette_gradation">
				<FORM name="grad">
					<label class="palette_desc checkbox"><INPUT type="checkbox" name="view" OnClick="showHideLayer()"
							id="grdchk">GRADATION&nbsp;</label><INPUT type="button" VALUE=" OK " OnClick="ChengeGrad()"><br>
					<SELECT name="p_st" onChange="GetPalette()">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
					</SELECT><input type="text" name="pst" size="8" onKeyPress="Chenge_()" onChange="Chenge_()"><br>
					<SELECT name="p_ed" onChange="GetPalette()">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>11</option>
						<option selected>12</option>
						<option>13</option>
						<option>14</option>
					</SELECT><input type="text" name="ped" size="8" onKeyPress="Chenge_()" onChange="Chenge_()">
					<div id="psft"></div>
				</FORM>
			</div>
			<Script>
				if(DynamicColor) PaletteListSetColor();
			</Script>
		</div>
	</div>
	<!--動的パレット制御関連 ここまで-->


	<div class="centering">
		<!--描画時間動的表示-->
		<div class="applet_painttime">
			<form name="watch">描画時間
				<input type="text" size="20" name="count" class="input_count_timer" readonly>
			</form>
			<Script>
				timerID=10;stime=new Date;function SetTimeCount(){now=new Date;s=Math.floor((now.getTime()-stime.getTime())/1E3);disp="";86400<=s&&(d=Math.floor(s/86400),disp+=d+"\u65e5",s-=86400*d);3600<=s&&(h=Math.floor(s/3600),disp+=h+"\u6642\u9593",s-=3600*h);60<=s&&(m=Math.floor(s/60),disp+=m+"\u5206",s-=60*m);document.watch.count.value=disp+s+"\u79d2";clearTimeout(timerID);timerID=setTimeout(function() { SetTimeCount(); },250);};
	document.addEventListener('DOMContentLoaded',SetTimeCount,false);
			</Script>
		</div>
		<!--描画時間動的表示 ここまで-->
		<p>@if($anime) ★描画アニメ記録中★@endif</p>
		<!--お絵かき設定値の再設定関連-->
		<!--お絵かき設定値の再設定関連 ここまで-->
		<a href="{{$self}}?mode=piccom" target="_blank" rel="noopener">アップロード途中の画像</a>
	</div>
	<!--PaintBBS HELP START-->
	<div class="paintbbs_memo">
		<div>基本の動作(恐らくこれだけは覚えておいた方が良い機能)</div>
		<div>
			&lt;基本&gt;<br>PaintBBSでは右クリック,ctrl+クリック,alt+クリックは同じ動作をします。<br>基本的に操作は一回のクリックか右クリックで動作が完了します。(ベジエやコピー使用時を除く)<br><br>&lt;ツールバー&gt;<br>ツールバーの殆どのボタンは複数回クリックして機能を切り替える事が出来ます。<br>右クリックで逆周り。パレットの色,マスクの色,一時保存ツールに現在の状態を登録、レイヤー表示非表示切り替え等全て右クリックです。<br>逆にクリックでパレットの色と一時保存ツールに保存しておいた状態を取り出せます。<br><br>&lt;キャンバス部分&gt;<br>右クリックで色をスポイトします<br>ベジエやコピー等の処理の途中で右クリックを押すとリセットします。
		</div><br>
		<div>特殊動作(使う必要は無いが慣れれば便利な機能)</div>
		<div>
			&lt;ツールバー&gt;<br>値を変更するバーはドラッグ時バーの外に出した場合変化が緩やかになりますのでそれを利用して細かく変更する事が出来ます。<br>パレットはShift+クリックで色をデフォルトの状態に戻します。<br><br>&lt;キーボードのショートカット&gt;<br>+で拡大-で縮小。
			<br>Ctrl+ZかCtrl+Uで元に戻す、Ctrl+Alt+ZかCtrl+Yでやり直し。<br>Escでコピーやベジエのリセット。（右クリックでも同じ）
			<br>スペースキーを押しながらキャンバスをドラッグするとスクロールの自由移動。<br>Ctrl+Alt+ドラッグで線の幅を変更。<br><br>&lt;コピーツールの特殊な利用方法&gt;<br>レイヤー間の移動は現時点ではコピーとレイヤー結合のみです。コピーでの移動方法は、<br>まず移動したいレイヤー上の長方形を選択後、移動させたいレイヤーを選択後に通常のコピーの作業を<br>続けます。そうする事によりレイヤー間の移動が可能になります。<br>
		</div><br>
		<div>ツールバーのボタンと特殊な機能の簡単な説明</div>
		<div>
			<ul>
				<li>ペン先(通常ペン,水彩ペン,テキスト)<br>メインのフリーライン系のペンとテキスト<br><br></li>
				<li>ペン先2(トーン,ぼかし,他)<br>特殊な効果を出すフリーライン系のペン<br><br></li>
				<li>図形(円や長方形)<br>長方形や円等の図形<br><br></li>
				<li>特殊(コピーやレイヤー結合,反転等)<br>コピーは一度選択後、ドラッグして移動、コピーさせるツールです。<br><br></li>
				<li>マスクモード指定(通常,マスク,逆マスク）<br>マスクで登録されている色を描写不可にします。逆マスクはその逆。<br>通常でマスク無し。また右クリックでマスクカラーの変更が可能。<br><br></li>
				<li>
					消しゴム(消しペン,消し四角,全消し)<br>透過レイヤー上を白で塗り潰した場合、下のレイヤーが見えなくなりますので上位レイヤーの線を消す時にはこのツールで消す様にして下さい。全消しはすべてを透過ピクセル化させるツールです。<br>全消しを利用する場合はこのツールを選択後キャンバスをクリックでOK。<br>消しゴムは独立した線の幅を持っています。<br><br>
				</li>
				<li>描写方法の指定。(手書き,直線,ベジエ曲線)<br>ペン先,描写機能指定ではありません。<br>また適用されるのはフリーライン系のツールのみです。<br><br></li>
				<li>カラーパレット群<br>クリックで色取得。右クリックで色の登録。Shift+クリックでデフォルト値。<br><br></li>
				<li>RGBバーとalphaバー<br>細かい色の変更と透過度の変更。Rは赤,Gは緑,Bは青,Aは透過度を指します。<br>トーンはAlphaバーで値を変更する事で密度の変更が可能です。<br><br></li>
				<li>線幅変更ツール<br>水彩ペンを選択時に線幅を変更した時、デフォルトの値がalpha値に代入されます。<br><br></li>
				<li>線一時保存ツール<br>クリックでデータ取得。右クリックでデータの登録。(マスク値は登録しません)<br><br></li>
				<li>
					レイヤーツール<br>PaintBBSは透明なキャンバスを二枚重ねたような構造になっています。<br>つまり主線を上に書き、色を下に描くと言う事も可能になるツールです。<br>通常レイヤーと言う種類の物ですので鉛筆で描いたような線もキッチリ透過します。<br>クリックでレイヤー入れ替え。右クリックで選択されているレイヤーの表示、非表示切り替え。<br><br>
				</li>
			</ul>
		</div>投稿に関して： <div>
			絵が完成したら投稿ボタンで投稿します。<br>絵の投稿が成功した場合は指定されたURLへジャンプします。<br>失敗した場合は失敗したと報告するのみでどこにも飛びません。<br>単に重かっただけである場合、少し間を置いた後、再度投稿を試みて下さい。<br>この際二重で投稿される場合があるかもしれませんが<br>それはWebサーバーかCGI側の処理ですのであしからず。
		</div>
	</div>
	<!--PaintBBS HELP END-->
	@endif
	@endif
	{{-- お絵かきモード ここまで --}}
	{{-- 動画表示モード --}}
	{{--
	// pch_mode…動画表示モードのとき true が入る
	// paintbbs…PaintBBSのPCHファイルなら true が入る
	// normal…しぃペインターのSPCHファイルなら true が入る
	// w…アプレット領域サイズ(横)
	// h…アプレット領域サイズ(縦)
	// picw…キャンバスサイズ(横)
	// pich…キャンバスサイズ(縦)
	// pchfile…動画ファイル名(.pch or .spch)
	// speed…動画再生スピード初期値
	// datasize…動画ファイルサイズ(Byte)
	--}}
	@if($pch_mode)
	</header>
	<div class="appstage" style="width:{{$w}}px; height:{{$h}}px">
		@if($paintbbs)
		@if($type_neo) <applet-dummy @else <applet @endif name="pch" code="pch.PCHViewer.class"
			archive="PCHViewer.jar,PaintBBS.jar" width="{{$w}}" height="{{$h}}" MAYSCRIPT>
			@endif
			@if($normal)
			<applet name="pch" code="pch2.PCHViewer.class" archive="PCHViewer.jar,spainter_all.jar" codebase="./"
				width="{{$w}}" height="{{$h}}">
				<param name="res.zip" value="res.zip">
				{{-- しぃペインターv1.05_9以前を使うなら res_normal.zip に変更 --}}
				<param name="tt.zip" value="tt_def.zip">
				<param name="tt_size" value="31">
				@endif
				<param name="image_width" value="{{$picw}}">
				<param name="image_height" value="{{$pich}}">
				<param name="pch_file" value="{{$pchfile}}">
				<param name="speed" value="{{$speed}}">
				<param name="buffer_progress" value="false">
				<param name="buffer_canvas" value="false">
				<param name="neo_enable_zoom_out" value="true">
	@if($type_neo)
		</applet-dummy>
		@else
		</applet>
		@endif
	</div>
	<div class="pch_download">
		<A href="{{$pchfile}}" target="_blank" rel="nofollow noopener noreferrer">Download</A><br>
		<small>Datasize : {{$datasize}} KB</small><br>
		<a href="{{$self}}?res={{$oyano}}#{{$no}}">{{$title}}</a> / <a href="javascript:close()">閉じる</a>
	</div>
	@endif
	<!--動画表示モード ここまで-->
	{{--
	<!--コンティニューモード --> --}}
	{{--
	// continue_mode…コンティニューモードのとき true が入る
	// home…ホームページURL
	// self…POTI-boardのスクリプト名
	// self2…入口(TOP)ページのURL
	// picfile…画像URL
	// picw…画像サイズ(横)
	// pich…画像サイズ(縦)
	// painttime…描画時間
	// no…記事No
	// pch…動画ファイル名
	// ext…画像拡張子
	// ctype_pch…動画より続きが描けるとき true が入る
	// ctype_img…画像より続きが描けるとき true が入る
	// applet…しぃペインターが使用できるとき true が入る
	// usepbbs…しぃペインターとPaintBBSの両方が使用できるとき true が入る
	// palette…パレット選択用データ(selectタグ用option配列)
	--}}

	@if($continue_mode)

	<nav>
		<div id="self2">
			[<a href="{{$self}}?res={{$oyano}}#{{$no}}">{{$title}}</a>]
		</div>
	</nav>
	</header>
	<div class="centering">
		<!--クッキー読込み用JavaScript(必須)-->
		<Script src="loadcookie.js?{{$ver}}"></script>
		<!--画像と描画時間-->
		<div class="continue_img">
			<img src="{{$picfile}}" width="{{$picw}}" height="{{$pich}}"
				alt="@if($sub){{$sub}} @endif @if($name) by {{$name}} @endif{{$picw}} x {{$pich}}"
				title="@if($sub){{$sub}} @endif @if($name) by {{$name}} @endif{{$picw}} x {{$pich}}">
		</div>
		<div class="continue_painttime">@if($painttime) 描画時間：{{$painttime}}@endif</div>
		<!--コンティニューフォーム欄-->
		<div class="continue_post_form">
			@if($download_app_dat)
			<form action="{{$self}}" method="post">
				<input type="hidden" name="mode" value="download">
				<input type="hidden" name="no" value="{{$no}}">
				<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
				<span class="nk">削除キー<input type="password" name="pwd" value="" class="paint_password"
						autocomplete="current-password"></span>
				<input type="submit" value="{{$pch_ext}}ファイルをダウンロード">
			</form>
			@endif

			<form action="{{$self}}" method="post">
				<input type="hidden" name="mode" value="contpaint">
				<input type="hidden" name="anime" value="true">
				<input type="hidden" name="picw" value="{{$picw}}">
				<input type="hidden" name="pich" value="{{$pich}}">
				<input type="hidden" name="no" value="{{$no}}">
				<input type="hidden" name="pch" value="{{$pch}}">
				<input type="hidden" name="ext" value="{{$ext}}">
				<span class="nk">
					<select name="ctype" class="paint_select">
						@if($ctype_pch) <option value="pch">動画より続きを描く</option>@endif
						@if($ctype_img) <option value="img">画像より続きを描く</option>@endif
					</select>
					画像は <select name="type" class="paint_select" id="select_post">
						<option value="rep">差し換え</option>
						<option value="new">新規投稿</option>
					</select>
				</span>
				<span class="nk" id="span_cont_paint_same_thread">
					<input type="checkbox" name="cont_paint_same_thread" id="cont_paint_same_thread" value="on"
						checked="checked"><label for="cont_paint_same_thread" class="bold_gray">同じスレッドに投稿する</label>
				</span>
				<br>
				{{--
				//select_app ツールの選択メニューを出す時にtrueが入る
				//use_shi_painter しぃペインターを使う設定の時にtrueが入る
				//use_chickenpaint を使う設定の時にtrueが入る
				//app_to_use 動画やレイヤー情報などの固有形式があるときに対応するアプリが入る
				--}}

				@if($select_app)
				<select name="shi" class="paint_select">
					@if($use_neo)<option value="neo">PaintBBS NEO</option>@endif
					@if($use_tegaki)<option value="tegaki">Tegaki</option>@endif
					@if($use_axnos)<option value="axnos">Axnos Paint</option>@endif
					@if($use_shi_painter) <option value="1" class="for_pc">しぃペインター</option>@endif
					@if($use_chickenpaint) <option value="chicken">litaChix</option>@endif
					@if($use_klecks)<option value="klecks">Klecks</option>@endif
				</select>
				@endif
				@if($app_to_use)
				<input type="hidden" name="shi" value="{{$app_to_use}}">
				@endif

				@if($use_select_palettes)
				<span class="palette_type">PALETTE</span> <select name="selected_palette_no" title="パレット"
					class="paint_select palette_type">{!!$palette_select_tags!!}</select>
				@endif
				<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
				<span class="nk" id="span_cont_pass">削除キー<input type="password" name="pwd" value="" class="paint_password"
						autocomplete="current-password"></span>
				<input type="submit" value="続きを描く">

			</form>
		</div>
		<!--コンティニュー説明-->
		<div class="howtocontinue">
			<ul id="up_desc">
				@if($newpost_nopassword)
				<li>新規投稿なら削除キーがなくても続きを描く事ができます。</li>
				@else
				<li>続きを描くには描いたときの削除キーが必要です。</li>
				@endif
			</ul>
		</div>

		<script>
			// 新規投稿時にのみ、同じスレッドに投稿するボタンを表示
	document.getElementById('select_post').addEventListener('change', function() {
		const idx=document.getElementById('select_post').selectedIndex;
		console.log(idx);
		const cont_paint_same_thread=document.getElementById('span_cont_paint_same_thread');
		const cont_pass=document.getElementById('span_cont_pass');
		if(idx === 1){
			if(cont_paint_same_thread){
				cont_paint_same_thread.style.display = "inline-block";
			}
			@if($newpost_nopassword) 
			if(cont_pass){
			cont_pass.style.display = "none";
			}
			@endif
		}else{
			if(cont_paint_same_thread){
				cont_paint_same_thread.style.display = "none";
			}
			@if($newpost_nopassword) 
			if(cont_pass){
				cont_pass.style.display = "inline-block";
			}
			@endif
		}
	});
		</script>

		<!--JavaScriptの実行(クッキーを読込み、フォームに値をセット)-->
		<script>
			document.addEventListener('DOMContentLoaded',l,false);
		</script>
	</div>
	<script src="lib/{{$jquery}}"></script>
	<script src="{{$skindir}}js/basic_common.js?{{$ver}}"></script>
	@endif
	<!--コンティニューモード ここまで-->
	<!--著作権表示 削除しないでください-->
	<footer>
		{{--
		<!--著作権表示 削除しないでください--> --}}
		@include('parts.copyright')
	</footer>
</body>

</html>