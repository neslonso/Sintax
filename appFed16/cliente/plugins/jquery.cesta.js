//jQuery plugin jqCesta
/* History
/**
 * History
 * 0.1 (20160907)
 * Template sin funcionalidad, basada en http://stefangabos.ro/jquery/jquery-plugin-boilerplate-revisited/
 * Interfaz con el exterior:
 * $(document).ready(function() {
 *
 *    // attach the plugin to an element
 *    $('#element').jqCesta({'foo': 'bar'});
 *
 *    // call a public method
 *    $('#element').data('jqCesta').foo_public_method();
 *
 *    // get the value of a property
 *    $('#element').data('jqCesta').settings.foo;
 *
 * });
 * 0.2 (20160913)
 * Estructura objetos cesta
 *  arrItems [{ id: -, titulo: -, imagen: -, descripcion: -, quantity: -, precio: - }, ...]
 */

// El punto y coma es por si acaso algo que no esté bien cerrado se concatena con este fichero
// Window y document se pasan para convertirlas en varialbes locales y que el acceso sea un poco mas rápido
// undefined no se pasa para que sea de verdad undefined, por si acaso algo lo ha modificado (en ECMAScript
// 3 es posible modificar el valor de undefined, en ECMAScript 5 ya no).
;(function($) {
	$.jqCesta = function(element, options) {
		// plugin's default options
		// this is private property and is  accessible only from inside the plugin
		//acceso : plugin.settings.PARAM;
		var defaults = {
			txtBtnCart: "Cesta", //texto boton principal
			imgActiveBtnCart: true, /*prioridad sobre ico en caso de estar los dos activos*/
			icoActiveBtnCart: false,
			imgBtnCart: "./appFed16/cliente/plugins/jquery.cesta/binaries/imgs/ico_cart1.png", //img src si imgActiveBtnCart esta activo
			icoBtnCart: "fa fa-shopping-cart", //icon fa fontawesome si icoActiveBtnCart esta activo
			badgeActiveQuantityBtnCart: true, //boolean para controlar la activacion del badge con unidades en cesta que sale en btn cesta
			arrItems: [{}],//array objetos
			quantityItems: 0,
			maxHeigth: 250,//array objetos
			speed: 'ease-in',//velocidad del desplazamiento desplegamiento div
			foo: 'bar',
			txtQuantityTotal: 'Cantidad',
			txtBtnOrder: 'Continuar compra',
			// if your plugin is event-driven, you may provide callback capabilities
			// for its events. execute these functions before or after events of your
			// plugin, so that users may customize those particular events without
			// changing the plugin's code
			onFoo: function() {}

		}

		// to avoid confusions, use "plugin" to reference the
		// current instance of the object
		var plugin = this;

		// this will hold the merged default, and user-provided options
		// plugin's properties will be available through this object like:
		// plugin.settings.propertyName from inside the plugin or
		// element.data('jqCesta').settings.propertyName from outside the plugin,
		// where "element" is the element the plugin is attached to;
		plugin.settings = {}

		var $element = $(element), // reference to the jQuery version of DOM element
			 element = element;    // reference to the actual DOM element

		// the "constructor" method that gets called when the object is created
		plugin.init = function() {
			// the plugin's final properties are the merged default and
			// user-provided options (if any)
			plugin.settings = $.extend({}, defaults, options);
			//borrar. Simula carga items en variable
			//plugin.loadCesta();
			plugin.initCart();

			//call simulada
			plugin.addItem("./appFed16/binaries/imgs/shop-item.jpg", "LOREM IPSUM 6", 2, (15.00).toFixed(2), 6);
		}

		// public methods
		// these methods can be called like:
		// plugin.methodName(arg1, arg2, ... argn) from inside the plugin or
		// element.data('jqCesta').publicMethod(arg1, arg2, ... argn) from outside
		// the plugin, where "element" is the element the plugin is attached to;

		plugin.initCart = function(){
			plugin.loadCesta();

			$element.html('<a class="btn btn-default btnCart ico-cart" href="#menu-toggle"></a> <div class="content-cart"></div>').appendTo(element);

			var ico_html = (plugin.settings.icoActiveBtnCart) ? '<i class="' + plugin.settings.icoBtnCart + ' ico-cesta"></i>' : '';
			var imagen_html = (plugin.settings.imgActiveBtnCart) ? '<img class="img-responsive ico-cesta"  src="' + plugin.settings.imgBtnCart + '" alt="">' : ico_html;
			var badgeQuantity_html = (plugin.settings.badgeActiveQuantityBtnCart) ? '&nbsp;<sup><span class="badge badgeQuantity">' + plugin.settings.quantityItems + '</span></sup>' : '';
			$('.btnCart',$element).html( plugin.settings.txtBtnCart /*+ imagen_html*/ + badgeQuantity_html );

			$('.btnCart',$element).click(function(event) {
				plugin.viewCesta();
			});

		}
		plugin.loadCesta = function(){
			plugin.settings.arrItems = simuladorCargaItems();
			refreshQuantity(countQuantityArrItems());
		}

		plugin.viewCesta = function(){
			var html_items = "";
			var arr = plugin.settings.arrItems;
			for (var item in arr) {
				html_items = html_items + renderItem(arr[item].imagen, arr[item].titulo, arr[item].quantity,  (arr[item].precio).toFixed(2), arr[item].id);
			}

			var html_cesta = render(html_items);
			$('.content-cart',$element).html(html_cesta).appendTo(element);

			//variable tamanho max altura listado items
			$('.list-item-cart',$element).css("max-height", plugin.settings.maxHeigth);

			if( isHideCesta() ){
				showCesta();
			}else{
				if( isShowCesta() ){
					hideCesta();
 				}else{
 					//por fecto mostramos cesta
 					showCesta();
 				}
			}
		}

		plugin.addItem = function(src, ttl, unit, prc, id){
			addItem(src, ttl, unit, prc, id);
		}

		// private methods
		// these methods can be called only from inside the plugin like:
		// methodName(arg1, arg2, ... argn)

		//mostrar cesta
		var isHideCesta = function() {
			return ($('.content-cart',$element).hasClass('content-cart-outside'));
		}

		//mostrar cesta
		var isShowCesta = function() {
			return ($('.content-cart',$element).hasClass('content-cart-inside'));
		}

		//mostrar cesta
		var hideCesta = function() {
			$('.content-cart',$element).removeClass('content-cart-inside');
 			$('.content-cart',$element).addClass('content-cart-outside');
		}

		//ocultar cesta
		var showCesta = function() {
			$('.content-cart',$element).removeClass('content-cart-outside');
 			$('.content-cart',$element).addClass('content-cart-inside');
		}

		var render = function(htmlItems) {
			var htmlItems = '<div class="row list-item-cart">' + htmlItems + '</div><div class="col-lg-12 total-cart"><p class="info-total p-a-1 m-y-1">(<span class="quantity-total">' + plugin.settings.quantityItems + '</span>)&nbsp;Unidades<span class="pull-xs-right"><b>TOTAL: <span class="total">323.21</span>&nbsp;€</b></span></p><a  class="btn btn-primary btn-lg btn-block btn-check-order" type="button" href="/cart/"><b>' + plugin.settings.txtBtnOrder + '</b></a> </div>';
			return htmlItems;
		}

		var renderItem = function(src, ttl, unit, prc, id) {
			var htmlItem = '<div class="col-lg-12"><div class="col-sm-4"><img class="img-responsive" src="' + src + '" alt=""></div><div class="col-sm-8"><p class="ttl-item-cart">' + ttl + '</p><p class="unit-item-cart" >' + plugin.settings.txtQuantityTotal + ': <span>' + unit + '</span></p><p class="price-item-cart" >Precio: <span>' + prc + '&euro;</span></p></div></div><div class="col-lg-9 col-lg-push-2 separator-item"></div>';
			return htmlItem;
		}

		var addItem = function(src, ttl, unit, prc, id) {
			//comprobar si existe una clase

			refreshQuantity(unit);

			var html_item = renderItem(src, ttl, unit, prc, id);
			console.log("publico addItem: cuerpo de new producto");
			console.log(html_item);
			//$('.list-item-cart',$element).html(html_item).appendTo(element);
			var lastItem = $element.find("div[class='separator-item']:last");
			if (lastItem.length){
				console.log("Existen items en cesta " + lastItem.length);
			   	lastItem.after(html_item);
			}else {
				console.log("No localizado ultimo separador: cesta vacia " + lastItem.length);
				$('.list-item-cart').html(html_item);
			}

		}

		var refreshQuantity = function(quantity) {
			plugin.settings.quantityItems = plugin.settings.quantityItems + quantity;
			if(plugin.settings.badgeActiveQuantityBtnCart){
				$('.badgeQuantity',$element).html(plugin.settings.quantityItems);
			}
			$('.quantity-total',$element).html(plugin.settings.quantityItems);
		}

		var countQuantityArrItems = function(){
			var quantity = 0;
			var arr = plugin.settings.arrItems;
			for (value in arr){
				quantity = quantity + arr[value].quantity;
			}
			return quantity;
		}

		//borrar
		var simuladorCargaItems = function() {
			var src_imagen_default = "./appFed16/binaries/imgs/shop-item.jpg";
			var items = [
    		{ id: 1, titulo: "LOREM IPSUM 1", imagen: src_imagen_default, descripcion: "LOREM PRODUCT ABOVE FOCUSED ON USING VARIABLES 1", quantity: 1, precio: 23.00 },
   			{ id: 2, titulo: "LOREM IPSUM 2", imagen: src_imagen_default, descripcion: "LOREM PRODUCT ABOVE FOCUSED ON USING VARIABLES 2", quantity: 2, precio: 20.00 },
    		{ id: 3, titulo: "LOREM IPSUM 3", imagen: src_imagen_default, descripcion: "LOREM PRODUCT ABOVE FOCUSED ON USING VARIABLES 3", quantity: 1, precio: 21.50 },
    		{ id: 4, titulo: "LOREM IPSUM 4", imagen: src_imagen_default, descripcion: "LOREM PRODUCT ABOVE FOCUSED ON USING VARIABLES 4", quantity: 5, precio: 60.85 },
    		{ id: 5, titulo: "LOREM IPSUM 5", imagen: src_imagen_default, descripcion: "LOREM PRODUCT ABOVE FOCUSED ON USING VARIABLES 5", quantity: 1, precio: 13.00 }
			];
			return items;
		}


		// call the "constructor" method
		plugin.init();
	}

	// add the plugin to the jQuery.fn object
	$.fn.jqCesta = function(options) {
		// iterate through the DOM elements we are attaching the plugin to
		return this.each(function() {
			// if plugin has not already been attached to the element
			if (undefined == $(this).data('jqCesta')) {
				// create a new instance of the plugin
				// pass the DOM element and the user-provided options as arguments
				var plugin = new $.jqCesta(this, options);
				// in the jQuery version of the element
				// store a reference to the plugin object
				// you can later access the plugin and its methods and properties like
				// element.data('jqCesta').publicMethod(arg1, arg2, ... argn) or
				// element.data('jqCesta').settings.propertyName
				$(this).data('jqCesta', plugin);
			}
		});
	}
})(jQuery);

