	jQuery(function() {
		window.onpageshow = function () {
			$('[type="submit"]').each(function() {
				const $btn = $(this);
				const $form = $btn.closest('form');
				const isTargetBlank = $form.prop('target') === '_blank';
			
				$btn.prop('disabled', false);
				// ボタンが target="_blank" の場合は無効化しない
				if (!isTargetBlank) {
					$btn.on('click', function() {//ボタンをクリックすると
					$btn.prop('disabled', true);//ボタンを無効化して
					$form.trigger('submit');//送信する
					});
				}
			});
		}
		// https://cotodama.co/pagetop/
		var pagetop = $('#page_top');   
		pagetop.hide();
		$(window).on('scroll',function () {
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
			for(const elem of luminousElems)  {
				new Luminous(elem);
			};
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

	//shareするSNSのserver一覧を開く
	var snsWindow = null; // グローバル変数としてウィンドウオブジェクトを保存する

	function open_sns_server_window(event,width=350,height=490) {
		event.preventDefault(); // デフォルトのリンクの挙動を中断

			// 幅と高さが数値であることを確認
			// 幅と高さが正の値であることを確認
		if (isNaN(width) || width <= 0 || isNaN(height) || height <= 0) {
			width=350;//デフォルト値
			height=490;//デフォルト値
	}				
		var url = event.currentTarget.href;
		var windowFeatures = "width="+width+",height="+height; // ウィンドウのサイズを指定
		
		if (snsWindow && !snsWindow.closed) {
			snsWindow.focus(); // 既に開かれているウィンドウがあればフォーカスする
			} else {
			snsWindow = window.open(url, "_blank", windowFeatures); // 新しいウィンドウを開く
			}
	}
	