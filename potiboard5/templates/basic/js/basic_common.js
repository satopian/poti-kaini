	jQuery(function() {
		window.onpageshow = function () {
			var $btn = $('[type="submit"]');
			//disbledを解除
			$btn.prop('disabled', false);
			$btn.on('click', function () { //送信ボタン2度押し対策
				$(this).prop('disabled', true);
				$(this).closest('form').submit();
			});
		}
		// https://cotodama.co/pagetop/
		var pagetop = $('#page_top');   
		pagetop.hide();
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {  //100pxスクロールしたら表示
				pagetop.fadeIn();
			} else {
				pagetop.fadeOut();
			}
		});
		pagetop.on('click', function () {
			$('body,html').animate({
				scrollTop: 0
			}, 500); //0.5秒かけてトップへ移動
			return false;
		});
		// https://www.webdesignleaves.com/pr/plugins/luminous-lightbox.html
		const luminousElems = document.querySelectorAll('.luminous');
		//取得した要素の数が 0 より大きければ
		if( luminousElems.length > 0 ) {
			luminousElems.forEach( (elem) => {
			new Luminous(elem);
			});
		}
		//JavaScriptによるCookie発行
		const paintform = document.getElementById("paint_form");
		if(paintform){
			paintform.onsubmit = function (){
				if(paintform.picw){
					SetCookie("picwc",paintform.picw.value);
				}
				if(paintform.pich){
					SetCookie("pichc",paintform.pich.value);
				}
				if(paintform.shi){
					SetCookie("appletc",paintform.shi.value);
				}
			}
		};
		const commentform = document.getElementById("comment_form");
		if(commentform){
			commentform.onsubmit = function (){
				if(commentform.name){
					SetCookie("namec",commentform.name.value);
				}
				if(commentform.url){
					SetCookie("urlc",commentform.url.value);
				}
				if(commentform.pwd){
					SetCookie("pwdc",commentform.pwd.value);
				}
			}
		};
		function SetCookie(key, val) {
			document.cookie = key + "=" + encodeURIComponent(val) + ";max-age=31536000;";
		}
	});
