//Constructor
function Producto (dataProvider,id) {
	this.dataProvider=dataProvider;
	this.id=id;
}

Producto.prototype.cargarId = function() {
	/*dataProvider.getData({
		clase: 'Producto',
		funcion:'cargarId',
		parameters: {
			id:this.id
		}
	});*/
};

Producto.prototype.allToArray= function (dataProvider,$where,$order,$limit,$tipo) {
	/*return dataProvider.getData({
		clase: 'Producto',
		funcion:'allToArray',
		parameters: arguments
	});*/
}.defaults(null,"","","","arrStdObjs");


/* CODIGO DE PRUEBA */
/*
	var stxConn=new sintaxApiConnection('<?=BASE_URL.FILE_APP?>','api','<?=KEY_APP?>');

	$.when(Producto.prototype.allToArray(stxConn))
		.done(function(data, textStatus, jqXHR) {
			console.log("success");
			console.log(arguments);
		})
		.fail(function() {
			console.log("error");
			console.log(arguments);
		})
		.always(function() {
			console.log("complete");
			console.log(arguments);
		});
*/