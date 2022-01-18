{{-- スレッドのループ --}}
{{-- <!--親記事グループ--> --}}
<article>
@if(isset($ress) and !@empty($ress))
	
@foreach ($ress as $res)
{{-- <!--親記事ヘッダ--> --}}
@if ($loop->first)
{{-- 最初のループ --}}
<h2 class="article_title">@if($notres)<a href="{{$self}}?res={{$ress[0]['no']}}">@endif[{{$ress[0]['no']}}] {{$ress[0]['sub']}}@if($notres)</a>@endif</h2>

@else
<hr>
	{{-- <!-- レス記事ヘッダ --> --}}
	<div class="res_article_wrap">
		<div class="res_article_title">[{{$res['no']}}] {{$res['sub']}}</div>
@endif
	{{-- <!-- 記事共通ヘッダ --> --}}
	<div class="article_info">
	<span class="article_info_name"><a href="search.php?page=1&imgsearch=on&query={{$res['encoded_name']}}&radio=2" target="_blank" rel="noopener">{{$res['name']}}</a></span>@if($res['url'])<span class="article_info_desc">[<a href="{{$res['url']}}" target="_blank" rel="nofollow noopener noreferrer">URL</a>]</span> @endif
	@if($res['id'])<span class="article_info_desc">ID:{{$res['id']}}</span>@endif
	<span class="article_info_desc">{{$res['now']}}</span>@if($res['painttime'])<span class="article_info">描画時間:{{$res['painttime']}}</span>@endif
	@if($res['src']) @endif
	@if(['updatemark'])<span class="article_info_desc">{{$res['updatemark']}}</span>@endif
	@if($res['thumb'])<span class="article_info_desc">- サムネイル表示中 -</span>@endif
	<div class="article_img_info">
		@if($res['continue'])<span class="article_info_continue">☆<a href="{{$self}}?mode=continue&no={{$res['continue']}}">続きを描く</a></span>@endif @if($res['spch'])<span class="for_pc">@endif @if($res['pch'])@if($res['continue'])| @endif<span class="article_info_animation">☆<a href="{{$self}}?mode=openpch&pch={{$res['pch']}}" target="_blank">動画</a></span>@endif @if($res['spch'])</span>@endif
	</div>

		
	{{-- <!-- 記事共通ヘッダここまで --> --}}

@if($res['src'])<div class="posted_image" @if($res['w']>=750) style="margin-right:0;float:none;" @endif > @if($res['thumb'])<a href="{{$res['src']}}" target="_blank" rel="noopener">@endif<img src="{{$res['imgsrc']}}" width="{{$res['w']}}" height="{{$res['h']}}" alt="{{$res['sub']}} by {{$res['name']}} ({{$res['size']}} B)" title="{{$res['sub']}} by {{$res['name']}} ({{$res['size']}} B) @if($res['thumb'])サムネイル縮小表示 @endif" loading="lazy">@if($res['thumb'])</a>@endif
</div>
  @endif
  <div class="comment"> {!!$res['com']!!}</div>
{{-- // $res/tab…TAB順用連番
// $res/imgsrc…サムネイルがあるとき、サムネイルURL。サムネイルがないとき、画像URL
// $res/w…画像サイズ(横)
// $res/h…画像サイズ(縦)
// $res/srcname…画像ファイル名
// $res/size…画像ファイルサイズ
// $res/com…本文 --}}
@if ($loop->first)
@if ($res['skipres'])
<hr>
<div class="article_skipres">レス{{$res['skipres']}}件省略中。</div>
@endif
@endif
@if (!$loop->first)
	</div>
	@endif
</div>
	
@endforeach
@endif