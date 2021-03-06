// JavaScript Document
function Post() {
	form=document.createElement("form");
	form.setAttribute("action",window.location);
	form.setAttribute("method","post");

	for (var i=0; i<arguments.length; i+=2) {
		switch (arguments[i]) {
		case "action":
			form.setAttribute("action",arguments[i+1]);
			break;
		case "method":
			form.setAttribute("method",arguments[i+1]);
			break;
		default:
			if (arguments[i+1] instanceof Array ||
				arguments[i+1] instanceof Object) {
				createInputsFor(form, arguments[i],arguments[i+1]);
			} else {
				input=document.createElement("input");
				input.setAttribute("type","hidden");
				input.setAttribute("name",arguments[i]);
				input.setAttribute("value",arguments[i+1]);
				form.appendChild(input);
			}
		}
	}
	document.body.appendChild(form);
	//console.log(form);
	form.submit();
}

function createInputsFor(form, name, arrayOrObject) {
	for (var indexOrProperty in arrayOrObject) {
		var value=arrayOrObject[indexOrProperty];
		if (value instanceof Array ||
			value instanceof Object) {
			createInputsFor(form, name+'['+indexOrProperty+']', value);
		} else {
			input=document.createElement("input");
			input.setAttribute("type","hidden");
			input.setAttribute("name",name+"["+indexOrProperty+"]");
			input.setAttribute("value",value);
			form.appendChild(input);
		}
	}
}