/******************************************************************************/
/*
//
//jQuery plugin cesta (CODIGO DE REFERENCIA)
;(function($){
	var methods = {
		init:function( options ) {
			//this=jQuery object/collection the plugin was invoked on
			return this.each(function () {
				//this=Objeto del DOM the plugin was invoked on (uno por vuelta si el objeto jQuery tenía mas de uno
				if ( ! $(this).data('cesta') ) {
					this.opt = $.extend(true, {}, $.fn.cesta.defaults, options);
					//methods.getData($(this));
					//$(this).cesta('getData');//($(this));
					methods.getData.call($(this));
					//Guardamos en el objeto del DOM referencia al plugin cesta aplicado
					$(this).data('cesta', {
						target : $(this)
					});
					$(this).addClass('jQueryCesta');
				}
			});
		},
		getData: function () {
			var self=this;
			var $target=$(self);
			methods.startLoading.call(self);

			$.post('./actions.php',{
				'APP':'appTienda',
				'acClase':'Home',
				'acMetodo':'getObjInfoCesta',
				'acTipo':'ajaxAssoc',
				'dto':self[0].opt.tipoDescuento,
				'cupon':self[0].opt.cupon,
				'idDireccion':self[0].opt.idDireccion,
				'credito':self[0].opt.credito
			},
			function (data,textStatus,jqXHR) {
				if (data.exito) {
					var objInfoCesta=$.parseJSON(data.data);
					$target.data('cesta',{
						target : $target,
						objInfoCesta:objInfoCesta
					});
					methods.stopLoading.call(self);
					//$target.trigger('getDataComplete');
					$('.jQueryCesta').each(function() {
						var $this=$(this);
						$this.data('cesta',{
							target : $this,
							objInfoCesta:objInfoCesta
						});
						$this.trigger('getDataComplete',objInfoCesta);
					});
				} else {
					muestraMsgModal('Fallo en la carga de datos de cesta',data.msg);
				}
			},
			'json');
		},
		add: function (idProducto,cantidad) {
			var self=this;
			var $target=this;
			methods.startLoading.call(self);

			$.post('./actions.php',{
				'APP':'appTienda',
				'acClase':'Home',
				'acMetodo':'addToCesta',
				'acTipo':'ajaxAssoc',
				'idProducto':idProducto,
				'cantidad':cantidad,
				'dto':self[0].opt.tipoDescuento,
				'cupon':self[0].opt.cupon,
				'idDireccion':self[0].opt.idDireccion,
				'credito':self[0].opt.credito
			},
			function (data,textStatus,jqXHR) {
				if (data.exito) {
					var objInfoCesta=$.parseJSON(data.data);
					methods.stopLoading.call(self);
					//methods.renderResumen.call(self);

					//$target.trigger('addComplete');
					$('.jQueryCesta').each(function() {
						var $this=$(this);
						$this.data('cesta',{
							target : $this,
							objInfoCesta:objInfoCesta
						});
						$this.trigger('addComplete',objInfoCesta);
					});
				} else {
					muestraMsgModal('Fallo en la adición de producto a la cesta',data.msg);
				}
			},
			'json');
			return $target;
		},
		startLoading: function () {
			var $target=$(this);
			$('*',$target).filter(":input").prop("disabled", true);
			$target.addClass('ui-state-disabled');
			var $imgLoading=$('<img/>')
			.addClass('imgLoading')
			.attr('src','./imgs/lib/ajax-loader-mini.gif')
			.css ({position:'absolute'})
			.appendTo($target)
			.position ({
				of: $target,
				my: 'center',
				at: 'center',
				offset: 0,
				collision: 'none'
			});
		},
		stopLoading: function () {
			var $target=$(this);
			$('.imgLoading',$target).remove();
			$('*',$target).filter(":input").prop("disabled", false);
			$target.removeClass('ui-state-disabled');
		},
		render: function () {
			//console.log(this);
			var self=this;
			var $target=this;
			var objInfoCesta=$target.data('cesta').objInfoCesta;
			var $divSuPedido=$('#divSuPedido',$target);
			$divSuPedido.empty();
			var i=0;

			var $table=$('<table/>').addClass('tableLineas ui-widget');
			var $thead=$('<thead/>').addClass('ui-widget-header').appendTo($table);
			var $trCabecera=$('<tr/>').appendTo($thead);
			var $thFoto=$('<th/>').addClass('foto').appendTo($trCabecera);
			var $thConcepto=$('<th/>').html('Producto').addClass('concepto').appendTo($trCabecera);
			var $thPrecioU=$('<th/>').html('Precio').addClass('precioU').appendTo($trCabecera);
			var $thDto=$('<th/>').html('Descuento').addClass('dto').appendTo($trCabecera);
			var $thCantidad=$('<th/>').html('Cantidad').addClass('cantidad').appendTo($trCabecera);
			var $thTotal=$('<th/>').html('Total').addClass('totalLinea').appendTo($trCabecera);

			var $tbody=$('<tbody/>').addClass('ui-widget-content').appendTo($table);

			for (var x in objInfoCesta.arrInfoLineas) {
				i++;
				var linea=objInfoCesta.arrInfoLineas[x];
				var $trLinea=$('<tr/>');

				var $tdFoto=$('<td/>').html('<img src="'
											+linea.srcFoto+'" style="width:40px; border:ridge #6060CC 1px; padding:3px;" alt="'
											+linea.concepto+'" />')
				.addClass('foto').appendTo($trLinea);
				var $tdConcepto=$('<td/>').html(linea.concepto).addClass('concepto').appendTo($trLinea);
				var $tdPrecioU=$('<td/>').html(linea.precioU+' €').addClass('precioU').appendTo($trLinea);
				var $tdDto=$('<td/>').html(linea.tipoDescuento+'%').addClass('dto').appendTo($trLinea);
				var $tdCantidad=$('<td/>').html(linea.cantidad).addClass('cantidad').appendTo($trLinea);
				var $tdTotal=$('<td/>').html(linea.precio+' €').addClass('totalLinea').appendTo($trLinea);

				$trLinea.appendTo($tbody);
			}

			$tfoot=$('<tfoot/>').addClass('ui-widget-header').appendTo($table);
			if (i!=0) {
				//var $hr=$('<hr/>').appendTo($divSuPedido);
				var $trTotal=$('<tr/>');
				var $tdLabelTotal=$('<td/>').attr('colspan',5).html('Total:').addClass('labelTotalLineas').appendTo($trTotal);
				var $tdTotal=$('<td/>').html(objInfoCesta.totalLineas+' €').addClass('totalLineas').appendTo($trTotal);
				$trTotal.appendTo($tfoot);

				if (self[0].opt.tipoDescuento!=0) {
					var $trTotalDescuento=$('<tr/>');
					var $tdLabelTotal=$('<td/>').attr('colspan',5).html('Descuento ('+objInfoCesta.tipoDescuento+'%):')
						.addClass('labelTotalDescuento').appendTo($trTotalDescuento);
					var $tdTotal=$('<td/>').html(objInfoCesta.totalDescuento+' €').addClass('totalDescuento').appendTo($trTotalDescuento);
					$trTotalDescuento.appendTo($tfoot);
				}

				if (self[0].opt.credito!=0) {
					var $trTotalCredito=$('<tr/>');
					var $tdLabelTotal=$('<td/>').attr('colspan',5).html('Credito:')
						.addClass('labelTotalCredito').appendTo($trTotalCredito);
					var $tdTotal=$('<td/>').html(objInfoCesta.credito+' €').addClass('totalCredito').appendTo($trTotalCredito);
					$trTotalCredito.appendTo($tfoot);
				}

				var $trPortes=$('<tr/>');
				var $tdLabelPortes=$('<td/>').attr('colspan',5).html('Gastos de envío:').addClass('labelPortes').appendTo($trPortes);
				var $tdPortes=$('<td/>').html(objInfoCesta.portes+' €').addClass('portes').appendTo($trPortes);
				$trPortes.appendTo($tfoot);

				var $trTotalPedido=$('<tr/>');
				var $tdLabeltrTotalPedido=$('<td/>').attr('colspan',5).html('Total pedido:').addClass('labelTotalPedido').appendTo($trTotalPedido);
				var $tdTotalPedido=$('<td/>').html(objInfoCesta.total+' €').addClass('totalPedido').appendTo($trTotalPedido);
				$trTotalPedido.appendTo($tfoot);

			} else {
				$table.empty();
				$divSuPedido.html('Su cesta no contiene ningún producto.');

			}
			$table
				.appendTo($divSuPedido);
		},
		renderResumen: function () {
			var $target=this;
			var objInfoCesta=$target.data('cesta').objInfoCesta;
			var $divSuPedido=$('#divSuPedido',$target);
			$divSuPedido.empty();
			var i=0;
			for (var x in objInfoCesta.arrInfoLineas) {
				i++;
				var linea=objInfoCesta.arrInfoLineas[x];
				var $divLinea=$('<div/>')
					.addClass("divLinea clearfix");

				var $divNombre=$('<div/>')
					.css ({cursor:'pointer'})
					//TODO: Mejora: Esto habria que cambiarlo y crear los eventos lineaover y lineaout, pasando concepto y srcFoto
					//para sacar de aqui la dependencia al bocadillo y a opcionesBocadilloTip
					.mouseover(
						(function (concepto,srcFoto){
							return function (e) {
								$(this).bocadillo(
									$.extend(true,{},opcionesBocadilloTip,{
										width:'160px',
										position:{at:'left'},
										pointer:{align:'top',offset:5},
										//msg:'<div style=&quot;text-align:center;&quot;>'+linea.concepto+'<br /><img style=&quot;width:40px; border:ridge #6060CC 1px; padding:3px;&quot; src=&quot;'+linea.srcFoto+'&quot; alt=&quot;'+linea.concepto+'&quot; /></div>'
										msg:'<div style="text-align:center;"><img src="'
											+srcFoto+'" style="float:left; width:40px; border:ridge #6060CC 1px; padding:3px;" alt="'
											+concepto+'" />'+concepto+'</div>'
									})
								);
							};
						})(linea.concepto,linea.srcFoto)
					)
					.mouseout(function (e) {
						$(this).bocadillo('destroy');
					})
					.html(linea.cantidad+'x<span style="font-weight:bold;">'+linea.conceptoResumido+'</span>')
					.appendTo($divLinea);

				var $divCmds=$('<div/>')
					.css({float:'left'})
					.appendTo($divLinea);
				var $aMas1=$('<button/>')
					.attr({
						'type': 'button',
						'title':'Añadir 1'
					})
					.css ({height:'16px'})
					.button({
						icons: {primary: "ui-icon-plus"},
						text: false
					})
					.click((function (idProducto) {
						return function (e) {
							$(this).button( "option", "disabled",true);
							$target.cesta('add',idProducto,1)
							.bind ('addComplete',function () {$(this).button( "option", "disabled",false);})
						}})(linea.id))
					.appendTo($divCmds);
				var $aMenos1=$('<button/>')
					.attr({
						'type': 'button',
						'title':'Quitar 1'
					})
					.css ({height:'16px'})
					.button({
						icons: {primary: "ui-icon-minus"},
						text: false
					})
					.click((function (idProducto) {
						return function (e) {
							$(this).button( "option", "disabled",true);
							$target.cesta('add',idProducto,-1)
							.bind ('addComplete',function () {$(this).button( "option", "disabled",false);})
						}})(linea.id))
					.appendTo($divCmds);
				var $menosTodos=$('<button/>')
					.attr({
						'type': 'button',
						'title':'Quitar todos'
					})
					.css ({height:'16px'})
					.button({
						icons: {primary: "ui-icon-trash"},
						text: false
					})
					.click((function (idProducto) {
						return function (e) {
							$(this).button( "option", "disabled",true);
							$target.cesta('add',idProducto,"*")
							.bind ('addComplete',function () {$(this).button( "option", "disabled",false);})
						}})(linea.id))
					.appendTo($divCmds);

				var $divPrecio=$('<div/>')
					.css({float:'right'})
					.html(linea.precio+' €')
					.appendTo($divLinea);

				$divLinea
					.appendTo($divSuPedido);
			}
			if (i!=0) {
				var $hr=$('<hr/>').appendTo($divSuPedido);
				var $divTotalLineas=$('<div/>')
					.html('Total: <span style="float:right;">'+objInfoCesta.totalLineas+' €</span>')
					.appendTo($divSuPedido);

				if ($target[0].opt.tipoDescuento!=0) {
					var $divTotalDescuento=$('<div/>')
						.html('Descuento ('+objInfoCesta.tipoDescuento+'%): <span style="float:right;">'+objInfoCesta.totalDescuento+' €</span>')
						.appendTo($divSuPedido);
				}

				if ($target[0].opt.credito!=0) {
					var $divCredito=$('<div/>')
						.html('Credito: <span style="float:right;">'+objInfoCesta.credito+' €</span>')
						.appendTo($divSuPedido);
				}

				var $divPortes=$('<div/>')
					.html('Gastos de envío: <span style="float:right;">'+objInfoCesta.portes+' €</span>')
					.appendTo($divSuPedido);
				if ($divPortes.find('span[title]').length>0) {
					$divPortes
						.mouseover(
							(function (msg){
								return function (e) {
									$(this).bocadillo(
										$.extend(true,{},opcionesBocadilloTip,{
											width:'160px',
											position:{at:'left'},
											pointer:{align:'top',offset:5},
											msg: msg
										})
									);
								};
							})($divPortes.find('span[title]').attr('title'))
						)
						.mouseout(function (e) {
							$(this).bocadillo('destroy');
						});
				}
				var $divTotal=$('<div/>')
					.html('Total pedido: <span style="float:right;">'+objInfoCesta.total+' €</span>')
					.appendTo($divSuPedido);

				var $submit=$('input[type=submit]', $target)
				$submit.prop('disabled',false);
				$submit.button('options','disabled',false);
				$submit.removeClass('ui-state-disabled');
			} else {
				$divSuPedido.html('Su cesta no contiene ningún producto.');

				var $submit=$('input[type=submit]', $target)

				$submit.prop('disabled',true);
				$submit.button('options','disabled',true);
				$submit.addClass('ui-state-disabled');
			}
		},
		set:function(opt,value) {
			return this.each(function () {
				//this[0].opt[opt]=value;
				this.opt[opt]=value;
				//console.log('cesta setting value -'+opt+'- to -'+value+'-');
			});
		},
		GETtotalLineas: function () {
			var $target=this;
			var objInfoCesta=$target.data('cesta').objInfoCesta;
			return parseFloat(objInfoCesta.totalLineas.replace(',','.'));
		},
		destroy:function() {
			return this.each(function(){
				// Namespacing FTW
				if ($(this).data('cesta')) {
					$(this).removeData('cesta');
				}
			});
		}
	};

	$.fn.cesta = function(method) {
		//console.log('this en Method calling logic: ');
		//console.log(this);
		//this=jquery object
		// Method calling logic
		if ( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.cesta' );
		}
	};

	$.fn.cesta.defaults = {
		tipoDescuento:0,
		cupon:null,
		idDireccion:null,
		credito:0,
		imgLoading:'./imgs/lib/ajax-loader-mini.gif'
	};

})(jQuery);
 */