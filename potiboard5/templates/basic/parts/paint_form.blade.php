{{-- ペイントボタン --}}

<form action="{{$self}}" method="post" enctype="multipart/form-data" class="paint_form" id="paint_form">
	@if($admin)
	<input type="hidden" name="admin" value="{{$admin}}">
	<input name="pch_upload" type="file" accept="image/*,.pch,.spch,.chi,.psd" class="pchup_button">
	<br>
	@endif
	<input type="submit" value="PAINT" class="paint_button">
@if ($select_app)
	<span class="bold_gray">Tool</span>
	<select name="shi" class="select_applet">
	@if ($use_neo)<option value="neo">PaintBBS NEO</option>@endif
	@if ($use_shi_painter)<option value="1" class="for_pc">しぃペインター</option>@endif
	@if ($use_chickenpaint)<option value="chicken">ChickenPaint</option>@endif
	@if ($use_klecks)<option value="klecks">Klecks</option>@endif
</select>
@endif
{{-- <!-- 選択メニューを出さない時に起動するアプリ --> --}}
@if($app_to_use)
<input type="hidden" name="shi" value="{{$app_to_use}}">
@endif



{{--  キャンバスサイズ 設定はconfig.phpで --}}
<span class="canvas_size_wrap">
<span class="bold_gray">Size</span>
	<select name="picw" title="幅" class="canvas_select">
	{{-- 幅 300から、PMAX_W で設定した最大値まで。 --}}
		@for($i = 300; $i <=$pmaxw ; $i+=50){{-- 50ずつ増える --}}
		@if($pdefw==$i){{-- デフォルトサイズ --}}
		<option value="{{$i}}" selected>{{$i}}</option>
		@else
		<option value="{{$i}}">{{$i}}</option>
		@endif
		@endfor
	</select>
	x
	<select name="pich" title="高さ" class="canvas_select">
		@for($i = 300; $i <=$pmaxh ; $i+=50){{-- 50ずつ増える --}}
		@if($pdefh==$i){{-- デフォルトサイズ --}}
		<option value="{{$i}}" selected>{{$i}}</option>
		@else
		<option value="{{$i}}">{{$i}}</option>
		@endif
		@endfor
	</select> 
</span>
{{--  キャンバスサイズ ここまで --}}

@if ($use_select_palettes)
	<span class="palette_type bold_gray">PALETTE</span> <select name="selected_palette_no" title="パレット" class="canvas_select palette_type">{!!$palette_select_tags!!}</select>
	@endif
@if ($anime)<label class="checkbox use_animation"><input type="checkbox" value="true" name="anime" {{$animechk}}>動画記録</label>
	@endif
	{{-- 
	// // anime…動画記録機能を使用するとき true が入る
	// // animechk…動画記録をデフォルトでチェックするとき ' checked' が入る
	//  --}}
@if($resno)<input type="hidden" name="resto" value="{{$resno}}">@endif
<input type="hidden" name="mode" value="paint">
</form>

 {{-- 
// config.phpで設定した
// //お絵描きデフォルトサイズ(最初に選択される数値)
// PDEF_W //幅
// PDEF_H// 高さ
// //お絵描き最大サイズ
// PMAX_W //幅
// PMAX_H //高さ
// が入ります。
//  --}}
