//jQuery plugin jqCesta
/* History
/**
 * History
 * 0.2 (20160913)
 * Estructura objetos cesta
 *  arrItems [{ id: -, titulo: -, imagen: -, descripcion: -, quantity: -, precio: - }, ...]
 *
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
 */

;(function($) {
	$.jqCesta = function(element, options) {
		var defaults = {
			arrItems: [],//array objetos
			total: 0,
			classBtnAdd: 'jqCst',
			classBtnRemove: 'jqCstRm', /*clase remove item cart*/
			classRef: 'itemRef_', /*class id item -> + id*/
			linkCart: [{
				txtBtnCart: "",
				imgActiveBtnCart: false,
				imgBtnCart: "./appFed16/cliente/plugins/jquery.cesta/binaries/imgs/ico_cart1.png",
				icoActiveBtnCart: true,
				icoBtnCart: "glyphicon glyphicon-shopping-cart btn-lg",
				badgeActiveQuantityBtnCart: true,
				quantityItems: 0
			}],
			cart: [{
				maxHeigth: 250,
				speed: "ease-in",
				txtQuantityTotal: "Cantidad",
				txtBtnOrder: "Continuar compra",
				classBtnOrder: "btnCheckOrder"
			}],
			notifications:  [{
				ntfActiveAddItem: true,
				ntfClass: "",
				ttlNtf: "Muy Bien",
				txtNtf: "Has Añadido el producto <span id='itemNtfCart'></span> a tu carrito",
				ntfTime: "20sg",
				imgActiveNtf: true,
				imgNtf:"glyphicon glyphicon-shopping-cart btn-lg"
			}],
			/*speed: 'ease-in',//velocidad del desplazamiento desplegamiento div
			classBtnOrder: 'btnCheckOrder',*/
			jquerycesta_something: function( event ) {
				console.log("AQUI ESTAMOS");
			}
			/*onclick del btn despegar*/
		}

		var plugin = this;

		plugin.settings = {}

		var $element = $(element), // reference to the jQuery version of DOM element
			 element = element;    // reference to the actual DOM element

		plugin.init = function() {
			plugin.settings = $.extend({}, defaults, options);
			//borrar. Simula carga items en variable
			//plugin.loadCesta();
			plugin.initCart();
		}

		// public methods
		plugin.initCart = function(){
			$('.'+plugin.settings.classBtnAdd).on('click.jqCesta', 'document', function(event) {
				console.log(this);
				//llamar a addItem
				event.preventDefault();
			});

			/*$('.jqCstRm').click(function(event) {
				alert(" R E M O V E");
				//manejador del foo de settings(por si alguien define eventos de fuera) //this.trigger nombre evento, parametros [documentacion trigger por espacionombres] ej: jqcesta.funcion... para evita sobreescritura funciones  https://api.jquery.com/event.namespace/ obj sobre el que use trigger es  el que sera this
			});*/




			plugin.loadCesta();
			var ST_linkCart = plugin.settings.linkCart[0];

			$element.html('<a class="btn btn-default btnCart" href="#menu-toggle"></a> <div class="content-cart"></div>').appendTo(element);

			var ico_html = (ST_linkCart.icoActiveBtnCart) ? '<i class="' + ST_linkCart.icoBtnCart + ' ico-cart"></i>' : '';
			var imagen_html = (ST_linkCart.imgActiveBtnCart) ? '<img class="img-responsive ico-cart"  src="' + ST_linkCart.imgBtnCart + '" alt="">' : ico_html;
			var badgeQuantity_html = (ST_linkCart.badgeActiveQuantityBtnCart) ? '<span class="badge badgeQuantity">' + ST_linkCart.quantityItems + '</span>' : '';
			$('.btnCart',$element).html( ST_linkCart.txtBtnCart + imagen_html + badgeQuantity_html );

			/*borrar SOLO PARA PROBAR ADD SIN TOCAR CUERPO HOME*/
			var htmlPrevPrueba = $(element).find("div[class='content-cart']:last");

			var callAddItem = '<a onclick="$(\'#divJqCesta\').data(\'jqCesta\').addItem(\'./appFed16/binaries/imgs/shop-item.jpg\', \'LOREM IPSUM 6\', 2, 15.00, 6);$(\'#divJqCesta\').data(\'jqCesta\').refreshTotal(0);">Add [2] Producto&nbsp;</a>';
			if (htmlPrevPrueba.length){
				htmlPrevPrueba.after(callAddItem);
			}
			/*FIN CODIGO A BORRAR*/

			$('.btnCart',$element).click(function(event) {
				var $btn=$(this);
				plugin.viewCesta();
				//manejador del foo de settings(por si alguien define eventos de fuera) //this.trigger nombre evento, parametros [documentacion trigger por espacionombres] ej: jqcesta.funcion... para evita sobreescritura funciones  https://api.jquery.com/event.namespace/ obj sobre el que use trigger es  el que sera this
			});

		}
		plugin.loadCesta = function(){
			//plugin.settings.arrItems = simuladorCargaItems();
			refreshQuantity(countQuantityArrItems(), '+');
		}

		plugin.viewCesta = function(){
			var html_items = "";
			var arr = plugin.settings.arrItems;
			var ST_cart = plugin.settings.cart[0];
			console.log(arr);
			for (var item in arr) {
				html_items = html_items + renderItem(arr[item].imagen, arr[item].titulo, arr[item].quantity,  (arr[item].precio).toFixed(2), arr[item].id);
			}
			$cuerpo_cesta = render(html_items);
			$('.content-cart',$element).html($cuerpo_cesta);
			//variable tamanho max altura listado items
			$('.list-item-cart',$element).css("max-height", ST_cart.maxHeigth);
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

			//UNIFICAR EN UN SOLO SITIO, NO AQUI Y DPS DE CADA ADDITEM
			$('.'+plugin.settings.classBtnRemove,$element).click( function(event) {
				alert("Borrar");
				event.preventDefault();
			});

		}

		plugin.addItem = function(src, ttl, unit, prc, id){
			var exito = 0;
			exito = addItem(src, ttl, unit, prc, id);
			$element.trigger("afterAdd");
			return exito;
		}

		plugin.removeItem = function(id, unit){
			var exito = 0;
			exito = removeItem(id, unit);
			if(exito){
				$element.trigger("afterRemove_Ok");
			}else{
				$element.trigger("afterRemove_Ko");
			}
			return exito;
		}

		plugin.refreshTotal = function(total){
			/*borrar*/
			//calculo desde fuera
			console.log("**********************************");
			console.log("**********************************");
			console.log(plugin.settings.arrItems);
			var ultimoProductoAdd = (plugin.settings.arrItems)[plugin.settings.arrItems.length-1];
			console.log(ultimoProductoAdd);
			var importeAdd = ultimoProductoAdd.precio * ultimoProductoAdd.quantity;
			console.log("Add el importe " + importeAdd);
			var totalActual = plugin.settings.total + importeAdd;
			console.log("Nuevo importe " + totalActual);
			//call desde fuera, desde dentro para simularlar lo tenemos que hacer como la linea de codigo no comentada
			//$('#divJqCesta').data('jqCesta').refreshTotal(totalActual);
			refreshTotal(totalActual);
			/*fin borrar*/

			//refreshTotal(total);
		}

		// private methods
		var isHideCesta = function() {
			return ($('.content-cart',$element).hasClass('content-cart-outside'));
		}

		var isShowCesta = function() {
			return ($('.content-cart',$element).hasClass('content-cart-inside'));
		}

		var hideCesta = function() {
			$('.content-cart',$element).removeClass('content-cart-inside');
 			$('.content-cart',$element).addClass('content-cart-outside');
		}

		var showCesta = function() {
			$('.content-cart',$element).removeClass('content-cart-outside');
 			$('.content-cart',$element).addClass('content-cart-inside');
		}

		var render = function(htmlItems) {
			var ST_setting = plugin.settings;
			var ST_cart = plugin.settings.cart[0];
			var ST_linkCart = plugin.settings.linkCart[0];

			//var htmlItems = '<div class="row list-item-cart">' + htmlItems + '</div><div class="col-lg-12 total-cart"><p class="info-total p-a-1 m-y-1">(<span class="quantity-total">' + ST_linkCart.quantityItems + '</span>)&nbsp;Unidades<span class="pull-xs-right"><b>TOTAL: <span class="total">' + ST_setting.total + '</span>&nbsp;€</b></span></p><a  class="btn btn-primary btn-lg btn-block btn-check-order" type="button" href="/cart/"><b>' + ST_cart.txtBtnOrder + '</b></a> </div>';
			/*var htmlItems = "<div class='row list-item-cart'>
								" + htmlItems + "
							</div>
							<div class='col-lg-12 total-cart'>
								<p class='info-total p-a-1 m-y-1'>
									(<span class='quantity-total'>" + ST_linkCart.quantityItems + "</span>)&nbsp;Unidades
									<span class='pull-xs-right'><b>TOTAL: <span class='total'>" + ST_setting.total + "</span>&nbsp;€</b></span>
								</p>
								<a  class='btn btn-primary btn-lg btn-block btn-check-order' type='button' href='/cart/'><b>" + ST_cart.txtBtnOrder + "</b></a>
							</div>";
			return htmlItems;*/
			var cuerpo = [
				"<div class='row list-item-cart'>",
					htmlItems,
				"</div>",
				"<div class='col-lg-12 total-cart'>",
					"<p class='info-total p-a-1 m-y-1'>",
						"(<span class='quantity-total'>" + ST_linkCart.quantityItems + "</span>)&nbsp;Unidades",
						"<span class='pull-xs-right'><b>TOTAL: <span class='total'>" + ST_setting.total + "</span>&nbsp;€</b></span>",
					"</p>",
					"<a  class='btn btn-primary btn-lg btn-block btn-check-order' type='button' href='/cart/'><b>" + ST_cart.txtBtnOrder + "</b></a>",
				"</div>"
			].join('');
			var $cuerpo=$(cuerpo);
			return $cuerpo;
		}

		var renderItem = function(src, ttl, unit, prc, id) {
			var ST_setting = plugin.settings;
			var ST_cart = plugin.settings.cart[0];
			var classRefId = ST_setting.classRef + id;
			var cuerpoItem = [
				"<div class='col-lg-12 " + classRefId + "'>",
					"<div class='col-xs-6 col-sm-4 col-md-3'>",
						"<img class='img-responsive' src='" + src + "' alt=''>",
					"</div>",
					"<div class='col-xs-6 col-sm-8 col-md-9'>",
						"<p class='ttl-item-cart'>" + ttl + "</p>",
						"<p class='unit-item-cart' >" + ST_cart.txtQuantityTotal + ": <span>" + unit + "</span></p>",
						"<p class='price-item-cart' >Precio: <span>" + prc + "&euro;</span></p>",
						"<a class='btn " + ST_setting.classBtnRemove + "  glyphicon glyphicon-remove-sign ico-cart' data-item='" + id + "'></a>",
					"</div>",
				"</div>",
				"<div class='col-lg-12 col-md-3 col-sm-6 separator-item'>",
				"</div>"
			].join('');
			//var $cuerpoItem=$(cuerpoItem);
			return cuerpoItem;

		}

		var addItem = function(src, ttl, unit, prc, id) {
			refreshQuantity(unit, '+');

			var html_item = renderItem(src, ttl, unit, prc, id);

			var lastItem = $(element).find("div[class='separator-item']:last");
			if (lastItem.length){
				console.log("Existen items en cesta " + lastItem.length);
			   	lastItem.after(html_item);
			}else {
				console.log("No localizado ultimo separador: cesta vacia " + lastItem.length);
				$('.list-item-cart', $(element)).append(html_item);
			}
			addArrItem(src, ttl, unit, prc, id);
			return true;

		}

		var removeItem = function (id, unit){
			alert('remove');
			var classRef = 'itemRef_' + id;
			var exito = 0;
			if ( $(".classRef").length ) {
			    $(".classRef").remove();
			    refreshQuantity(unit, '-');
			    exito = 1;
			}
			return exito;
		}

		var refreshTotal = function(total) {
			console.log("Private refreshTotal " + total);
			plugin.settings.total = total;
			$('.total',$element).html((plugin.settings.total).toFixed(2));

		}

		var addArrItem = function(src, ttl, unit, prc, id) {
			var obj_item = new Object();
			obj_item.id = id;
			obj_item.imagen = src;
			obj_item.descripcion = ttl;
			obj_item.quantity = unit;
			obj_item.precio = prc;
			plugin.settings.arrItems[(plugin.settings.arrItems).length] = obj_item;
		}

		var refreshQuantity = function(quantity, opr) {
			var ST_linkCart = plugin.settings.linkCart[0];
			if(opr == '+')
				ST_linkCart.quantityItems = ST_linkCart.quantityItems + quantity;
			else
				if(ST_linkCart.quantityItems - quantity>0)
					ST_linkCart.quantityItems = ST_linkCart.quantityItems - quantity;
				else
					ST_linkCart.quantityItems = 0;

			if(ST_linkCart.badgeActiveQuantityBtnCart){
				$('.badgeQuantity',$element).html(ST_linkCart.quantityItems);
			}
			$('.quantity-total',$element).html(ST_linkCart.quantityItems);
			//SET quantityItems
			plugin.settings.linkCart[0].quantityItems = ST_linkCart.quantityItems;
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
		return this.each(function() {
			if (undefined == $(this).data('jqCesta')) {
				var plugin = new $.jqCesta(this, options);
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