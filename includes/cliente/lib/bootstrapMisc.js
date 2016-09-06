//Biblioteca de pequeños plugins y funciones globales

function muestraMsgModalBootstrap3(title, msg) {
	var $div=$([
		'<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">',
		'	<div class="modal-dialog">',
		'		<div class="modal-content">',
		'			<div class="modal-header">',
		'				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>',
		'				<h4 class="modal-title">'+title+'</h4>',
		'			</div>',
		'			<div class="modal-body">'+msg+'</div>',
		'			<div class="modal-footer">',
		'				<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>',
		'			</div>',
		'		</div>',
		'	</div>',
		'</div>'
	].join(''));

	$('body').append($div);
	$div.modal({
		backdrop:'static'
	});
}

//Bootstrap overlay.
/* History
/* v 1.0 (20160829)
/* Version inicial creada a partir de $.overlay
*/
;(function($) {
	var methods = {
		init: function(settings) {
			var self=this;//Al estar en $.overlay, this es una funcion

			self.opt = $.extend(true, {}, $.overlay.defaults, settings);
			var $db=$(self.opt.selectorAppendTo);

			var $overlay=$('<div/>').css({'z-index':'9999998'});
			var $divTable=$('<div/>').addClass(self.opt.div.class).css(self.opt.div.css);
			var $divCell=$('<div/>').css ({
				display:'table-cell','vertical-align':'middle','text-align':'center'}).appendTo($divTable);
			/*
			var $img=$('<img>')
				.attr({
					src:self.opt.img.src,
					alt:self.opt.img.alt
				})
				.css (self.opt.img.css)
				.addClass(self.opt.img.class)
				.appendTo($divCell);
			*/
			var $progress=$([
			'<div style="width:25%; margin:auto;">',
			'	<div class="progress">',
			'		<div class="progress-bar progress-bar-striped active '+self.opt.progress.class+'" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">',
			'			<span class="sr-only">100%</span>',
			'		</div>',
			'	</div>',
			'</div>',
			].join('')).appendTo($divCell);;

			$divTable.appendTo($overlay);
			$overlay.appendTo($db);
			$db.data('overlay', {
				settings:self.opt,
				$overlay:$overlay,
				$divTable:$divTable
			});
		},
		destroy:function() {
			var self=this;//Al estar en $.overlay, this es una funcion
			var $db=$(self.opt.selectorAppendTo);
			if ($db.data('overlay')) {
				$db.data('overlay').$overlay.remove();
				$db.data('overlay').$divTable.remove();
				$db.removeData('overlay');
			}
		}
	};

	$.overlay=function(method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist!');
		}
	};

	$.overlay.defaults = {
		div: {
			class:'',
			css: {
				'position':'fixed','text-align':'center','display':'table',
				'top':'0','left':'0','bottom':'0','right':'0',
				'width':'100%','height':'100%','z-index':'9999999',
				'background-color':'rgba(0,0,0,0.73)',
			},
		},
		progress: {
			class: '',
		},
		selectorAppendTo:'body'
	};
})(jQuery);
//
