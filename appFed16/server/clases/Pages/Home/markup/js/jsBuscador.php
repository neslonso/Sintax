<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {

	$('#ssSearch').ssSearch({
		ajax: {
			url: '<?=BASE_URL.FILE_APP?>',
			data: {
				'MODULE':'actions',
				'acClase':'Home',
				'acMetodo':'acSearchOfers',
				'acTipo':'ajax',
			},
			path:'data',
		},
		container: {
			cssClasses:'',
			css: {},
			template: [
				'<div class="container-fluid">',
					'<div class="row">',
					'</div>',
				'</div>',
			].join(''),
			emptyTemplate:[
					'<div style="height:13px; background-color: #a0a0a0;"></div>',
					'<div style="text-align:center;">',
						'No se encontraron resultado para la búsqueda "{{sQuery}}"',
					'</div>',
					'<div style="height:13px; background-color: #a0a0a0;"></div>',
			].join(''),
		},
		item: {
			cssClasses:'col-xs-12 col-md-6',
			template: [
				'<div>',
					'<div class="row">',
						'<div class="col-xs-12">',
							'<div class="nombre">{{nombreHighlight}}</div>',
						'</div>',
						'<div class="col-xs-6">',
							'<img src="{{imgSrc}}" style="float:left" />',
						'</div>',
						'<div class="col-xs-6">',
							'<div class="descripcion">{{descripcion}}</div>',
						'</div>',
						'<div class="col-xs-6">',
							'<span class="precio">{{precio}} €</span>',
						'</div>',
						'<div class="col-xs-6 text-right">',
							'<a class="btn jqCst banner-price-comprar" data-id="{{id}}" data-ttl="{{nombre}}" data-unit="1" data-prc="{{precio}}" data-src="{{imgSrc}}">Comprar</a>',
						'</div>',
					'</div>',
				'</div>',
			].join(''),
		}
	});
	/*
	//http://www.runningcoder.org/jquerytypeahead/demo/

					<form id="typeahead-form" name="typeahead-form" style="width:100%;">
						<div class="typeahead__container">
							<div class="typeahead__field">
								<span class="typeahead__query">
									<span class="typeahead__cancel-button"></span><input class="js-typeahead" name="q" type="search" placeholder="Busca en <?=$GLOBALS['config']->tienda->SITE_NAME?>..." autocomplete="off">
								</span>
								<span class="typeahead__button">
									<button type="submit">
										<span class="typeahead__search-icon"></span>
									</button>
								</span>
							</div>
						</div>
					</form>


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
					//console.log(item);
					item.imgSrc='<?=BASE_URL.FILE_APP?>?MODULE=images&almacen=DB&fichero=multi_productoAdjunto.id.'+item.idFoto+'.data&ancho=60&alto=60&modo=256';
					var template=[
						'<li>',
							'<div>{{nombre}}</div>',
							'<div class="clearfix">',
								'<img style="float:left" ',
									'src="'+item.imgSrc+'" ',
								'/>',
								'<div style="height:40px; overflow:hidden; font-size:x-small;">{{descripcion}}</div>',
								'<div style="text-align:right; font-size:3em;">'+parseFloat(item.precio).toFixed(2)+'€</div>',
							'</div>',
							'<div>',
								'<button type="button" class="btn btn-warning jqCst" data-id="'+item.id+'" data-ttl="'+item.nombre+'" data-unit="1" data-prc="'+parseFloat(item.precio).toFixed(2)+'" data-src="'+item.src+'">Comprar</button>',
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
			onClickBefore: function (node, a, item, event) {
				console.log(node);console.log(a);console.log(item);console.log(event);
				console.log('onClickBefore function triggered');
				event.stopPropagation();
			},
			onClick: function (node, a, item, event) {
				console.log(node);console.log(a);console.log(item);console.log(event);
				console.log('onClick function triggered');
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
	*/
});