/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function createXMLHttpRequestObject()
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlhttp;
}

function sendGetRequestToServerAndResponse(requester,fileRequest,idDiv, async)
{
    if (async==false)
    {
        requester.open("GET",fileRequest,async);
        requester.send();
        document.getElementById(idDiv).innerHTML=requester.responseText;
    }
    else
    {
        requester.onreadystatechange=function()
        {
            if (requester.readyState==4 && requester.status==200)
            {
                document.getElementById(idDiv).innerHTML=requester.responseText;
            }
        }
        requester.open("GET",fileRequest,async);
        requester.send();
        document.getElementById(idDiv).innerHTML = "<img src='res/img/loading.gif'>";

    }
}

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		document.getElementById('status_div').innerHTML =
		'Status: Cound not create XmlHttpRequest Object.' +
		'Consider upgrading your browser.';
	}
	return null;
}
