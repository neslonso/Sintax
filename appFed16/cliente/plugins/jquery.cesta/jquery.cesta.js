//jQuery plugin jqCesta
/* History
/**
 * History
 * 0.9 (20160928)
 * Reescrito a partir del código de Lucia
 *
 * 0.1 (20160907)
 * Template sin funcionalidad, basada en http://stefangabos.ro/jquery/jquery-plugin-boilerplate-revisited/
 * Uso:
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

"use strict";
(function($) {
	$.jqCesta = function(element, options) {
		// plugin's default options
		// this is private property and is  accessible only from inside the plugin
		var defaults = {
			arrItems: [],//array objetos
			classBtnAdd: 'jqCst',
			classBtnRemove: 'jqCstRm', //clase remove item cart
			classBtnSpinbox: 'jqCstSpnbx', //clase spinner item cart
			linkCart: {
				txtBtnCart: "",
				imgActiveBtnCart: false,
				imgBtnCart: "./appFed16/cliente/plugins/jquery.cesta/binaries/imgs/ico_cart1.png",
				icoActiveBtnCart: true,
				classBtn: "btn-menu",
				icoBtnCart: "glyphicon glyphicon-shopping-cart",
				icoBtnCheckout: "glyphicon glyphicon-ok-circle",
				badgeActiveQuantityBtnCart: true,
			},
			cart:{
				txtBtnOrder: "Comprar ahora",
				classBtnOrder: "btnCheckOrder",
				valMinQuantity : 1,
				valMaxQuantity : 99,
			}
		}

		// plugin reference the current instance of the object
		var plugin = this;

		// plugin.settings.propertyName from inside
		// element.data('jqCesta').settings.propertyName from outside
		plugin.settings = {}

		var $element = $(element), // reference to the jQuery version of DOM element
			 element = element;    // reference to the actual DOM element

		// the "constructor" method that gets called when the object is created
		plugin.init = function() {
			plugin.settings = $.extend({}, defaults, options);
			$("body").tooltip({
				selector: '#'+$element.attr('id')+' [data-toggle="tooltip.jqCesta"]',
				container: 'body',
			});
			$element.append([
				'<button type="button" class="hidden-md hidden-lg btn btn-default btn-menu-xs '+plugin.settings.linkCart.classBtn+' btnCart"></button>',
				'<div class="btn-group hidden-xs hidden-sm" role="group" aria-label="Pedido">',
					'<button type="button" class="btn btn-default '+plugin.settings.linkCart.classBtn+' btnCart"></button>',
					'<button type="button" class="btn btn-default btn-warning '+plugin.settings.linkCart.classBtn+' btnCheckOrder" data-toggle="tooltip.jqCesta" title="Comprar ahora"></button>',
				'</div>',
				'<div class="contentCart">',
					'<div class="totalCart">',
					'</div>',
					'<div class="itemsCart">',
					'</div>',
					'<div class="totalCart">',
					'</div>',
				'</div>',
			].join(''));
			renderButton();
			renderItems();
			renderTotal();
			setHandlers();
		}

		// public methods
		// plugin.methodName(arg1, arg2, ... argn) from inside
		// element.data('jqCesta').publicMethod(arg1, arg2, ... argn) from outside
		plugin.toggleCesta = function () {
			$contentCart=$('.contentCart',$element);
			if ($contentCart.hasClass('contentCartInside')) {
 				$contentCart.removeClass('contentCartInside');
				$contentCart.addClass('contentCartOutside');
			} else {
				if($('#navUserMenu').hasClass('nav-user-menu-inside')){
					/* cerramos menu usuario*/
					$('#navUserMenu').removeClass('nav-user-menu-inside');
					$('#navUserMenu').addClass('nav-user-menu-outside');
				}
 				$contentCart.addClass('contentCartInside');
				$contentCart.removeClass('contentCartOutside');
			}
		}

		plugin.addItem = function(src, ttl, unit, prc, id) {
			idxOfId=plugin.settings.arrItems.getIndexBy("id", id);
			if (typeof plugin.settings.arrItems[idxOfId] === 'undefined') {
				var objItem = new Object();
				objItem.id = id;
				objItem.imagen = src;
				objItem.descripcion = ttl;
				objItem.quantity = parseFloat(unit);
				objItem.precio = prc;
				objItem.timestamp = $.now();;
				plugin.settings.arrItems.push(objItem);
			} else {
				var objItem=plugin.settings.arrItems[idxOfId]
				objItem.quantity=parseFloat(objItem.quantity)+1;
			}
			renderItems();
			renderTotal();
			$element.trigger("afterAdd.jqCesta",[objItem]);
		}

		plugin.removeItem = function(id) {
			idxOfId=plugin.settings.arrItems.getIndexBy("id", id);
			if (typeof plugin.settings.arrItems[idxOfId] != 'undefined') {
				var objItem = new Object();
				objItem = plugin.settings.arrItems[idxOfId];
				plugin.settings.arrItems.splice(idxOfId, 1);
			}
			renderItems();
			renderTotal();
			$element.trigger("afterRemove.jqCesta",[objItem]);
		}

		plugin.editItem = function(id, quantity) {
			idxOfId=plugin.settings.arrItems.getIndexBy("id", id);
			var objItem = new Object();
			if (typeof plugin.settings.arrItems[idxOfId] != 'undefined') {
				plugin.settings.arrItems[idxOfId].quantity = parseFloat(quantity);
				objItem = plugin.settings.arrItems[idxOfId];
			}
			renderItems();
			renderTotal();
			$element.trigger("editItem.jqCesta",[objItem]);
		}

		// private methods
		// methodName(arg1, arg2, ... argn) from inside
		var orderItemsBy = function(propertyName) {
			plugin.settings.arrItems.sort(function(a,b) {return (a[propertyName] > b[propertyName]) ? 1 : ((b[propertyName] > a[propertyName]) ? -1 : 0);} );
		}

		var setHandlers = function () {
			//add handler
			$('body').on('click.jqCesta', '.'+plugin.settings.classBtnAdd, function(event) {
				$btn=$(this);
				var src=$btn.data('src');
				var ttl=$btn.data('ttl');
				var unit=$btn.data('unit');
				var prc=$btn.data('prc');
				var id=$btn.data('id');
				$element.data('jqCesta').addItem(src, ttl, unit, prc, id);
				event.preventDefault();
			});
			//remove handler
			$('body').on('click.jqCesta', '.'+plugin.settings.classBtnRemove, function(event) {
				$btn=$(this);
				var id=$btn.data('id');
				plugin.removeItem(id);
				event.preventDefault();
			});
			//spinbox
			/*$('body').on('changed.fu.spinbox', '.'+plugin.settings.classBtnSpinbox, function(event) {
			  	$spin=$(this);
			  	var id=$spin.closest('.itemCart').data('id');
				plugin.editItem(id, $spin.spinbox('getValue'));
			})*/
			$('body').on('change.jqCesta', '.'+plugin.settings.classBtnSpinbox, function(event) {
				$spin=$(this);
				var id=$(this).closest('.itemCart').data('id');
				plugin.editItem(id, $spin[0].value);
			});
			//btnCart handler
			$('.btnCart',$element).click(function(event) {
				plugin.toggleCesta();
			});
			//btnCheckOrder handler
			$('.btnCheckOrder',$element).click(function(event) {
				console.log("Comprar");
				$element.trigger("checkOrder.jqCesta",[$element.data('jqCesta').settings.arrItems]);
			});
		}

		var renderButton = function() {
			var ST_linkCart = plugin.settings.linkCart;

			//var imagen_html ='<img class="img-responsive" src="' + ST_linkCart.imgBtnCart + '" alt="">';
			//var symbol_html = (ST_linkCart.icoActiveBtnCart)?ico_html:imagen_html;
			var ico_html = '<i class="' + ST_linkCart.icoBtnCart + '"></i>';
			var ico_checkout= '<i class="' + ST_linkCart.icoBtnCheckout + '"></i>';
			var badgeQuantity_html = (ST_linkCart.badgeActiveQuantityBtnCart) ? '<span class="badge badgeCart">' + plugin.settings.arrItems.length + '</span>' : '';
			$('.btnCart',$element).html(ST_linkCart.txtBtnCart + ico_html + badgeQuantity_html);
			$('.btn-group button:last-child',$element).html(ico_checkout);
		}

		var renderItems = function () {
			var arr = plugin.settings.arrItems;
			var html_items='';
			if (arr.length==0) {
				html_items += emptyTemplate();
			} else {
				for (var i = 0; i < arr.length; i++) {
					html_items += itemTemplate(arr[i].id);
				}
			}
			//$('.badgeCart',element).html(plugin.settings.arrItems.length);
			$('.badgeCart',element).html(summarize('quantity'));
			$('.itemsCart',$element).html(html_items);
		}
		var emptyTemplate = function() {
			var cuerpoItem = [
				'<div class="col-lg-12">',
					'<div class="empty">',
						'Su pedido no contiene ningún producto',
					'</div>',
				'</div>',
				'<div class="col-lg-12 col-md-12 col-sm-12 separator-item">',
				'</div>'
			].join('');
			return cuerpoItem;
		}
		var itemTemplate = function(id) {
			var objItem=plugin.settings.arrItems[plugin.settings.arrItems.getIndexBy("id",id)];
			var id=objItem.id;
			var src=objItem.imagen;
			var ttl=objItem.descripcion;
			var unit=objItem.quantity;
			var prc=objItem.precio;
			var total = unit * prc;
			var spinbox=[
				'<input type="number" class="inputUnit ' + plugin.settings.classBtnSpinbox + '" min="' + plugin.settings.cart.valMinQuantity + '" max="' + plugin.settings.cart.valMaxQuantity + '" value="' + unit + '">',
			].join('');
			/*var spinbox=[
				'<div class="fuelux" style="display:inline-block">',
					'<div class="spinbox ' + plugin.settings.classBtnSpinbox + '" data-initialize="spinbox">',
						'<input type="text" class="form-control input-mini spinbox-input" value="' + unit + '">',
						'<div class="spinbox-buttons btn-group btn-group-vertical">',
							'<button type="button" class="btn btn-default spinbox-up btn-xs">',
								'<span class="glyphicon glyphicon-chevron-up"></span><span class="sr-only">Increase</span>',
							'</button>',
							'<button type="button" class="btn btn-default spinbox-down btn-xs" >',
								'<span class="glyphicon glyphicon-chevron-down"></span><span class="sr-only">Decrease</span>',
							'</button>',
						'</div>',
					'</div>',
				'</div>',
			].join('');*/

			var cuerpoItem = [
				'<div class="row itemCart" data-id="'+id+'">',
					'<div class="col-xs-4 col-sm-4 col-md-3">',
						'<img class="img-responsive" src="' + src + '" alt="">',
					'</div>',
					'<div class="col-xs-8 col-sm-8 col-md-9">',
						'<div class="col-xs-12 col-sm-12 col-md-12"><div class="ttl" data-toggle="tooltip.jqCesta" title="'+ ttl +'">' + ttl + '</div></div>',
						'<div class="col-xs-6 col-sm-6 col-md-6"><div class="unit" style="float:left">' + spinbox + '</div></div>',
						'<div class="col-xs-6 col-sm-6 col-md-6"><div class="price" ><span>' + parseFloat(total).toFixed(2) + '&euro;</span></div></div>',
						'<div class="col-xs-12 col-sm-12 col-md-12"><a class="btn ' + plugin.settings.classBtnRemove + '" data-id="' + id + '"><span class="glyphicon glyphicon-trash"></span>&nbsp;Quitar</a></div>',
					'</div>',
				'</div>',
				'<div class="col-lg-12 col-md-12 col-sm-12 separator-item"></div>',
			].join('');

			return cuerpoItem;
		}

		var summarize = function (field) {
			var sum = 0;
			for (var i = 0; i < plugin.settings.arrItems.length; i++) {
				switch(field){
					case 'precio' :
						sum = sum + ( parseFloat(plugin.settings.arrItems[i][field]) * parseFloat(plugin.settings.arrItems[i].quantity));
						break
					default :
						sum = sum + parseFloat(plugin.settings.arrItems[i][field]);
						break;
				}
			};
			return sum;
		}
		var renderTotal = function () {
			var arr = plugin.settings.arrItems;
			if (arr.length>0) {
				var udsCount=summarize('quantity');
				var total=summarize('precio');

				var total= [
						'<div class="info-total p-a-1 m-y-1">',
							'(<span class="quantity">' + udsCount + '</span>)&nbsp;Unidades',
							'<span class="pull-xs-right"><b>TOTAL: <span class="total">' + parseFloat(total).toFixed(2) + '</span>&nbsp;€</b></span>',
						'</div>',
				].join('');

				var btn= [
						'<a  class="btn btn-lg btn-block btn-comprar btnCheckOrder" type="button" href="javascript:void(null)"><b>' + plugin.settings.cart.txtBtnOrder + '</b></a>',
				].join('');

				var cuerpoFirst=[
					'<div class="col-lg-12">',
						btn,
						total,
					'</div>'
				].join('');
				var cuerpoSecond=[
					'<div class="col-lg-12">',
						total,
						btn,
					'</div>'
				].join('');

				$('.totalCart',$element).first().
					html(cuerpoFirst).
				end().eq(1).
					html(cuerpoSecond);
			} else {
				$('.totalCart',$element).html('');
			}
		}

		// call the "constructor" method
		plugin.init();
	}

	// add the plugin to the jQuery.fn object
	$.fn.jqCesta = function(options) {
		return this.each(function() {
			if (undefined == $(this).data('jqCesta')) {
				var plugin = new $.jqCesta(this, options);
				// element.data('jqCesta').publicMethod(arg1, arg2, ... argn)
				// element.data('jqCesta').settings.propertyName
				$(this).data('jqCesta', plugin);

			}
		});
	}
})(jQuery);