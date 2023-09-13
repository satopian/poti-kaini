{{-- 前、次のナビゲーション --}}
<nav>
	<div class="pagelink">
	<div class="pagelink_prev">@if ($prev)<a href="{{$prev}}">≪前へ</a>@endif
	</div>
	<div class="pagelink_top"><a href="{{$self2}}">掲示板トップ</a></div>
	<div class="pagelink_next">@if ($next)<a href="{{$next}}">次へ≫</a>@endif</div>
	</div>
</nav>
	