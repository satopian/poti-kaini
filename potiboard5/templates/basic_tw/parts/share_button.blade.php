{{-- シェアボタン --}}
<span class="share_button">
	<a target="_blank" href="https://twitter.com/intent/tweet?text=%5B{{$ress[0]['encoded_no']}}%5D%20{{$ress[0]['share_sub']}}%20by%20{{$ress[0]['share_name']}}%20-%20{{$encoded_title}}&url={{$encoded_rooturl}}{{$encoded_self}}?res={{$ress[0]['encoded_no']}}"><span class="icon-twitter"></span>tweet</a>
	<a target="_blank" class="fb btn" href="http://www.facebook.com/share.php?u={{$encoded_rooturl}}{{$encoded_self}}?res={{$ress[0]['encoded_no']}}"><span class="icon-facebook2"></span>share</a>
</span>
