var xmlHttp

function showDesa(str){
	xmlHttp=GetXmlHttpObject()
	if(xmlHttp==null){
		alert("Browser anda tidak support")
		return
}
var url="../inc/jikuk_ongkos_kirim.php"

url=url+"?q="+str
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function stateChanged(){
	if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
		document.getElementById("txtHint").innerHTML=xmlHttp.responseText
	}
}

function GetXmlHttpObject(){
	var xmlHttp=null;
	
	try{
		xmlHttp=new XMLHttpRequest();
	}catch(e){
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlHttp;
}