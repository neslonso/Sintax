//jQuery plugin jqNotifications
/* History
/**
 * History
 * 0.1 (20160916)
 * Template sin funcionalidad, basada en http://stefangabos.ro/jquery/jquery-plugin-boilerplate-revisited/
 * Uso:
 * $(document).ready(function() {
 *
 *    // attach the plugin to an element
 *    $('#element').jqNotifications({'foo': 'bar'});
 *
 *    // call a public method
 *    $('#element').data('jqNotifications').foo_public_method();
 *
 *    // get the value of a property
 *    $('#element').data('jqNotifications').settings.foo;
 *
 * });
 */

// El punto y coma es por si acaso algo que no esté bien cerrado se concatena con este fichero
// Window y document se pasan para convertirlas en varialbes locales y que el acceso sea un poco mas rápido
// undefined no se pasa para que sea de verdad undefined, por si acaso algo lo ha modificado (en ECMAScript
// 3 es posible modificar el valor de undefined, en ECMAScript 5 ya no).
(function($) {
	$.jqNotifications = function(element, options) {
		// plugin's default options
		// this is private property and is  accessible only from inside the plugin
		var defaults = {
			foo: 'bar',

			notification: {
				add: {
					icoClass: "fa fa-cart-plus",
					icoClose: "fa fa-times",
					icoClassExt : "icoClassExt",
					icoCloseExt : "icoCloseExt",
					color : "green",/*green, red, blue, yellow, white*/
					lifeTime: 4000,
				},
				del: {
					icoClass: "fa fa-remove",
					icoClose: "fa fa-times",
					icoClassExt : "icoClassExt",
					icoCloseExt : "icoCloseExt",
					color : "red",/*green, red, blue, yellow, white*/
					lifeTime: 4000,
				},
				other: {
					icoClass: "fa fa-info",
					icoClose: "fa fa-times",
					icoClassExt : "icoClassExt",
					icoCloseExt : "icoCloseExt",
					color : "yellow",/*green, red, blue, yellow, white*/
					lifeTime: 4000,
				}
			},
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
		// element.data('jqNotifications').settings.propertyName from outside the plugin,
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
			console.log("Init plugin jQueryNotificactions");
			//$('#divJqNotifications').html('Hola plugin').appendTo(element);
			plugin.addNotification("Prueba", "Esto es una prueba <span class='articleName'><b> Belmil </b></span>", 'add');
			setTimeout(function() {
        		plugin.addNotification("Prueba 2", "Esto es una prueba <span class='articleName'><b> Belmil </b></span>", 'del');
			}, 3000);

			/*por defecto*/



		}

		// public methods
		// these methods can be called like:
		// plugin.methodName(arg1, arg2, ... argn) from inside the plugin or
		// element.data('jqNotifications').publicMethod(arg1, arg2, ... argn) from outside
		// the plugin, where "element" is the element the plugin is attached to;

		// a public method. for demonstration purposes only - remove it!
		plugin.foo_public_method = function() {
			// code goes here
		}

		plugin.addNotification = function (ttl, txt, tipo){
			var ST_notification = configurationByKind(tipo);

			$cuerpo_notf = render(ttl, txt, tipo);
			$element.append($cuerpo_notf);
			registerRemoveNotification($cuerpo_notf, ST_notification.lifeTime);

			$('.closeNotification',$element).click(function(event) {
				$(this).parent().parent().removeClass('fadeInRight').addClass('fadeOutRight').delay(100).hide(400, function () {
                    $(this).remove();
                });
			});
		}


		// private methods
		var render = function(ttl, txt, tipo){
			//var ST_notification = plugin.settings.notification;
 			var ST_notification = configurationByKind(tipo);
 			var _txt = txt;

			//var cuerpo = "<div class='row mensaje verde basket animated fadeInRight' ><div class='col-xs-4 icon-holder'><i class=' " + ST_notification.icoClass + " " + ST_notification.icoClassExt + " '></i></div><div class='col-xs-7 m-y-1'><p class='h5'><b>" + ttl + "</b></p><p>" + txt + "</p></div><div class='col-xs-1 closeMensajeLateral'><i class='notification-icon " + ST_notification.icoClose + " " + ST_notification.icoCloseExt + " closeNotification'></i></div></div>";
			var cuerpo = [
				"<div class='row message basket animated " + ST_notification.color + "'>",
					"<div class='col-xs-4 icon-holder'>",
						"<i class=' notification-icon " + ST_notification.icoClass + " " + ST_notification.icoClassExt + " '></i>",
					"</div>",
					"<div class='col-xs-7 m-y-1'>",
						"<p class='h5'><b>" + ttl + "</b></p><p>" + _txt + "</p>",
					"</div>",
					"<div class='col-xs-1 closeSideMessage'>",
						"<i class='notification-icon " + ST_notification.icoClose + " " + ST_notification.icoCloseExt + " closeNotification'></i>",
					"</div>",
				"</div>"
			].join('');
			var $cuerpo=$(cuerpo);

			return $cuerpo;
		}

		var configurationByKind = function (kindNotification){
			var conf;
			var ST_notifications = plugin.settings.notification;
			if(kindNotification in ST_notifications){
				conf = (ST_notifications.hasOwnProperty(kindNotification)) ? ST_notifications[kindNotification] :  ST_notifications.other;
			}else{
				conf = ST_notifications.other;
			}
			return conf;
		}

		var registerRemoveNotification = function ($obj, lft){
			setTimeout(function() {
				$obj.removeClass('fadeInRight').addClass('fadeOutRight').delay(100).hide(400, function () {
					$obj.remove();
				});
			}, lft);

		}
		// call the "constructor" method
		plugin.init();
	}

	// add the plugin to the jQuery.fn object
	$.fn.jqNotifications = function(options) {
		// iterate through the DOM elements we are attaching the plugin to
		return this.each(function() {
			// if plugin has not already been attached to the element
			if (undefined == $(this).data('jqNotifications')) {
				// create a new instance of the plugin
				// pass the DOM element and the user-provided options as arguments
				var plugin = new $.jqNotifications(this, options);
				// in the jQuery version of the element
				// store a reference to the plugin object
				// you can later access the plugin and its methods and properties like
				// element.data('jqNotifications').publicMethod(arg1, arg2, ... argn) or
				// element.data('jqNotifications').settings.propertyName
				$(this).data('jqNotifications', plugin);
			}
		});
	}
})(jQuery);

