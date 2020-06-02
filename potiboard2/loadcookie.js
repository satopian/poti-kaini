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

/* Function Equivalent to URLDecoder.decode(String, "UTF-8")
   Copyright (C) 2002 Cresc Corp. http://www.cresc.co.jp/
   Version: 1.0
*/
function decodeURL(str){
	var s0, i, j, s, ss, u, n, f;
	s0 = "";
	for (i = 0; i < str.length; i++){
		s = str.charAt(i);
		if (s == "+"){s0 += " ";}
		else {
			if (s != "%"){s0 += s;}
			else{
				u = 0;
				f = 1;
				while (true) {
					ss = "";
					for (j = 0; j < 2; j++ ) {
						sss = str.charAt(++i);
						if (((sss >= "0") && (sss <= "9")) || ((sss >= "a") && (sss <= "f"))  || ((sss >= "A") && (sss <= "F"))) {
							ss += sss;
						} else {--i; break;}
					}
					n = parseInt(ss, 16);
					if (n <= 0x7f){u = n; f = 1;}
					if ((n >= 0xc0) && (n <= 0xdf)){u = n & 0x1f; f = 2;}
					if ((n >= 0xe0) && (n <= 0xef)){u = n & 0x0f; f = 3;}
					if ((n >= 0xf0) && (n <= 0xf7)){u = n & 0x07; f = 4;}
					if ((n >= 0x80) && (n <= 0xbf)){u = (u << 6) + (n & 0x3f); --f;}
					if (f <= 1){break;}
					if (str.charAt(i + 1) == "%"){ i++ ;}
					else {break;}
				}
				s0 += String.fromCharCode(u);
			}
		}
	}
	return s0;
}

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
	return decodeURL(allcookies.substring(start,end));
}
