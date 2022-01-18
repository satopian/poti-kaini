{{-- メンテナンスフォーム欄 --}}
<form action="{{$self}}" method="post">
	@if($logfilename)<input type="hidden" name="logfilename" value="{{$logfilename}}">@endif
	@if($catalog_pageno)<input type="hidden" name="catalog_pageno" value="{{$catalog_pageno}}">@endif
	@if($mode_catalog)<input type="hidden" name="mode_catalog" value="on">@endif
	@if($resno)<input type="hidden" name="thread_no" value="@if($oya[0][0]['no']){{$oya[0][0]['no']}}@endif">@endif


	<div class="mente_wrap">
	<span class="nk">記事No.<input type="number" min="1" name="del[]" autocomplete="off" class="edit_number"></span>
	<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
	<span class="nk">削除キー<input type="password" name="pwd" value="" autocomplete="current-password" class="edit_password"></span>
	<select name="mode">
	<option value="edit">編集</option>
	@if ($userdel)
	<option value="usrdel">削除</option>
	@endif
	{{-- <!--
	userdel…ユーザー削除権限(0は削除不可)
	--> --}}
	</select>
	<span class="nk"><label class="checkbox"><input type="checkbox" name="onlyimgdel" value="on">画像だけ消す</label></span>
	<input type="submit" value="OK">
	</div>
	</form>
	