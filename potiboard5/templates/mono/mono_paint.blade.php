<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<style>
		div#appstage,
		div#chickenpaint-parent {
			letter-spacing: initial;
			word-break: initial;
			overflow-wrap: initial;
		}

		.input_disp_none {
			display: none;
		}
	</style>
	@if(!$chickenpaint)
	@include('parts.style-switcher')
	<link rel="preload" as="script" href="lib/{{$jquery}}">
	<link rel="preload" as="script" href="{{$skindir}}js/mono_common.js?{{$ver}}">
	{{-- アプレットの幅がmax-widthを超える時はmax-widthにアプレット+パレットの幅を設定する --}}

	@isset($w)
	@if(($w+192)>1350)
	<style>
		header,
		main>section>.thread,
		main>div#catalog,
		footer>div,
		footer>div.copy {
			margin: 0px auto;
			display: block;

			max-width: calc({
					{
					$w
				}
			}

			px + 192px);
		}
	</style>
	@endif
	@endisset

	@endif

	@if($paint_mode)
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	@endif
	@if($pch_mode)
	<meta name="viewport" content="width=device-width,initial-scale=1.0">@endif
	@if($continue_mode)
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<style>
		/* index.cssを更新しない人がいるかもしれないためインラインでも記述 */
		#span_cont_paint_same_thread {
			display: none;
		}
	</style>
	@endif
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
	@if($pch_mode)
	@if($type_neo)
	<link rel="stylesheet" href="neo.css?{{$parameter_day}}&{{$ver}}">
	<script src="neo.js?{{$parameter_day}}&{{$ver}}"></script>
	@endif
	@endif
	@if($chickenpaint)
	<style>
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
				document.addEventListener('dblclick', function (e){ e.preventDefault()}, { passive: false });
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
	@if($paint_mode)
	<style>
		body {
			overscroll-behavior-x: none !important;
		}
	</style>
	@endif

	<title>{{$title}}</title>
	<style id="for_mobile"></style>

</head>

