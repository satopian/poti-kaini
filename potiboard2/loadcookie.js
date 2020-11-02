function l(e){
	var P=loadCookie("pwdc"),N=loadCookie("namec"),E=loadCookie("emailc"),U=loadCookie("urlc"),FC=loadCookie("fcolorc"),i,j;
		for(i=0;i<document.forms.length;i++){
			if(document.forms[i].pwd){
				document.forms[i].pwd.value=P;
			}
			if(document.forms[i].name){
				document.forms[i].name.value=N;
			}
			if(document.forms[i].email){
				document.forms[i].email.value=E;
			}
			if(document.forms[i].url){
				document.forms[i].url.value=U;
			}
			if(document.forms[i].fcolor){
				if(FC == "") FC = document.forms[i].fcolor[0].value;
				for(j = 0; document.forms[i].fcolor.length > j; j ++) {
					if(document.forms[i].fcolor[j].value == FC){
						document.forms[i].fcolor[j].checked = true;
						document.forms[i].fcolor.selectedIndex = j;
					}
				}
			}
		}
};

/* Function to get cookie parameter value string with specified name
   Copyright (C) 2002 Cresc Corp. http://www.cresc.co.jp/
   Version: 1.0
*/
function loadCookie(name) {
	var allcookies = document.cookie;
	if (allcookies == "") return "";
	var start = allcookies.indexOf(name + "=");
	if (start == -1) return "";
	start += name.length + 1;
	var end = allcookies.indexOf(';',start);
	if (end == -1) end = allcookies.length;
	
	return decodeURIComponent(allcookies.substring(start,end));
}
