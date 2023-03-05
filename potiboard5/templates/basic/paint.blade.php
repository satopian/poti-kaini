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
@if($pinchin)
<meta name="viewport" content="width=device-width,initial-scale=1.0">
@else
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
@endif
@endif
@if($pch_mode)<meta name="viewport" content="width=device-width,initial-scale=1.0">@endif
@if($continue_mode)<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">@endif
<link rel="stylesheet" type="text/css" href="{{$skindir}}basic.css?{{$verlot}}">
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
	body{overscroll-behavior-x: none !important; }
	div#chickenpaint-parent , div.appstage {
		letter-spacing: initial;
		word-break:initial;
		overflow-wrap: initial;
	}
</style>
@endif
@if($chickenpaint)
<style>
	li{margin:0 0 0 1em;}
	:not(input),div#chickenpaint-parent :not(input){
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
</style>
<script>
	function fixchicken() {
		document.addEventListener('dblclick', function(e){ e.preventDefault()}, { passive: false });
		const chicken=document.querySelector('#chickenpaint-parent');
		chicken.addEventListener('contextmenu', function (e){
			e.preventDefault();
			e.stopPropagation();
		}, { passive: false });
	}
	window.addEventListener('DOMContentLoaded',fixchicken,false);
</script>
 
<script src="chickenpaint/js/chickenpaint.min.js?{{$parameter_day}}"></script>

<link rel="stylesheet" type="text/css" href="chickenpaint/css/chickenpaint.css?{{$parameter_day}}">

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
<link rel="stylesheet" href="neo.css?{{$parameter_day}}" type="text/css">
<script src="neo.js?{{$parameter_day}}" charset="UTF-8"></script>
<script>
	// https://qiita.com/tsmd/items/cfb5dcbec8433b87dc36
	function isPinchZooming () {//ピンチズームを検知
		if ('visualViewport' in window) {
			return window.visualViewport.scale > 1
		} else {
			return document.documentElement.clientWidth > window.innerWidth
		}
	}

	function neo_disable_touch_move (e) {//NEOの網目でスワイプしない
		let screenwidth = Number(screen.width);
		let appw = Number({{$w}});
		if((screenwidth-appw)>100){
			if (typeof e.cancelable !== 'boolean' || e.cancelable) {
			e.preventDefault();
			e.stopPropagation();
			}
		}
	}

	function neo_add_disable_touch_move() {
		document.getElementById('NEO').addEventListener('touchmove', neo_disable_touch_move ,{ passive: false });
	}
	document.addEventListener('touchmove', function(e) {
		neo_add_disable_touch_move();
		if(isPinchZooming ()){//ピンチズーム使用時はNEOの網目でスワイプする
			document.getElementById('NEO').removeEventListener('touchmove', neo_disable_touch_move ,{ passive: false });
		}
	});
	window.addEventListener('DOMContentLoaded',neo_add_disable_touch_move,false);
</script>
@endif
@if($pch_mode and $type_neo) 
<link rel="stylesheet" href="neo.css?{{$parameter_day}}" type="text/css">
<script src="neo.js?{{$parameter_day}}" charset="UTF-8"></script>
@endif
	@if(($paint_mode and !$useneo) or ($pch_mode and !$type_neo))
	<!-- Javaが使えるかどうか判定 -->
	<script>
			function cheerpJLoad() {
			var jEnabled = navigator.javaEnabled();
			if(!jEnabled){
				var sN = document.createElement("script");
				sN.src = "{{$cheerpj_url}}";
				sN.integrity="{{$cheerpj_hash}}";
				sN.crossOrigin="anonymous";
				var s0 = document.getElementsByTagName("script")[0];
				s0.parentNode.insertBefore(sN, s0);
				sN.addEventListener("load", function(){ cheerpjInit(); }, false);
				}
			}
			window.addEventListener("load", function() { cheerpJLoad(); }, false);
	</script>
	@endif
@endif
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
<header>
@if($paint_mode) 
@if(!$chickenpaint)
<h1 style= "min-width:calc({{$w}}px + 176px)" id="bbs_title">お絵かきモード - <span class="title_name_wrap">{{$title}}</span></h1>
@endif

