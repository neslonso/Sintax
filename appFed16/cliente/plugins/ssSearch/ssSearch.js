//jQuery plugin ssSearch
/* History
/**
 * History
 * 0.1 (20161009)
 * Template sin funcionalidad, basada en http://stefangabos.ro/jquery/jquery-plugin-boilerplate-revisited/
 * Uso:
 * $(document).ready(function() {
 *
 *    // attach the plugin to an element
 *    $('#element').ssSearch({'foo': 'bar'});
 *
 *    // call a public method
 *    $('#element').data('ssSearch').foo_public_method();
 *
 *    // get the value of a property
 *    $('#element').data('ssSearch').settings.foo;
 *
 * });
 */

(function($) {
	$.ssSearch = function(element, options) {
		// plugin's default options
		// this is private property and is  accessible only from inside the plugin
		var defaults = {
			limit: 25,
			itemTemplate: '',
			ajax: {
				url: '',//url para $.ajax
				data: {},//data para $.ajax, será extendido con el parametro q
				path: null,//donde encontrar los results dentro de la response ajax
			},
			input: {
				loading: {
					cssClasses:'fa fa-spinner fa-spin fa-3x fa-fw',
					text: 'Buscando...',
				}
			},
			container: {
				appendTo: 'body',
				cssClasses: '',
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
				appendTo: '*:not(:has("*"))',//append la coleccion de items a los elementos de la template de container que no tengan hijos
				cssClasses:'col-xs-12',
				css:'',
				template:'{{nombre}}<br />{{precio}}',
			},
		}

		// to avoid confusions, use "plugin" to reference the
		// current instance of the object
		var plugin = this;

		// this will hold the merged default, and user-provided options
		// plugin's properties will be available through this object like:
		// plugin.settings.propertyName from inside the plugin or
		// element.data('ssSearch').settings.propertyName from outside the plugin,
		// where "element" is the element the plugin is attached to;
		plugin.settings = {}

		var $element = $(element), // reference to the jQuery version of DOM element
			 element = element;    // reference to the actual DOM element

		// the "constructor" method that gets called when the object is created
		plugin.init = function() {
			// the plugin's final properties are the merged default and
			// user-provided options (if any)
			plugin.settings = $.extend(true,{}, defaults, options);
			// code goes here
			initCache();
			setHandlers();
		}

		// public methods
		// these methods can be called like:
		// plugin.methodName(arg1, arg2, ... argn) from inside the plugin or
		// element.data('ssSearch').publicMethod(arg1, arg2, ... argn) from outside
		// the plugin, where "element" is the element the plugin is attached to;

		// a public method. for demonstration purposes only - remove it!
		plugin.foo_public_method = function() {
			// code goes here
		}

		// private methods
		// these methods can be called only from inside the plugin like:
		// methodName(arg1, arg2, ... argn)

		var setHandlers = function () {
			//add handler
			$element.on('input.ssSearch', function(event) {
				if (typeof plugin.getResultsTimeout!='undefined') {clearTimeout(plugin.getResultsTimeout);}
				plugin.getResultsTimeout=setTimeout((function ($element,limit) {
					return function() {
						sQuery=$.trim($element.val());
						getResults(sQuery,limit);
					}
				})($(this),plugin.settings.limit),300);
			});
			$(window).on('resize.ssSearch', function(event) {
				if (plugin.resultsContainer) {plugin.resultsContainer.remove();}
			});
			$(plugin.settings.container.appendTo).on('click.ssSearch', function(event) {
				if (plugin.resultsContainer) {
					if (event.target!=plugin.resultsContainer && !$.contains(plugin.resultsContainer[0],event.target) ) {
						plugin.resultsContainer.remove();
					}
				}
			});
		}

		var getResults = function (sQuery,limit) {
			startLoading();
			var cacheQuery=getCache(sQuery);
			if (Array.isArray(cacheQuery)) {
				console.log ('ACIERTO DE CACHE ssSearch')
				renderResults(sQuery);
			} else {
				var ajaxData=$.extend(true,{}, plugin.settings.ajax.data, {'q': sQuery});
				$.ajax({
					url: plugin.settings.ajax.url,
					type: 'POST',
					dataType: 'json',
					data: ajaxData,
				})
				.done(function(data, textStatus, jqXHR) {
					var arrResults;
					if (Array.isArray(data[plugin.settings.ajax.path])) {
						arrResults=data[plugin.settings.ajax.path];
					} else {
						arrResults=data;
					}
					setCache(sQuery,arrResults);
					renderResults(sQuery);
					console.log("success");
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					console.log("error");
				})
				.always(function(dataOrJqXHR, textStatus, jqXHROrErrorThrown) {
					stopLoading();
					console.log("complete");
				});
				//.then(doneCallbacks, failCallbacks)
			}
		}

		var renderResults = function (sQuery) {
			var arrResults=getCache(sQuery);//A la hora de render ya están en cache los resultado, se hayan tenido que consultar o no
			var offset=new Object;
			var size=new Object;
			var $measuredElement=$element;
			offset.left = $measuredElement.offset().left-$(window).scrollLeft();
			offset.top  = $measuredElement.offset().top-$(window).scrollTop();
			size.width  = $measuredElement.outerWidth();
			size.height = $measuredElement.outerHeight();

			var widthModifier=33;
			var left   = offset.left-(offset.left*widthModifier/100);//Math.floor($(window).width()*0.2);
			var top    = offset.top+size.height;//Math.floor($(window).height()*0.2);
			//var right  = offset.left+size.width;//Math.floor($(window).width()*0.2);
			var width  = size.width+(2*size.width*widthModifier/100);
			var bottom = Math.floor($(window).height()*0.2);

			var cssContainer=$.extend(true,{},
			{
				'display'    : 'block',
				'position'   : 'fixed',
				'z-index'    : 9999999,
				'overflow'   : 'auto',
				//'outline'  : 'solid black 3px',
				'left'       : left,
				'top'        : top,
				'width'      : width,
				//'right'      : right,
				'bottom'     : bottom,
			},
			plugin.settings.container.css);

			if (plugin.resultsContainer) {
				plugin.resultsContainer.remove();
			}

			if (arrResults.length==0) {
				cssContainer.bottom='auto';
				var htmlEmpty=plugin.settings.container.emptyTemplate.replace('{{sQuery}}',sQuery);
				plugin.resultsContainer=$('<div>')
				.css(cssContainer)
				.addClass('ssSearchContainer empty')
				.addClass(plugin.settings.container.cssClasses)
				.html(htmlEmpty);
			} else {
				plugin.resultsContainer=$('<div>')
				.css(cssContainer)
				.addClass('ssSearchContainer')
				.addClass(plugin.settings.container.cssClasses)
				.html(plugin.settings.container.template);

				var collection=[];
				for (var i = 0; i < arrResults.length; i++) {
					var item=arrResults[i];
					$item=renderItem(item);
					collection.push($item);
				}
				plugin.resultsContainer.find(plugin.settings.item.appendTo).append(collection);
			}

			plugin.resultsContainer.appendTo(plugin.settings.container.appendTo);
		}

		var renderItem = function (item) {
			var itemHtml=plugin.settings.item.template;
			for (var property in item) {
				if (item.hasOwnProperty(property)) {
					var value=item[property];
					var token='{{'+property+'}}';
					//itemHtml=itemHtml.replace(token,value);
					itemHtml=itemHtml.replace(new RegExp(token,'g'),value);
					//console.log(token+' reemplazado por '+value+' en '+itemHtml);
				}
			}

			var cssItem=$.extend(true,{},
			{
			},
			plugin.settings.container.css);

			var $item=$('<div>')
			.css(cssItem)
			.addClass('ssSearchItemContainer')
			.addClass(plugin.settings.item.cssClasses)
			.html(itemHtml);
			return $item;
		}

		var initCache = function () {
			if (typeof(Storage) !== "undefined") {
				// Code for localStorage/sessionStorage.
			} else {
				// Sorry! No Web Storage support..
			}
			plugin.cache=[];
		}
		var getCache = function (sQuery) {
			return plugin.cache[sQuery];
		}
		var setCache = function (sQuery,arrResults) {
			plugin.cache[sQuery]=arrResults;
		}

		var startLoading = function () {

		}
		var stopLoading = function () {

		}
		// call the "constructor" method
		plugin.init();
	}

	// add the plugin to the jQuery.fn object
	$.fn.ssSearch = function(options) {
		// iterate through the DOM elements we are attaching the plugin to
		return this.each(function() {
			// if plugin has not already been attached to the element
			if (undefined == $(this).data('ssSearch')) {
				// create a new instance of the plugin
				// pass the DOM element and the user-provided options as arguments
				var plugin = new $.ssSearch(this, options);
				// in the jQuery version of the element
				// store a reference to the plugin object
				// you can later access the plugin and its methods and properties like
				// element.data('ssSearch').publicMethod(arg1, arg2, ... argn) or
				// element.data('ssSearch').settings.propertyName
				$(this).data('ssSearch', plugin);
			}
		});
	}
})(jQuery);
