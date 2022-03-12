<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en">
	<title>{{$title}}</title>
	<subtitle></subtitle>
	<link href="{{$rooturl}}"/>
	<updated>{{$updated}}</updated>
	<author>
	  <name></name>
	</author>
	<generator uri="{{$rooturl}}rss.php" version="{{$ver}}">POTI-board</generator>
	<id>PaintBBS:{{$rooturl}}</id>
	@if(isset($ress) and !@empty($ress))
	@foreach ($ress as $i=>$res)
	<entry>
		<title>[{{$res['no']}}]{!!$res['sub']!!} by {!!$res['name']!!}</title>
			<link href="{{$rooturl}}{{$self}}?res={{$res['no']}}"/>
			<id>paintbbs:{{$self}}?res={{$res['no']}}</id>
			<published>{{$res['updated']}}</published>
			<updated>{{$res['updated']}}</updated>
					<summary type="html">
						{{$res['imgsrc']}}
						{!!$res['descriptioncom']!!}
					</summary>
		  <content type="html">
			{{$res['imgsrc']}}
			{!!$res['com']!!}
	</content>        
		  <category term="PaintBBS" label="PaintBBS" />
		  <link rel="enclosure" href="{{$res['enclosure']}}" type="{{$res['imgtype']}}" length="{{$res['size']}}" />
		  <author>
			  <name></name>
		  </author>
	  </entry>
	  @endforeach
	  @endif
	</feed>
  