@else
<h1 id="bbs_title">@if($continue_mode) 続きを描く@endif @if($pch_mode) 動画表示モード@endif - <span class="title_name_wrap">{{$title}}</span></h1>@endif
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
	saveUrl: "save.php?usercode={!!$usercode!!}",
	postUrl: "?mode={!!$mode!!}&stime={{$stime}}",
	exitUrl: "?mode={!!$mode!!}&stime={{$stime}}",

        allowDownload: true,
        resourcesRoot: "chickenpaint/",
        disableBootstrapAPI: true,
		fullScreenMode: "force"
	});
})
</script>


@else

<nav>
<div style= "min-width:calc({{$w}}px + 176px)" id="self2"> [<a href="{{$self2}}">{{$title}}</a>] 
@if($useneo) 
<span class="nts_radiowrap">ツールを
	<input type="radio" name="1" id="1" onclick="Neo.setToolSide(true)" class="nts_radio"><label class="ntslabel" for="1">左へ</label>
	<input type="radio" name="1" id="2" onclick="Neo.setToolSide(false)" checked="checked" class="nts_radio"><label class="ntslabel" for="2">右へ</label>
</span>
	@endif
</div>
</nav>
</header>
<!--動的パレットスクリプト ここから-->
<script>
var DynamicColor = 1;	// パレットリストに色表示
var Palettes = new Array();
<!--パレット配列作成-->
@if($palettes) 
{!!$palettes!!}
@endif
function setPalette(){d=document;d.paintbbs.setColors(Palettes[d.Palette.select.selectedIndex]);d.grad.view.checked&&GetPalette()}function PaletteSave(){Palettes[0]=String(document.paintbbs.getColors())}var cutomP=0;
function PaletteNew(){d=document;p=String(d.paintbbs.getColors());s=d.Palette.select;Palettes[s.length]=p;cutomP++;str=prompt("パレット名","パレット "+cutomP);null==str||""==str?cutomP--:(s.options[s.length]=new Option(str),30>s.length&&(s.size=s.length),PaletteListSetColor())}function PaletteRenew(){d=document;Palettes[d.Palette.select.selectedIndex]=String(d.paintbbs.getColors());PaletteListSetColor()}
function PaletteDel(){p=Palettes.length;s=document.Palette.select;i=s.selectedIndex;if(-1!=i&&(flag=confirm("「"+s.options[i].text + "」を削除してよろしいですか？"))){for(s.options[i]=null;p>i;)Palettes[i]=Palettes[i+1],i++;30>s.length&&(s.size=s.length)}}
function P_Effect(a){a=parseInt(a);x=1;255==a&&(x=-1);d=document.paintbbs;p=String(d.getColors()).split("\n");l=p.length;var f="";for(n=0;l>n;n++)R=a+parseInt("0x"+p[n].substr(1,2))*x,G=a+parseInt("0x"+p[n].substr(3,2))*x,B=a+parseInt("0x"+p[n].substr(5,2))*x,255<R?R=255:0>R&&(R=0),255<G?G=255:0>G&&(G=0),255<B?B=255:0>B&&(B=0),f+="#"+Hex(R)+Hex(G)+Hex(B)+"\n";d.setColors(f);PaletteListSetColor()}
function PaletteMatrixGet(){d=document.Palette;p=Palettes.length;s=d.select;m=d.m_m.selectedIndex;t=d.setr;switch(m){default:t.value="";for(c=n=0;p>n;)null!=s.options[n]&&(t.value=t.value+"\n!"+s.options[n].text+"\n"+Palettes[n],c++),n++;alert("パレット数："+c+"\nパレットマトリクスを取得しました");break;case 1:t.value="!Palette\n"+String(document.paintbbs.getColors())
		alert("現在使用されているパレット情報を取得しました")}t.value=
t.value.trim()+"\n!Matrix"}
function PalleteMatrixSet(){m=document.Palette.m_m.selectedIndex;str="パレットマトリクスをセットします。";switch(m){default:flag=confirm(str+"\n現在の全パレット情報は失われますがよろしいですか？");break;case 1:flag=confirm(str+"\n現在使用しているパレットと置き換えますがよろしいですか？");break;
case 2:flag=confirm(str+"\n現在のパレット情報に追加しますがよろしいですか？")}flag&&(PaletteSet(),s.size=30>s.length?s.length:30,DynamicColor&&PaletteListSetColor())}
function PalleteMatrixHelp(){alert("★PALETTE MATRIX\nパレットマトリクスとはパレット情報を列挙したテキストを用いる事により\n自由なパレット設定を使用する事が出来ます。\n\n□マトリクスの取得\n1)「取得」ボタンよりパレットマトリクスを取得します。\n2)取得された情報が下のテキストエリアに出ます、これを全てコピーします。\n3)このマトリクス情報をテキストとしてファイルに保存しておくなりしましょう。\n\n□マトリクスのセット\n1）コピーしたマトリクスを下のテキストエリアに貼り付け(ペースト)します。\n2)ファイルに保存してある場合は、それをコピーし貼り付けます。\n3)「セット」ボタンを押せば保存されたパレットが使用できます。\n\n余分な情報があるとパレットが正しくセットされませんのでご注意下さい。")}
function PaletteSet(){d=document.Palette;se=d.setr.value;s=d.select;m=d.m_m.selectedIndex;l=se.length;if(1>l)alert("マトリクス情報がありません。");else{e=o=n=0;switch(m){default:for(n=s.length;0<n;)n--,s.options[n]=null;case 2:i=s.options.length;n=se.indexOf("!",0)+1;if(0==n)return;Matrix1=1;for(Matrix2=-1;n<l;){e=se.indexOf("\n#",n);if(-1==e)return;pn=se.substring(n,e+Matrix1);o=se.indexOf("!",e);if(-1==o)return;pa=se.substring(e+1,o+Matrix2);
"Palette"!=pn?(0<=i&&(s.options[i]=new Option(pn)),Palettes[i]=pa,i++):document.paintbbs.setColors(pa);n=o+1}break;case 1:n=se.indexOf("!",0)+1;if(0==n)return;e=se.indexOf("\n#",n);o=se.indexOf("!",e);0<=e&&(pa=se.substring(e+1,o-1));document.paintbbs.setColors(pa)}PaletteListSetColor()}}function PaletteListSetColor(){var a=document.Palette.select;for(i=1;a.options.length>i;i++){var f=Palettes[i].split("\n");a.options[i].style.background=f[4];a.options[i].style.color=GetBright(f[4])}}
function GetBright(a){r=parseInt("0x"+a.substr(1,2));g=parseInt("0x"+a.substr(3,2));b=parseInt("0x"+a.substr(5,2));a=r>=g?r>=b?r:b:g>=b?g:b;return 128>a?"#FFFFFF":"#000000"}function Chenge_(){var a=document.grad.pst.value,f=document.grad.ped.value;isNaN(parseInt("0x"+a))||isNaN(parseInt("0x"+f))||GradView("#"+a,"#"+f)}
function ChengeGrad(){var a=document,f=a.grad.pst.value,h=a.grad.ped.value;Chenge_();var u=parseInt("0x"+f.substr(0,2)),v=parseInt("0x"+f.substr(2,2));f=parseInt("0x"+f.substr(4,2));var k=parseInt((u-parseInt("0x"+h.substr(0,2)))/15),q=parseInt((v-parseInt("0x"+h.substr(2,2)))/15);h=parseInt((f-parseInt("0x"+h.substr(4,2)))/15);isNaN(k)&&(k=1);isNaN(q)&&(q=1);isNaN(h)&&(h=1);var w=new String;cnt=0;m1=u;m2=v;for(m3=f;14>cnt;cnt++,m1-=k,m2-=q,m3-=h){if(255<m1||0>m1)k*=-1,m1-=k;if(255<m2||0>m2)q*=-1,
m2-=q;if(255<m3||0>m3)h*=-1,m2-=h;w+="#"+Hex(m1)+Hex(m2)+Hex(m3)+"\n"}a.paintbbs.setColors(w)}function Hex(a){a=parseInt(a);0>a&&(a*=-1);for(var f=new String,h;16<a;)h=a,16<a&&(a=parseInt(a/16),h-=16*a),h=Hex_(h),f=h+f;h=Hex_(a);for(f=h+f;2>f.length;)f="0"+f;return f}function Hex_(a){isNaN(a)?a="":10==a?a="A":11==a?a="B":12==a?a="C":13==a?a="D":14==a?a="E":15==a&&(a="F");return a}
function GetPalette(){d=document;p=String(d.paintbbs.getColors());"null"!=p&&""!=p&&(ps=p.split("\n"),st=d.grad.p_st.selectedIndex,ed=d.grad.p_ed.selectedIndex,d.grad.pst.value=ps[st].substr(1.6),d.grad.ped.value=ps[ed].substr(1.6),GradSelC(),GradView(ps[st],ps[ed]),PaletteListSetColor())}
function GradSelC(){if(d.grad.view.checked){d=document.grad;l=ps.length;pe="";for(n=0;l>n;n++)R=255+-1*parseInt("0x"+ps[n].substr(1,2)),G=255+-1*parseInt("0x"+ps[n].substr(3,2)),B=255+-1*parseInt("0x"+ps[n].substr(5,2)),255<R?R=255:0>R&&(R=0),255<G?G=255:0>G&&(G=0),255<B?B=255:0>B&&(B=0),pe+="#"+Hex(R)+Hex(G)+Hex(B)+"\n";pe=pe.split("\n");for(n=0;l>n;n++)d.p_st.options[n].style.background=ps[n],d.p_st.options[n].style.color=pe[n],d.p_ed.options[n].style.background=ps[n],d.p_ed.options[n].style.color=
pe[n]}}function GradView(a,f){d=document}function showHideLayer(){d=document;var a=d.layers?d.layers.psft:d.all("psft").style;d.grad.view.checked||(a.visibility="hidden");d.grad.view.checked&&(a.visibility="visible",GetPalette())};
</script>
<!--動的パレットスクリプト ここまで-->
<noscript><h3>JavaScriptが有効でないため正常に動作致しません。</h3></NOSCRIPT>
<div class="appstage"><div class="app">
<!--applet～の～部分の詳しい事は、PaintBBS及びしぃペインターのReadmeを参照-->
<!--PaintBBS個別設定-->
@if($paintbbs) 
<!-- NEOを使う時はアプレットを読み込まないように -->
@if($useneo) <applet-dummy @else<applet @endif

 CODE="pbbs.PaintBBS.class" ARCHIVE="./PaintBBS.jar" NAME="paintbbs" WIDTH="{{$w}}" HEIGHT="{{$h}}" MAYSCRIPT>
