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
			data:  {
				maxResults    : '10',
				paths: {
					results   : 'data.arrResults',
					xtraInfo  : 'data',
				},
				ajax: {
					url       : '',//url para $.ajax
					data      : {},//data para $.ajax, será extendido con el parametro q
					path      : null,//donde encontrar los results dentro de la response ajax
				},
				cache : {
					type      : 'memory',//memory, localStorage, sessionStorage
					duration  : 60*60*24,//seconds
				}
			},
			input: {
				minQueryLen   : 3,
				loading:  {
					cssClasses: 'fa fa-spinner fa-spin fa-1x fa-fw',
					html      : '<i>',
				},
			},
			container: {
				appendTo      : 'body',
				cssClasses    : '',
				css           : {},
				template      : [].join(''),
				emptyTemplate : [].join(''),
			},
			item: {
				appendTo      : '*:not(:has("*"))',//append la coleccion de items a los elementos de la template de container que no tengan hijos
				cssClasses    : 'col-xs-12',
				css           : '',
				template      : '{{nombre}}<br />{{precio}}',
			},
		}

		// to avoid confusions, use "plugin" to reference the
		// current instance of the object
		var plugin = this;

		// element.data('ssSearch').settings.propertyName from outside the plugin,
		plugin.settings = {}

		var $element = $(element), // reference to the jQuery version of DOM element
			 element = element;    // reference to the actual DOM element

		// the "constructor" method that gets called when the object is created
		plugin.init = function() {
			plugin.settings = $.extend(true,{}, defaults, options);

			plugin.state=new Object
			plugin.state.currentQuery='';
			plugin.state.loading=false;
			plugin.state.offset=0;
			plugin.state.scrollTop=0;

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
			$element.on('input.ssSearch focus.ssSearch', function(event) {
				console.log('Evento recibido: '+event.type);
				sQuery=$.trim($element.val());
				if (plugin.state.currentQuery!=sQuery) {
					plugin.state.currentQuery=sQuery;
					plugin.state.offset=0;
					if (plugin.resultsContainer) {
						plugin.resultsContainer.scrollTop(0);
					}
				}
				var delay=(event.type=='focus')?50:300;
				if (typeof plugin.getResultsTimeout!='undefined') {clearTimeout(plugin.getResultsTimeout);}
				plugin.getResultsTimeout=setTimeout((function ($element,maxResults) {
					return function() {
						if (sQuery.length>=plugin.settings.input.minQueryLen) {
							getResults(sQuery,maxResults);
						}
					}
				})($(this),plugin.settings.data.maxResults),delay);
			});
			$(window).on('resize.ssSearch', function(event) {
				if (plugin.resultsContainer) {
					//closeContainer();
					positionContainer();
				}
			});
			$(plugin.settings.container.appendTo).on('click.ssSearch', function(event) {
				if (plugin.resultsContainer) {
					if (
						event.target!=element &&
						!$.contains(element,event.target) &&
						event.target!=plugin.resultsContainer &&
						!$.contains(plugin.resultsContainer[0],event.target)
					) {
						closeContainer();
					}
				}
			});
		}

		var getResults = function (sQuery,maxResults) {
			console.log('getResults sQuery: '+sQuery);
			console.log('getResults Offset: '+plugin.state.offset);
			var cacheObj=getCache(sQuery);

			var source;
			if (!Object.isObject(cacheObj)) {
				source='net';
				downloadResults(sQuery,maxResults);
			} else if (Object.isObject(cacheObj) && cacheObj.offset>=plugin.state.offset) {
				source='cache';
				console.log('getResults cacheObj.offset: '+cacheObj.offset);
				console.log('getResults plugin.resultsContainer: ');
				console.log(plugin.resultsContainer);
				renderContainer(sQuery,null);
			} else {
				source='merge';
				downloadResults(sQuery,maxResults);
			}
			console.log('getResults Source: '+source);
		}

		var downloadResults= function (sQuery,maxResults) {
			var limit=plugin.state.offset+','+maxResults;
			if (!plugin.state.loading) {
				startLoading();
			}
			var ajaxData=$.extend(true,{}, plugin.settings.data.ajax.data, {'q': sQuery, 'limit':limit});
			var $promise=$.ajax({
				url: plugin.settings.data.ajax.url,
				type: 'POST',
				dataType: 'json',
				data: ajaxData,
			})
			.done(function(data, textStatus, jqXHR) {
				var cacheObj=getCache(sQuery);
				if (Object.isObject(cacheObj)) {
					//merge
					var newResults=Object.byString(data,plugin.settings.data.paths.results)
					cacheObj.timestamp=(new Date).getTime();
					cacheObj.arrResults=$.merge(
						cacheObj.arrResults,
						newResults);
					cacheObj.xtraInfo=Object.byString(data,plugin.settings.data.paths.xtraInfo);
					cacheObj.offset=plugin.state.offset;
					setCache(sQuery,cacheObj);
					renderContainer(sQuery,newResults);
				} else {
					cacheObj=new Object;
					cacheObj.timestamp=(new Date).getTime();
					cacheObj.arrResults=Object.byString(data,plugin.settings.data.paths.results);
					cacheObj.xtraInfo=Object.byString(data,plugin.settings.data.paths.xtraInfo);
					cacheObj.offset=plugin.state.offset;
					setCache(sQuery,cacheObj);
					renderContainer(sQuery,null);
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				//console.log("error");
			})
			.always(function(dataOrJqXHR, textStatus, jqXHROrErrorThrown) {
				stopLoading();
			});
			//.then(doneCallbacks, failCallbacks)
			return $promise;
		}

		var getCsscontainer = function() {

			var cssContainer=$.extend(true,{},
			{
				'display'    : 'none',
			},
			plugin.settings.container.css);
			return cssContainer;
		}

		var positionContainer = function () {
			var elementWidthModifier=38;
			var offset=new Object;
			var size=new Object;
			var $measuredElement=$element;
			offset.left = $measuredElement.offset().left-$(window).scrollLeft();
			offset.top  = $measuredElement.offset().top-$(window).scrollTop();
			size.width  = $measuredElement.outerWidth() + elementWidthModifier;
			size.height = $measuredElement.outerHeight();

			var positionRespectElement=true;
			var positionRespectWindow=false;
			if (positionRespectElement) {
				var widthModifier=70;
				var left  = offset.left-(offset.left*widthModifier/100);//Math.floor($(window).width()*0.2);
				var right = 'auto';
				var width = size.width+(2*size.width*widthModifier/100);
			}
			if (left+width>$(window).width()) {
				positionRespectWindow=true;
			}
			if (positionRespectWindow) {
				var left  = Math.floor($(window).width()*0.05);
				var right = Math.floor($(window).width()*0.05);
				var width = 'auto';
			}

			var top    = offset.top+size.height;//Math.floor($(window).height()*0.2);
			var bottom = Math.floor($(window).height()*0.05);

			var cssPosition={
				'position'   : 'absolute',
				'z-index'    : 9999999,
				'overflow'   : 'auto',
				//'outline'  : 'solid black 3px',
				'left'       : left,
				'top'        : top,
				'width'      : width,
				'right'      : right,
				'bottom'     : bottom,
			}

			plugin.resultsContainer.css(cssPosition);
		}

		var renderContainer = function (sQuery,arrResultsToAppend) {
			var arrResults=[];
			if (arrResultsToAppend) {
				arrResults=arrResultsToAppend;
				console.log('renderContainer append arrResults.length: '+arrResults.length);
			} else {
				closeContainer();
				var cacheObj=getCache(sQuery);
				if (cacheObj) {
					arrResults=cacheObj.arrResults;
					//plugin.state.offset=arrResults.length;
				}
				console.log('renderContainer cache arrResults.length: '+arrResults.length);
			}

			var cssContainer=getCsscontainer();
			console.log('renderContainer plugin.resultsContainer: ');
			console.log(plugin.resultsContainer);
			if (!plugin.resultsContainer) {
				if (arrResults.length==0) {
					cssContainer.bottom='auto';
					var htmlEmpty=plugin.settings.container.emptyTemplate.replace('{{sQuery}}',sQuery);
					plugin.resultsContainer=$('<div>')
					.css(cssContainer)
					.addClass('ssSearchContainer empty')
					.addClass(plugin.settings.container.cssClasses)
					.html(htmlEmpty);
					positionContainer();
				} else {
					plugin.resultsContainer=$('<div>')
					.css(cssContainer)
					.addClass('ssSearchContainer')
					.addClass(plugin.settings.container.cssClasses)
					.html(plugin.settings.container.template);
					positionContainer();
				}

				plugin.resultsContainer.appendTo(plugin.settings.container.appendTo);
				plugin.state.itemAppendTo=$(plugin.settings.item.appendTo,'.ssSearchContainer');//Nos guardamos el nodo sobre el que tenemos que hacer append de los items, para asegurarnos de que no cambia en futuros appends

				plugin.resultsContainer.on('scroll', function(event) {
					$scrollante=$(this);
					plugin.state.scrollTop=$scrollante.scrollTop();
					if($scrollante.scrollTop() + $scrollante.innerHeight() == $scrollante[0].scrollHeight) {
						getResults(plugin.state.currentQuery,plugin.settings.data.maxResults);
					}
				});
			}

			appendResults(sQuery,arrResults);
			if (!arrResultsToAppend) {
				plugin.resultsContainer.fadeIn('400', function() {});
			}
		}

		var appendResults = function(sQuery,arrResults) {
			var collection=[];
			for (var i = 0; i < arrResults.length; i++) {
				var item=arrResults[i];
				$item=renderItem(item);
				collection.push($item);
			}
			plugin.resultsContainer.find(plugin.state.itemAppendTo).append(collection);
			plugin.state.offset+=arrResults.length;
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

		var closeContainer = function() {
			if (plugin.resultsContainer) {
				plugin.resultsContainer.fadeOut('400', function() {
					$(this).remove();
				});
				plugin.resultsContainer=null;
			}
			plugin.state.offset=0;
		}

		/** CACHE ***************************************************************/
		var initCache = function () {
			var storage=typeof(Storage) !== "undefined";
			if (storage && plugin.settings.data.cache.type!='memory') {
				if (plugin.settings.data.cache.type=='sessionStorage') {
					plugin.state.cache=window.sessionStorage;
				} else {
					plugin.state.cache=window.localStorage;
				}
			} else {
				// No hay soporte para Web Storage, fallback to memory
				plugin.settings.data.cache.type='memory';
				plugin.state.cache={
					items: {},
					setItem: function (name,value) {
						this.items[name]=value;
					},
					getItem: function (name) {
						return this.items[name];
					},
					removeItem: function  (name) {
						delete items[name];
					}
				};
			}
		}
		var getCache = function (sQuery) {
			var cacheItem=plugin.state.cache.getItem(btoa(sQuery));
			if (cacheItem) {
				var cacheObj=JSON.parse(cacheItem);
				if ((new Date).getTime() - cacheObj.timestamp<plugin.settings.data.cache.duration*1000) {
					return cacheObj;
				} else {
					return null;
				}
			} else {
				return null;
			}
		}
		var setCache = function (sQuery,cacheItem) {
			plugin.state.cache.setItem(btoa(sQuery),JSON.stringify(cacheItem));
		}

		/* LOADING ************************************************************/
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
			//console.log(elementMeasures);
			//console.log(loadingMeasures);
			//console.log(left);
			//console.log(top);
			$loading.css({
				'left':left+'px',
				'top':top+'px',
			}).show();
		}
		var stopLoading = function () {
			if (plugin.state.loading) {
				plugin.state.loading.fadeOut('slow', function() {
					$(this).remove();
				});
			}
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
