@if(isset($ress) and !@empty($ress))
@foreach ($ress as $res)
	{{-- <!--記事表示--> --}}
	@if ($loop->first)
	{{-- 最初のループ --}}
	{{-- レスモードの時 --}}
	@if($resno)
	<h2><span class="oyano">[{{$res['no']}}]</span> {{$res['sub']}}</h2>
	@else 
	<h2><a href="{{$self}}?res={{$res['no']}}"><span class="oyano">[{{$res['no']}}]</span> {{$res['sub']}}</a></h2>
	@endif
	{{-- 親記事のヘッダ --}}
	<h3>
		<span class="name"><a href="search_en.php?page=1&amp;imgsearch=on&amp;query={{$res['encoded_name']}}&amp;radio=2" target="_blank" rel="noopener">{{$res['name']}}</a></span><span class="trip">{{$res['trip']}}</span> :
		{{$res['now']}}@if($res['id']) ID : {{$res['id']}}@endif @if($res['url']) <span class="url">[<a href="{{$res['url']}}" target="_blank" rel="nofollow noopener noreferrer">URL</a>]</span> @endif @if($res['updatemark']){{$res['updatemark']}}@endif
	</h3>
	<hr>
	@else
	<hr>
	{{-- 子レス --}}
	<div class="res">
		<div class="res_wrap">
	{{-- 子レスヘッダ --}}
		<h4>
			<span class="oyaresno">[{{$res['no']}}]</span>
			<span class="rsub">{{$res['sub']}}</span> :
			<span class="name"><a href="search_en.php?page=1&amp;imgsearch=on&amp;query={{$res['encoded_name']}}&amp;radio=2" target="_blank" rel="noopener">{{$res['name']}}</a></span><span class="trip">{{$res['trip']}}</span> : {{$res['now']}}@if($res['id']) ID : {{$res['id']}}@endif @if($res['url']) <span class="url">[<a href="{{$res['url']}}" target="_blank" rel="nofollow noopener noreferrer">URL</a>]</span>@endif 
			@if($res['updatemark']) {{$res['updatemark']}}@endif
		</h4>
		{{-- 子レスヘッダここまで --}}
	@endif	
	{{-- 親子共通 --}}
		@if($res['src'])
		<div class="img_info_wrap">
			<a href="{{$res['src']}}" title="{{$res['sub']}}" target="_blank">{{$res['srcname']}}</a> ({{$res['size']}} B)
			@if($res['thumb']) - Showing thumbnail - @endif @if($res['painttime']) PaintTime : {{$res['painttime']}}@endif
			<br>
			@if($res['continue']) <a href="{{$self}}?mode=continue&amp;no={{$res['continue']}}">*Continue</a>@endif @if($res['spch'])<span class="for_pc">@endif @if($res['pch']) <a href="{{$self}}?mode=openpch&amp;pch={{$res['pch']}}" target="_blank">*Replay</a>@endif
				 @if($res['spch'])</span>@endif
		</div>
		<figure @if($res['w']>=750) style="float:none;margin-right:0"@endif>
			@if($res['thumb'])
			<a href="{{$res['src']}}" target="_blank" rel="noopener">
			@endif	
				<img src="{{$res['imgsrc']}}" alt="{{$res['sub']}} by {{$res['name']}}" title="{{$res['sub']}} by {{$res['name']}}" width="{{$res['w']}}" height="{{$res['h']}}" loading="lazy">
				@if($res['thumb'])
				</a>
				@endif
		</figure>
		@endif
			<div class="comment_wrap">
				<p>{!!$res['com']!!}</p>
	{{-- 親のコメント部分 --}}
	@if ($loop->first)
	@if ($res['skipres'])
	<hr>
	<div class="article_skipres">レス{{$res['skipres']}}件省略中。</div>
	@endif
		</div>
	@endif
	{{-- 子レスなら --}}
	@if (!$loop->first)
		</div>
		</div>
		</div>
	@endif
@endforeach
@endif