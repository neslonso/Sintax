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
 */

// El punto y coma es por si acaso algo que no esté bien cerrado se concatena con este fichero
// Window y document se pasan para convertirlas en varialbes locales y que el acceso sea un poco mas rápido
// undefined no se pasa para que sea de verdad undefined, por si acaso algo lo ha modificado (en ECMAScript
// 3 es posible modificar el valor de undefined, en ECMAScript 5 ya no).
;(function($) {
	$.jqCesta = function(element, options) {
		// plugin's default options
		// this is private property and is  accessible only from inside the plugin
		var defaults = {

			foo: 'bar',
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
			// code goes here
			$('<div>').html('Hola plugin').appendTo(element);
		}

		// public methods
		// these methods can be called like:
		// plugin.methodName(arg1, arg2, ... argn) from inside the plugin or
		// element.data('jqCesta').publicMethod(arg1, arg2, ... argn) from outside
		// the plugin, where "element" is the element the plugin is attached to;

		// a public method. for demonstration purposes only - remove it!
		plugin.foo_public_method = function() {
			// code goes here
		}

		// private methods
		// these methods can be called only from inside the plugin like:
		// methodName(arg1, arg2, ... argn)

		// a private method. for demonstration purposes only - remove it!
		var foo_private_method = function() {
			// code goes here
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