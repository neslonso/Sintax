<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$.typeahead({
		input: '.js-typeahead',
		minLength: 3,
		maxItem: 0,
		//accent:true,
		dynamic:true,
		//cache:'sessionStorage',// localStorage
		filter:false,
		source: {
			ofers: {
				display: ["nombre","descripcion"],
				template: function (query,item) {
					var template=[
						'<li>',
							'<div>{{nombre}}</div>',
							'<div>',
								'<img style="float:left" ',
									'src="<?=BASE_URL.FILE_APP?>?MODULE=images&almacen=DB&fichero=multi_productoAdjunto.id.4793.data&ancho=60&alto=60&modo=256" ',
								'/>',
								'<div style="height:40px; overflow:hidden; font-size:x-small;">{{descripcion}}</div>',
								'<div style="text-align:right;">'+parseFloat(item.precio).toFixed(2)+'€</div>',
							'</div>',
						'</li>',
					].join('');
					return template;
				},
				data: function () {
					var typeahead=this;
					var postedQuery=typeahead.rawQuery.trim();
					var cache=typeahead.node.cache;
					var deferred = $.Deferred();

					if (!Array.isArray(cache[postedQuery])) {
						$.ajax({
							type: 'POST',
							url: '<?=BASE_URL.FILE_APP?>',
							data: {
								'MODULE':'actions',
								'acClase':'Home',
								'acMetodo':'acSearchOfers',
								'acTipo':'ajax',
								'q': postedQuery
							},
							success: function (data, textStatus, jqXHR) {
								//console.log ('Callback: success');
								//console.log ('jqXHR:'); console.log (jqXHR);
								//console.log ('data:'); console.log (data);
								//console.log ('textStatus: '+textStatus);
								if (data.exito) {
									cache[postedQuery] = data.data;
									deferred.resolve(data.data);
								} else {
									deferred.reject("Error en la acción. No se pudo recuperar la busqueda");
								}
							},
							error: function (jqXHR, textStatus, errorThrwon) {
								//console.log ('Callback: error');
								//console.log ('jqXHR:'); console.log (jqXHR);
								//console.log ('textStatus: '+textStatus);
								deferred.reject("Error HTTP. No se pudo recuperar la busqueda.");
							},
							complete: function (jqXHR, textStatus) {
								//console.log ('Callback: complete');
								//console.log ('jqXHR:'); console.log (jqXHR);
								//console.log ('textStatus: '+textStatus);
							},
							dataType: 'json'
						});
					} else {
						deferred.resolve(cache[postedQuery]);
					}
					return deferred;
				}
			}
		},
		emptyTemplate: function (query) {
			return $('<li>', {
				"text": "no se ha encontrado ningún resultado para \"" + query + "\"",
				"class": "my-custom-class"
			});
		},
		callback: {
			onInit: function (node) {
				//console.log(node);
				//console.log('onInit function triggered');
				node.cache=[];
			},
			onClick: function (node, a, item, event) {
				//console.log(node);console.log(a);console.log(item);console.log(event);
				//console.log('onClick function triggered');
			},
			onSubmit: function (node, form, item, event) {
				//console.log(node);console.log(form);console.log(item);console.log(event);
				//console.log('onSubmit override function triggered');
				return false;
			},
			onSendRequest: function (node, query) {
				//console.log('request is sent');
				//return false;
			},
			onSearch: function (node, query) {
				//console.log('onSearch triggered');
			},
			onLayoutBuiltBefore: function (node, query, result, resultHtmlList) {
				//console.log(node);console.log(query);console.log(result);console.log(resultHtmlList);
				//console.log('onLayoutBuiltBefore override function triggered');
				resultHtmlList.css({
					'margin-left':'-50%',
					'width':'200%',
					'max-height':'300px',
					'overflow':'auto',
				});
				return resultHtmlList;
			},
			onReceiveRequest: function (node, query) {
				//console.log('request is received');
			},
		}
	});
});