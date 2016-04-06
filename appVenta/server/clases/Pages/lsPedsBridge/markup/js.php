<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	var $multi_pedidoTable=$("#multi_pedidoTable");
	$multi_pedidoTable.DBdataTable({
		"sDom":"<'H'lfr>t<'F'ip>",
		"aoColumns": [
			{"sTitle": "id","mData":"id", "sClass":"id hiddenCol", "bVisible": false, "bSearchable": false, "sWidth":"4%", "bSortable": true},
			{"sTitle": "insert","mData":"insert", "sClass":"insert datetimeCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="" && data!="0000-00-00" && data!="0000-00-00 00:00:00") return Date.fromMysql(data).toStringES(true);
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "update","mData":"update", "sClass":"update datetimeCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="" && data!="0000-00-00" && data!="0000-00-00 00:00:00") return Date.fromMysql(data).toStringES(true);
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "numero","mData":"numero", "sClass":"numero textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "expedicion","mData":"expedicion", "sClass":"expedicion textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "serie","mData":"serie", "sClass":"serie textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "nombre","mData":"nombre", "sClass":"nombre textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "apellidos","mData":"apellidos", "sClass":"apellidos textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "direccion","mData":"direccion", "sClass":"direccion textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "cp","mData":"cp", "sClass":"cp textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "poblacion","mData":"poblacion", "sClass":"poblacion textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "provincia","mData":"provincia", "sClass":"provincia textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "horario","mData":"horario", "sClass":"horario textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "portes","mData":"portes", "sClass":"portes textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "credito","mData":"credito", "sClass":"credito textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "notas","mData":"notas", "sClass":"notas textareaCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true},
			{"sTitle": "incluidoEnNotificacionTransporte","mData":"incluidoEnNotificacionTransporte", "sClass":"incluidoEnNotificacionTransporte checkboxCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data==1) return '<span class="glyphicon glyphicon-ok"></span>';
					else return '<span class="glyphicon glyphicon-remove"></span>';
			}},
			{"sTitle": "albaranGenerado","mData":"albaranGenerado", "sClass":"albaranGenerado checkboxCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data==1) return '<span class="glyphicon glyphicon-ok"></span>';
					else return '<span class="glyphicon glyphicon-remove"></span>';
			}},
			{"sTitle": "bultos","mData":"bultos", "sClass":"bultos textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "factura","mData":"factura", "sClass":"factura checkboxCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data==1) return '<span class="glyphicon glyphicon-ok"></span>';
					else return '<span class="glyphicon glyphicon-remove"></span>';
			}},
			{"sTitle": "idUsuario","mData":"idUsuario", "sClass":"idUsuario textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "idCupon","mData":"idCupon", "sClass":"idCupon textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "idPedidoModoPago","mData":"idPedidoModoPago", "sClass":"idPedidoModoPago dbSelectCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true},
			{"sTitle": "idTransporte","mData":"idTransporte", "sClass":"idTransporte dbSelectCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true},
			{"sTitle": "keyTienda","mData":"keyTienda", "sClass":"keyTienda dbSelectCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true},
			{"sTitle": "idEnOrigen","mData":"idEnOrigen", "sClass":"idEnOrigen textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{ "sTitle": "Seleccionar", "mData":"id", "sClass":"seleccionar", "sWidth":"5%", "bSortable": false,
				"mRender":function (data,type,full) {
					var disabled="";
					if (full.borrable==0) {
						var disabled='disabled="disabled"';
					}
					return '<input class="chkSeleccionar" type="checkbox" name="selected['+full.id+']" value="1" '+disabled+' />'
			}}
		],
		"aaSorting":[[4,"desc"]],
		"sAjaxSource": "<?=BASE_DIR.FILE_APP?>",
		"fnServerParams": function ( aoData ) {
			aoData.push({"name":"MODULE", "value":"actions"});
			aoData.push({"name":"acClase","value":"lsPedsBridge"});
			aoData.push({"name":"acMetodo","value":"acDataTables"});
			aoData.push({"name":"acTipo","value":"ajaxAssoc"});
			aoData.push({"name":"clase","value":"Multi_pedido"});
			aoData.push({"name":"metodo","value":"ls"});
		},
		"fnDrawCallback": function( oSettings ) {
			$(".chkSeleccionar",$multi_pedidoTable).click(function (e) {
				e.stopPropagation();
			});
		}
	});
	$multi_pedidoTable.bind("rowClick", function (evt, idRow) {
		//window.location="<?=BASE_DIR.FILE_APP?>?page=crudMulti_pedido&id="+idRow;
	});
});
