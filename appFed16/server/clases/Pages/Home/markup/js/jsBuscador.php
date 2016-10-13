<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {

	$('#ssSearch').ssSearch({
		data: {
			limit: '0,25',
			ajax: {
				url: '<?=BASE_URL.FILE_APP?>',
				data: {
					'MODULE':'actions',
					'acClase':'Home',
					'acMetodo':'acSearchOfers',
					'acTipo':'ajax',
				},
				paths:{
					results: 'data.arrResults',
					xtraInfo: 'data',
				}
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
			cssClasses:'col-xs-12 col-md-6',
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
});