<param name="neo_send_with_formdata" value="true">
<param name="neo_confirm_unload" value="true">
<param name="neo_show_right_button" value="true">
@endif
<!--しぃペインター個別設定-->
@if($normal) 
<applet code="c.ShiPainter.class" archive="spainter_all.jar" name="paintbbs" WIDTH="{{$w}}" HEIGHT="{{$h}}" MAYSCRIPT>
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
<applet code="c.ShiPainter.class" archive="spainter_all.jar" name="paintbbs" WIDTH="{{$w}}" HEIGHT="{{$h}}" MAYSCRIPT>
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
<param name="url_save" value="saveneo.php">
@else
<param name="url_save" value="picpost.php">
@endif
<param name="url_exit" value="{{$self}}?mode={{$mode}}&amp;stime={{$stime}}">
@if($anime) 
<param name="thumbnail_type" value="animation">
@endif
@if($pchfile) 
<param name="pch_file" value="{{$pchfile}}">
@endif
@if($imgfile) 
<param name="image_canvas" value="{{$imgfile}}">
@endif
<param name="send_header" value="usercode={{$usercode}}">
@if($security) 
@if($security_click) 
<param name="security_click" value="{{$security_click}}">
@endif
@if($security_timer) 
<param name="security_timer" value="{{$security_timer}}">
@endif
<param name="security_url" value="{{$security_url}}">
<param name="security_post" value="false">
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
<div class="palette"><FORM name="Palette">
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
</FORM></div>
<div class="palette_gradation"><FORM name="grad">
	<label class="palette_desc checkbox" ><INPUT type="checkbox" name="view" OnClick="showHideLayer()" id="grdchk">GRADATION&nbsp;</label><INPUT type="button" VALUE=" OK " OnClick="ChengeGrad()"><br>
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
</FORM></div>
<Script>
if(DynamicColor) PaletteListSetColor();
</Script>
</div>
</div>
<!--動的パレット制御関連 ここまで-->


