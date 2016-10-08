//jQuery remoteObj
/* History
/**
 * History
 * 0.1 (20160910)
 * Template de clase javascript
 */

"use strict";
//Constructor
function sintaxApiConnection(uri,MODULE,APP) {
	this.uri=uri;
	this.MODULE=MODULE;
	this.APP=APP;
}

sintaxApiConnection.prototype.getData = function(objArgs) {
	console.log('getData');
	return $.ajax({
		url: this.uri,
		type: 'POST',
		//dataType: 'json',
		data: {
			MODULE: this.MODULE,
			APP: this.APP,
			service: 'getData',
			parameters: objArgs
		},
	});
};
