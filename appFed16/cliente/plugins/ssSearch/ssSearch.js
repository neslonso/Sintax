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
			data: {
				limit: '0,25',
				paths:{
					results: 'data.arrResults',
					xtraInfo: 'data',
				},
				ajax: {
					url: '',//url para $.ajax
					data: {},//data para $.ajax, será extendido con el parametro q
					path: null,//donde encontrar los results dentro de la response ajax
				},
			},
			input: {
				loading: {
					cssClasses:'fa fa-spinner fa-spin fa-1x fa-fw',
					html: '<i>',
				},
				minQueryLen: 3,
			},
			container: {
				appendTo: 'body',
				cssClasses: '',
				css: {},
				template: [
				].join(''),
				emptyTemplate:[
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
			plugin.settings = $.extend(true,{}, defaults, options);

			plugin.state=new Object
			plugin.state.loading=false;

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
						if (sQuery.length>=plugin.settings.input.minQueryLen) {
							getResults(sQuery,limit);
						}
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
			var cacheObj=getCache(sQuery);
			if (Object.isObject(cacheObj)) {
				console.log ('ACIERTO DE CACHE ssSearch')
				renderResults(sQuery);
			} else {
				if (!plugin.state.loading) {
					startLoading();
				}
				var ajaxData=$.extend(true,{}, plugin.settings.data.ajax.data, {'q': sQuery});
				$.ajax({
					url: plugin.settings.data.ajax.url,
					type: 'POST',
					dataType: 'json',
					data: ajaxData,
				})
				.done(function(data, textStatus, jqXHR) {
					var cacheObj=new Object;
					cacheObj.arrResults=Object.byString(data,plugin.settings.data.ajax.paths.results);
					cacheObj.xtraInfo=Object.byString(data,plugin.settings.data.ajax.paths.xtraInfo);

					setCache(sQuery,cacheObj);
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
			var arrResults=getCache(sQuery).arrResults;//A la hora de render ya están en cache los resultado, se hayan tenido que consultar o no
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
					itemHtml=itemHtml.replace(new RegExp(token,'g'),value);
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
			plugin.state.cache=[];
		}
		var getCache = function (sQuery) {
			return plugin.state.cache[sQuery];
		}
		var setCache = function (sQuery,arrResults) {
			plugin.state.cache[sQuery]=arrResults;
		}

		var startLoading = function () {
			plugin.state.loading=$loading=$(plugin.settings.input.loading.html).first().addClass(plugin.settings.input.loading.cssClasses)
			.css({
				'position' : 'absolute',
				'z-index'  : '9999999999999',
				'display'  : 'none',
			})
			.appendTo($element.parent());
			var elementMeasures=new Object;
			elementMeasures.left = $element.position().left//-$(window).scrollLeft();
			elementMeasures.top  = $element.position().top//-$(window).scrollTop();
			elementMeasures.width  = $element.outerWidth();
			elementMeasures.height = $element.outerHeight();

			$loading.show();
			var loadingMeasures=new Object;
			loadingMeasures.width  = $loading.outerWidth();
			loadingMeasures.height = $loading.outerHeight();
			$loading.hide();

			var left = elementMeasures.left + elementMeasures.width - (loadingMeasures.width * 1.30)
			var top = elementMeasures.top + (elementMeasures.height/2) - (loadingMeasures.height/2)
console.log(elementMeasures);
console.log(loadingMeasures);
console.log(left);
console.log(top);
			$loading.css({
				'left':left+'px',
				'top':top+'px',
			}).show();
		}
		var stopLoading = function () {
			plugin.state.loading.fadeOut('slow', function() {
				$(this).remove();
			});
			plugin.state.loading=false;
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