<div class="centering">
<!--描画時間動的表示-->
<div class="applet_painttime">
<FORM NAME="watch">描画時間
<INPUT SIZE="20" NAME="count">
</FORM>
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
<div class="paintbbs_memo"><div>基本の動作(恐らくこれだけは覚えておいた方が良い機能)</div><div> &lt;基本&gt;<br>PaintBBSでは右クリック,ctrl+クリック,alt+クリックは同じ動作をします。<br>基本的に操作は一回のクリックか右クリックで動作が完了します。(ベジエやコピー使用時を除く)<br><br>&lt;ツールバー&gt;<br>ツールバーの殆どのボタンは複数回クリックして機能を切り替える事が出来ます。<br>右クリックで逆周り。パレットの色,マスクの色,一時保存ツールに現在の状態を登録、レイヤー表示非表示切り替え等全て右クリックです。<br>逆にクリックでパレットの色と一時保存ツールに保存しておいた状態を取り出せます。<br><br>&lt;キャンバス部分&gt;<br>右クリックで色をスポイトします<br>ベジエやコピー等の処理の途中で右クリックを押すとリセットします。 </div><br><div>特殊動作(使う必要は無いが慣れれば便利な機能)</div><div> &lt;ツールバー&gt;<br>値を変更するバーはドラッグ時バーの外に出した場合変化が緩やかになりますのでそれを利用して細かく変更する事が出来ます。<br>パレットはShift+クリックで色をデフォルトの状態に戻します。<br><br>&lt;キーボードのショートカット&gt;<br>+で拡大-で縮小。 <br>Ctrl+ZかCtrl+Uで元に戻す、Ctrl+Alt+ZかCtrl+Yでやり直し。<br>Escでコピーやベジエのリセット。（右クリックでも同じ） <br>スペースキーを押しながらキャンバスをドラッグするとスクロールの自由移動。<br>Ctrl+Alt+ドラッグで線の幅を変更。<br><br>&lt;コピーツールの特殊な利用方法&gt;<br>レイヤー間の移動は現時点ではコピーとレイヤー結合のみです。コピーでの移動方法は、<br>まず移動したいレイヤー上の長方形を選択後、移動させたいレイヤーを選択後に通常のコピーの作業を<br>続けます。そうする事によりレイヤー間の移動が可能になります。<br></div><br><div>ツールバーのボタンと特殊な機能の簡単な説明</div><div> <ul> <li>ペン先(通常ペン,水彩ペン,テキスト)<br>メインのフリーライン系のペンとテキスト<br><br></li><li>ペン先2(トーン,ぼかし,他)<br>特殊な効果を出すフリーライン系のペン<br><br></li><li>図形(円や長方形)<br>長方形や円等の図形<br><br></li><li>特殊(コピーやレイヤー結合,反転等)<br>コピーは一度選択後、ドラッグして移動、コピーさせるツールです。<br><br></li><li>マスクモード指定(通常,マスク,逆マスク）<br>マスクで登録されている色を描写不可にします。逆マスクはその逆。<br>通常でマスク無し。また右クリックでマスクカラーの変更が可能。<br><br></li><li>消しゴム(消しペン,消し四角,全消し)<br>透過レイヤー上を白で塗り潰した場合、下のレイヤーが見えなくなりますので上位レイヤーの線を消す時にはこのツールで消す様にして下さい。全消しはすべてを透過ピクセル化させるツールです。<br>全消しを利用する場合はこのツールを選択後キャンバスをクリックでOK。<br>消しゴムは独立した線の幅を持っています。<br><br></li><li>描写方法の指定。(手書き,直線,ベジエ曲線)<br>ペン先,描写機能指定ではありません。<br>また適用されるのはフリーライン系のツールのみです。<br><br></li><li>カラーパレット郡<br>クリックで色取得。右クリックで色の登録。Shift+クリックでデフォルト値。<br><br></li><li>RGBバーとalphaバー<br>細かい色の変更と透過度の変更。Rは赤,Gは緑,Bは青,Aは透過度を指します。<br>トーンはAlphaバーで値を変更する事で密度の変更が可能です。<br><br></li><li>線幅変更ツール<br>水彩ペンを選択時に線幅を変更した時、デフォルトの値がalpha値に代入されます。<br><br></li><li>線一時保存ツール<br>クリックでデータ取得。右クリックでデータの登録。(マスク値は登録しません)<br><br></li><li>レイヤーツール<br>PaintBBSは透明なキャンバスを二枚重ねたような構造になっています。<br>つまり主線を上に書き、色を下に描くと言う事も可能になるツールです。<br>通常レイヤーと言う種類の物ですので鉛筆で描いたような線もキッチリ透過します。<br>クリックでレイヤー入れ替え。右クリックで選択されているレイヤーの表示、非表示切り替え。<br><br></li></ul> </div>投稿に関して： <div> 絵が完成したら投稿ボタンで投稿します。<br>絵の投稿が成功した場合は指定されたURLへジャンプします。<br>失敗した場合は失敗したと報告するのみでどこにも飛びません。<br>単に重かっただけである場合、少し間を置いた後、再度投稿を試みて下さい。<br>この際二重で投稿される場合があるかもしれませんが<br>それはWebサーバーかCGI側の処理ですのであしからず。 </div></div>
<!--PaintBBS HELP END-->
@endif
@endif
{{-- <!--お絵かきモード ここまで--> --}}
{{-- <!--動画表示モード--> --}}
{{-- <!--
//
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
--> --}}
@if($pch_mode) 
	</header>
<div class="appstage" style="width:{{$w}}px; height:{{$h}}px">
@if($paintbbs) 
@if($type_neo) <applet-dummy @else
<applet @endif
name="pch" code="pch.PCHViewer.class" archive="PCHViewer.jar,PaintBBS.jar" width="{{$w}}" height="{{$h}}" MAYSCRIPT>
@endif
@if($normal) 
<applet name="pch" code="pch2.PCHViewer.class" archive="PCHViewer.jar,spainter_all.jar" codebase="./" width="{{$w}}" height="{{$h}}">
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
@if($type_neo) 
</applet-dummy>
@else
</applet>
@endif
	</div>
<div class="pch_download">
<A href="{{$pchfile}}" target="_blank" rel="noopener noreferrer">Download</A><br>
<small>Datasize : {{$datasize}} KB</small><br>
	<a href="{{$self2}}">{{$title}}</a> / <a href="javascript:close()">閉じる</a>
</div>
@endif
<!--動画表示モード ここまで-->
{{-- <!--コンティニューモード --> --}}
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
	 
[<a href="{{$self2}}">{{$title}}</a>]
</div>
</nav>
</header>
 	<div class="centering">
    <!--クッキー読込み用JavaScript(必須)-->
    <Script src="loadcookie.js"></script>
    <!--画像と描画時間-->
 	<div class="continue_img">
<img src="{{$picfile}}" width="{{$picw}}" height="{{$pich}}" alt="@if($sub){{$sub}} @endif @if($name) by {{$name}} @endif{{$picw}} x {{$pich}}" title="@if($sub){{$sub}} @endif @if($name) by {{$name}} @endif{{$picw}} x {{$pich}}">
   </div>
    <div class="continue_painttime">@if($painttime) 描画時間：{{$painttime}}@endif</div>
    <!--コンティニューフォーム欄-->
	<div class="continue_post_form">	
		@if($download_app_dat)
		<form action="{{$self}}" method="post">
				<input type="hidden" name="mode" value="download">
				<input type="hidden" name="no" value="{{$no}}">
				<input type="hidden" name="pch_ext" value="{{$pch_ext}}">
				<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
				<span class="nk">削除キー<input type="password" name="pwd" value="" class="paint_password" autocomplete="current-password"></span>
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
		<input type="checkbox" name="cont_paint_same_thread" id="cont_paint_same_thread" value="on" checked="checked"><label for="cont_paint_same_thread">同じスレッドに投稿する</label>
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
	@if ($use_neo)<option value="neo">PaintBBS NEO</option>@endif
	@if($use_shi_painter) <option value="1" class="for_pc">しぃペインター</option>@endif
	@if($use_chickenpaint) <option value="chicken">ChickenPaint</option>@endif
	@if ($use_klecks)<option value="klecks">Klecks</option>@endif
</select>
@endif
@if($app_to_use) 
<input type="hidden" name="shi" value="{{$app_to_use}}">
@endif

@if($use_select_palettes) 
<span class="palette_type">PALETTE</span> <select name="selected_palette_no" title="パレット" class="paint_select palette_type">{!!$palette_select_tags!!}</select>
@endif
<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
<span class="nk" id="span_cont_pass">削除キー<input type="password" name="pwd" value="" class="paint_password" autocomplete="current-password"></span>
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
		var idx=document.getElementById('select_post').selectedIndex;
		console.log(idx);
		var obj2style_1=document.getElementById('span_cont_paint_same_thread');
		var obj2style_2=document.getElementById('span_cont_pass');
		if(idx === 1){
			if(obj2style_1){
				obj2style_1.style.display = "inline-block";
			}
			@if($newpost_nopassword) 
			if(obj2style_2){
			obj2style_2.style.display = "none";
			}
			@endif
		}else{
			if(obj2style_1){
				obj2style_1.style.display = "none";
			}
			@if($newpost_nopassword) 
			if(obj2style_2){
				obj2style_2.style.display = "inline-block";
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
@endif
<!--コンティニューモード ここまで--><!--著作権表示 削除しないでください-->
<footer>
	{{-- <!--著作権表示 削除しないでください--> --}}
	@include('parts.copyright')
</footer>
</body>
</html>