<body id="paintmode">


	@if(!$chickenpaint)
	<header>
		<h1><a href="{{$self2}}">{{$title}}</a></h1>
		<div>
			<a href="{{$home}}" target="_top">[ホーム]</a>
			@if($use_admin_link)<a href="{{$self}}?mode=admin">[管理モード]</a>@endif
		</div>
		<hr>
		<div>
			<p class="menu">
				@if($continue_mode||$pch_mode)
				<a href="{{$self}}?res={{$oyano}}#{{$no}}">[もどる]</a>
				@else
				<a href="{{$self2}}">[もどる]</a>
				@endif
			</p>
		</div>
		<hr>
		@if($paint_mode)
		<h2 class="oekaki">OEKAKI MODE</h2>
		@endif
		@if($continue_mode)
		<h2 class="oekaki">CONTINUE MODE</h2>
		@endif
	</header>
	@endif

	<main>
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
					'X-Requested-With': 'chickenpaint'
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
		{{--
		<!-- (========== PAINT MODE(お絵かきモード) start ==========) --> --}}
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
			<p>JavaScriptが有効でないため正常に動作致しません。</p>
		</noscript>

		<div id="appstage">
			<div class="app" style="width:{{$w}}px; height:{{$h}}px">


				@if($paintbbs)
				@if($useneo)
				<applet-dummy code="pbbs.PaintBBS.class" archive="./PaintBBS.jar" name="paintbbs" width="{{$w}}" height="{{$h}}"
					mayscript>
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
					@else
					<applet code="pbbs.PaintBBS.class" archive="./PaintBBS.jar" name="paintbbs" width="{{$w}}" height="{{$h}}"
						mayscript>
						@endif
						@endif
						<!--しぃペインター個別設定-->
						@if($normal)
						<applet code="c.ShiPainter.class" archive="spainter_all.jar" name="paintbbs" WIDTH="{{$w}}" HEIGHT="{{$h}}"
							mayscript>
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
							<applet code="c.ShiPainter.class" archive="spainter_all.jar" name="paintbbs" width="{{$w}}"
								height="{{$h}}" mayscript>
								<param name=dir_resource value="./">
								<param name="tt.zip" value="tt_def.zip">
								<param name="res.zip" value="res.zip">
								<!--(しぃペインターv1.05_9以前を使うなら res_pro.	zip に変更)-->
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
								<param name="poo" value="false">
								<param name="send_advance" value="true">
								<param name="thumbnail_width" value="100%">
								<param name="thumbnail_height" value="100%">
								<param name="tool_advance" value="true">
								@if($useneo)
				</applet-dummy>
				@else
				</applet>
				@endif
			</div>
			<div class="palette_wrap">
				<div class="palette">
					<form name="Palette">
						@if($useneo)
						<fieldset>
							<legend>TOOL</legend>
							<input class="button" type="button" value="左" onclick="Neo.setToolSide(true)">
							<input class="button" type="button" value="右" onclick="Neo.setToolSide(false)">
						</fieldset>
						@endif
						<fieldset>
							<legend>PALETTE</legend>
							<select class="form palette_select" name="select" size="{{$palsize}}" onchange="setPalette()">
								<option>一時保存パレット</option>
								@if($dynp)
								@foreach ($dynp as $p)
								<option>{{$p}}</option>
								@endforeach
								@endif
							</select><br>
							<input class="button" type="button" value="一時保存" onclick="PaletteSave()"><br>
							<input class="button" type="button" value="作成" onclick="PaletteNew()">
							<input class="button" type="button" value="変更" onclick="PaletteRenew()">
							<input class="button" type="button" value="削除" onclick="PaletteDel()"><br>
							<input class="button" type="button" value="明＋" onclick="P_Effect(10)">
							<input class="button" type="button" value="明－" onclick="P_Effect(-10)">
							<input class="button" type="button" value="反転" onclick="P_Effect(255)">
						</fieldset>
						<fieldset>
							<legend>MATRIX</legend>
							<select class="form" name="m_m">
								<option value="0">全体</option>
								<option value="1">現在</option>
								<option value="2">追加</option>
							</select>
							<input type="button" class="button" name="m_g" value="GET" onclick="PaletteMatrixGet()">
							<input type="button" class="button" name="m_h" value="SET" onclick="PalleteMatrixSet()">
							<input type="button" class="button" name="1" value=" ? " onclick="PalleteMatrixHelp()"><br>
							<textarea class="form" name="setr" rows="1" cols="13" onmouseover="this.select()"></textarea>
						</fieldset>
					</form>
					<form name="grad">
						<fieldset>
							<legend>GRADATION</legend>
							<input type="checkbox" name="view" onclick="showHideLayer()">
							<input type="button" class="button" value=" OK " onclick="ChengeGrad()"><br>
							<select class="form" name="p_st" onchange="GetPalette()">
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
							</select>
							<input class="form" type="text" name="pst" size="8" onkeypress="Chenge_()" onchange="Chenge_()"><br>
							<select class="form" name="p_ed" onchange="GetPalette()">
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
							</select>
							<input class="form" type="text" name="ped" size="8" onkeypress="Chenge_()" onchange="Chenge_()">
							<div id="psft"></div>
							<script>
								if(DynamicColor) PaletteListSetColor();
							</script>
						</fieldset>
						<p class="c">DynamicPalette &copy;NoraNeko</p>
					</form>
				</div>
			</div>
		</div>
		@if($paint_mode)
		<section>
			<div class="thread">
				<hr>
				<div class="timeid">
					<form class="watch" action="index.html" name="watch">
						<p>
							PaintTime :
							<input type="text" size="24" name="count" readonly>
						</p>
						<script>
							timerID = 10; stime = new Date; function SetTimeCount() { now = new Date; s = Math.floor((now.getTime() - stime.getTime()) / 1E3); disp = ""; 86400 <= s && (d = Math.floor(s / 86400), disp += d + "\u65e5", s -= 86400 * d); 3600 <= s && (h = Math.floor(s / 3600), disp += h + "\u6642\u9593", s -= 3600 * h); 60 <= s && (m = Math.floor(s / 60), disp += m + "\u5206", s -= 60 * m); document.watch.count.value = disp + s + "\u79d2"; clearTimeout(timerID); timerID = setTimeout(function(){ SetTimeCount(); }, 250); };
								document.addEventListener('DOMContentLoaded',SetTimeCount,false);
						</script>
					</form>
					<hr>
				</div>
			</div>
		</section>
		@endif
		<section>
			<div class="thread siihelp">
				<p>
					ミスしてページを変えたりウインドウを消してしまったりした場合は落ちついて同じキャンバスの幅で編集ページを開きなおしてみて下さい。大抵は残っています。
				</p>
				<h2>基本の動作(恐らくこれだけは覚えておいた方が良い機能)</h2>
				<h3>基本</h3>
				<p>
					PaintBBSでは右クリック、ctrl+クリック、alt+クリックは同じ動作をします。<br>
					基本的に操作は一回のクリックか右クリックで動作が完了します。(ベジエやコピー使用時を除く)
				</p>
				<h3>ツールバー</h3>
				<p>
					ツールバーの殆どのボタンは複数回クリックして機能を切り替える事が出来ます。<br>
					右クリックで逆周り。その他パレットの色、マスクの色、一時保存ツールに現在の状態を登録、レイヤー表示非表示切り替え等全て右クリックです。<br>
					逆にクリックでパレットの色と一時保存ツールに保存しておいた状態を取り出せます。
				</p>
				<h3>キャンバス部分</h3>
				<p>
					右クリックで色をスポイトします。<br>
					ベジエやコピー等の処理の途中で右クリックを押すとリセットします。
				</p>
				<h2>特殊動作(使う必要は無いが慣れれば便利な機能)</h2>
				<h3>ツールバー</h3>
				<p>
					値を変更するバーはドラッグ時バーの外に出した場合変化が緩やかになりますのでそれを利用して細かく変更する事が出来ます。パレットはShift+クリックで色をデフォルトの状態に戻します。
				</p>
				<h3>キーボードのショートカット</h3>
				<ul>
					<li>+で拡大-で縮小。</li>
					<li>Ctrl+ZかCtrl+Uで元に戻す、Ctrl+Alt+ZかCtrl+Yでやり直し。</li>
					<li>Escでコピーやベジエのリセット。（右クリックでも同じ） </li>
					<li>スペースキーを押しながらキャンバスをドラッグするとスクロールの自由移動。</li>
					<li>Ctrl+Alt+ドラッグで線の幅を変更。</li>
				</ul>
				<h3>コピーツールの特殊な利用方法</h3>
				<p>
					レイヤー間の移動は現時点ではコピーとレイヤー結合のみです。コピーでの移動方法は、まず移動したいレイヤー上の長方形を選択後、移動させたいレイヤーを選択後に通常のコピーの作業を続けます。そうする事によりレイヤー間の移動が可能になります。
				</p>
				<h2>ツールバーのボタンと特殊な機能の簡単な説明</h2>
				<dl>
					<dt>ペン先(通常ペン,水彩ペン,テキスト)</dt>
					<dd>
						メインのフリーライン系のペンとテキスト
					</dd>
					<dt>ペン先2(トーン,ぼかし,他)</dt>
					<dd>
						特殊な効果を出すフリーライン系のペン
					</dd>
					<dt>図形(円や長方形)</dt>
					<dd>
						長方形や円等の図形
					</dd>
					<dt>特殊(コピーやレイヤー結合,反転等)</dt>
					<dd>
						コピーは一度選択後、ドラッグして移動、コピーさせるツールです。
					</dd>
					<dt>マスクモード指定(通常,マスク,逆マスク）</dt>
					<dd>
						マスクで登録されている色を描写不可にします。逆マスクはその逆。<br>
						通常でマスク無し。また右クリックでマスクカラーの変更が可能。
					</dd>
					<dt>消しゴム(消しペン,消し四角,全消し)</dt>
					<dd>
						透過レイヤー上を白で塗り潰した場合、下のレイヤーが見えなくなりますので上位レイヤーの線を消す時にはこのツールで消す様にして下さい。<br>
						全消しはすべてを透過ピクセル化させるツールです。<br>
						全消しを利用する場合はこのツールを選択後キャンバスをクリックでOK。
					</dd>
					<dt>描写方法の指定。(手書き,直線,ベジエ曲線)</dt>
					<dd>
						ペン先,描写機能指定ではありません。<br>
						また適用されるのはフリーライン系のツールのみです。
					</dd>
					<dt>カラーパレット郡</dt>
					<dd>
						クリックで色取得。右クリックで色の登録。Shift+クリックでデフォルト値。
					</dd>
					<dt>RGBバーとalphaバー</dt>
					<dd>
						細かい色の変更と透過度の変更。Rは赤,Gは緑,Bは青,Aは透過度を指します。<br>
						トーンはAlphaバーで値を変更する事で密度の変更が可能です。
					</dd>
					<dt>線幅変更ツール</dt>
					<dd>
						水彩ペンを選択時に線幅を変更した時、デフォルトの値がalpha値に代入されます。
					</dd>
					<dt>線一時保存ツール</dt>
					<dd>
						クリックでデータ取得。右クリックでデータの登録。(マスク値は登録しません)
					</dd>
					<dt>レイヤーツール</dt>
					<dd>
						PaintBBSは透明なキャンバスを二枚重ねたような構造になっています。<br>
						つまり主線を上に書き、色を下に描くと言う事も可能になるツールです。<br>
						通常レイヤーと言う種類の物ですので鉛筆で描いたような線もキッチリ透過します。<br>
						クリックでレイヤー入れ替え。右クリックで選択されているレイヤーの表示、非表示切り替え。
					</dd>
				</dl>
				<h2>投稿に関して</h2>
				<p>
					絵が完成したら投稿ボタンで投稿します。絵の投稿が成功した場合は指定されたURLへジャンプします。失敗した場合は失敗したと報告するのみでどこにも飛びません。単に重かっただけである場合少し間を置いた後、再度投稿を試みて下さい。この際二重で投稿される場合があるかもしれませんが、それはWebサーバーかCGI側の処理ですのであしからず。
				</p>
			</div>
		</section>
		<!-- (========== PAINT MODE(お絵かきモード) end ==========) -->
		@endif
		@endif
		@if($pch_mode)

		<!-- (========== 動画表示モード ==========) -->
		<div id="appstage">
			<div class="app">
				<div style="width:{{$w}}px; height:{{$h}}px">
					@if($paintbbs)
					@if($type_neo)
					<applet-dummy code="pch.PCHViewer.class" archive="PCHViewer.jar,PaintBBS.jar" name="pch" width="{{$w}}"
						height="{{$h}}" mayscript>
						@else
						<applet code="pch.PCHViewer.class" archive="PCHViewer.jar,PaintBBS.jar" name="pch" width="{{$w}}"
							height="{{$h}}" mayscript>
							@endif
							@endif
							@if($normal)
							<applet name="pch" code="pch2.PCHViewer.class" archive="PCHViewer.jar,spainter_all.jar" codebase="./"
								width="{{$w}}" height="{{$h}}">
								@endif
								@if($normal)
								<param name="res.zip" value="res.zip">
								<!--(しぃペインターv1.05_9以前を使うなら res_normal.zip に変更)-->
								<param name="tt.zip" value="tt_def.zip">
								<param name="tt_size" value="31">
								@endif
								<param name="image_width" value="{{$picw}}">
								<param name="image_height" value="{{$pich}}">
								<param name="pch_file" value="{{$pchfile}}">
								<param name="speed" value="{{$speed}}">
								<param name="buffer_progress" value="false">
								<param name="buffer_canvas" value="false">
								@if($type_neo)
					</applet-dummy>
					@else
					</applet>
					@endif
				</div>
				<p>
					<a href="{{$pchfile}}" target="_blank" rel="nofollow noopener noreferrer">Download</a> - Datasize :
					{{$datasize}} KB
				</p>
				<p>
					<a href="javascript:close()">閉じる</a>
				</p>
			</div>
		</div>
		<!-- (========== 動画表示モード ここまで ==========) -->
		@endif
		@if($continue_mode)
		<!-- (========== CONTINUE MODE(コンティニューモード) start ==========) -->
		<section>

			<script type="text/javascript" src="loadcookie.js?{{$ver}}"></script>
			<div class="thread">
				<figure>
					<img src="{{$picfile}}" width="{{$picw}}" height="{{$pich}}"
						alt="@if($sub){{$sub}} @endif @if($name) by {{$name}} @endif{{$picw}} x {{$pich}}"
						title="@if($sub){{$sub}} @endif @if($name) by {{$name}} @endif{{$picw}} x {{$pich}}">

					<figcaption>{{$picfile_name}}@if($painttime) PaintTime : {{$painttime}}@endif</figcaption>
				</figure>
				<hr class="hr">
				{{-- ダウンロード --}}
				@if($download_app_dat)
				<form action="{{$self}}" method="post">
					<input type="hidden" name="mode" value="download">
					<input type="hidden" name="no" value="{{$no}}">
					<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
					Pass <input class="form" type="password" name="pwd" value="">
					<input class="button" type="submit" value="{{$pch_ext}}ファイルをダウンロード">
				</form>
				<hr class="hr">
				@endif
				<div class="continue_post_form">

					<form action="{{$self}}" method="post">
						<input type="hidden" name="mode" value="contpaint">
						<input type="hidden" name="anime" value="true">
						<input type="hidden" name="picw" value="{{$picw}}">
						<input type="hidden" name="pich" value="{{$pich}}">
						<input type="hidden" name="no" value="{{$no}}">
						<input type="hidden" name="pch" value="{{$pch}}">
						<input type="hidden" name="ext" value="{{$ext}}">
						<select class="form" name="ctype">
							@if($ctype_pch)<option value="pch">動画より続きを描く</option>@endif
							@if($ctype_img)<option value="img">画像より続きを描く</option>@endif
						</select>
						画像は <select class="form" name="type" id="select_post">
							<option value="rep">差し換え</option>
							<option value="new">新規投稿</option>
						</select>
						<span id="span_cont_paint_same_thread">
							<input type="checkbox" name="cont_paint_same_thread" id="cont_paint_same_thread" value="on"
								checked="checked"><label for="cont_paint_same_thread">同じスレッドに投稿する</label>
						</span>
						<br>

						@if($select_app)
						<select name="shi">
							@if($use_neo)<option value="neo">PaintBBS NEO</option>@endif
							@if($use_tegaki)<option value="tegaki">Tegaki</option>@endif
							@if($use_axnos)<option value="axnos">Axnos Paint</option>@endif
							@if($use_shi_painter)<option value="1" class="for_pc">しぃペインター</option>@endif
							@if($use_chickenpaint)<option value="chicken">ChickenPaint</option>@endif
							@if($use_klecks)<option value="klecks">Klecks</option>@endif
						</select>
						@endif
						@if($app_to_use)
						<input type="hidden" name="shi" value="{{$app_to_use}}">
						@endif

						@if($use_select_palettes)
						パレット <select name="selected_palette_no" title="パレット" class="form">{!!$palette_select_tags!!}</select>
						@endif

						<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
						<span id="span_cont_pass">Pass <input class="form" type="password" name="pwd" value=""></span>
						<input class="button" type="submit" value="続きを描く">

					</form>

					<ul>
						@if($newpost_nopassword)
						<li>新規投稿なら削除キーがなくても続きを描く事ができます。</li>
						@else
						<li>続きを描くには描いたときの削除キーが必要です。</li>
						@endif
					</ul>

				</div>
			</div>
			<script>
				document.addEventListener('DOMContentLoaded',l,false);
			</script>
		</section>
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

		{{-- (========== CONTINUE MODE(コンティニューモード) end ==========) --}}
		@endif
	</main>
	<footer>
		{{-- 著作権表示 削除しないでください --}}
		@include('parts.mono_copyright')

	</footer>
	@if(!$chickenpaint)
	<script src="lib/{{$jquery}}"></script>
	<script src="{{$skindir}}js/mono_common.js?{{$ver}}"></script>
	@endif
</body>

</html>