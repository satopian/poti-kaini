{{-- ペイントボタン --}}
<form action="{{$self}}" method="post" enctype="multipart/form-data" id="paint_form">
	<p>
		@if($admin)
		<input type="hidden" name="admin" value="{{$admin}}">
		<input name="pch_upload" type="file" accept="image/*,.pch,.spch,.chi,.psd" class="pchup_button">
		<br>
		@endif
		幅 : <input name="picw" type="number" title="幅" class="form" value="{{$pdefw}}" min="{{$pminw}}" max="{{$pmaxw}}">
		高さ : <input name="pich" type="number" title="高さ" class="form" value="{{$pdefh}}" min="{{$pminh}}" max="{{$pmaxh}}">
	@if($select_app)
		ツール :
	<select name="shi" id="select_app">
		@if ($use_neo)<option value="neo">PaintBBS NEO</option>@endif
		@if ($use_tegaki)<option value="tegaki">Tegaki</option>@endif
		@if ($use_axnos)<option value="axnos">Axnos Paint</option>@endif
		@if($use_shi_painter)<option value="1" class="for_pc">しぃペインター</option>@endif
		@if($use_chickenpaint)<option value="chicken">ChickenPaint</option>@endif
		@if ($use_klecks)<option value="klecks">Klecks</option>@endif
	</select>
	@endif 
	{{-- <!-- 選択メニューを出さない時に起動するアプリ --> --}}
	@if($app_to_use)
	<input type="hidden" name="shi" value="{{$app_to_use}}">
	@endif

	
		@if($use_select_palettes)
		パレット：<select name="selected_palette_no" title="パレット" class="form">{!!$palette_select_tags!!}</select>
		@endif
		@if($resno)
		<input type="hidden" name="resto" value="{{$resno}}">
		@endif
		<input type="hidden" name="mode" value="paint">
		<input class="button" type="submit" value="お絵かき">
		@if($anime)<label id="save_playback"><input type="checkbox" value="true" name="anime" title="動画記録" @if($animechk){{$animechk}}@endif>動画記録</label>@endif
	</p>
</form>
