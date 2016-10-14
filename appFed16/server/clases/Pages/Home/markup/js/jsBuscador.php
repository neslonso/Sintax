<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {

	$('#ssSearch').ssSearch({
		data: {
			maxResults: '12',
			ajax: {
				url: '<?=BASE_URL.FILE_APP?>',
				data: {
					'MODULE':'actions',
					'acClase':'Home',
					'acMetodo':'acSearchOfers',
					'acTipo':'ajax',
				},
			},
			cache: {
				type: 'memory',//memory, localStorage, sessionStorage
				duration  : 60,//seconds
			},
			paths:{
				results: 'data.arrResults',
				xtraInfo: 'data',
			},

		},
		input: {
			loading: {
				cssClasses: 'fa fa-spinner fa-ssSearch-spin fa-1x fa-fw'
			},
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
			cssClasses:'col-xs-12 col-sm-6 col-md-4',
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
							'{{btnComprar}}',
						'</div>',
					'</div>',
				'</div>',
			].join(''),
		}
	});

	$('#ssSearch').keypress(function(event) {
		if (event.which==13) {
			var query=$.trim($(this).val()).toLowerCase();
			//url=seoUrl('<?=BASE_URL?>busqueda/'+query);
			url=seoUrl('<?=BASE_URL?>'+query+'/busqueda/');
			window.location.href=url;
		}
	});

	function seoUrl(url) {
		url=url.replace(new RegExp(/[\s-]+/,'g'),' ');
		url=url.replace(new RegExp(/[\s_]/,'g'),'-');
		return url;
	}
});