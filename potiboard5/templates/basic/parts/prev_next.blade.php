{{-- <!--メイン時ページング表示--> --}}
<div id="paging_wrap">@if($firstpage)<span class="parentheses"><a href="{{$firstpage}}">最初</a> |</span>@endif{!!$paging!!}@if($lastpage)<span class="parentheses"> | <a href="{{$lastpage}}">最後</a></span>@endif</div>
{{-- メインとカタログのページング --}}
<nav>
	<div class="pagelink">
	<div class="pagelink_prev">@if ($prev)<a href="{{$prev}}">≪前へ</a>@endif
	</div>
	<div class="pagelink_top"><a href="{{$self2}}">掲示板トップ</a></div>
	<div class="pagelink_next">@if ($next)<a href="{{$next}}">次へ≫</a>@endif</div>
	</div>
</nav>
	