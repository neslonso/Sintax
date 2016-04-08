<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	var $multi_pedidoTable=$("#multi_pedidoTable");
	$multi_pedidoTable.DBdataTable({
		"sDom":"<'H'lfr>t<'F'ip>",
		"aoColumns": [
			{"sTitle": "id","mData":"id", "sClass":"id hiddenCol", "bVisible": false, "bSearchable": false, "sWidth":"4%", "bSortable": true},
			{"sTitle": "numero","mData":"numero", "sClass":"numero textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "insert","mData":"insert", "sClass":"insert datetimeCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="" && data!="0000-00-00" && data!="0000-00-00 00:00:00") return Date.fromMysql(data).toStringES(true);
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "total","mData":"expedicion", "sClass":"expedicion textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
			}},
			{"sTitle": "estado","mData":"serie", "sClass":"serie textCol", "bVisible": true, "bSearchable": true, "sWidth":"4%", "bSortable": true,
				"mRender":function (data,type,full) {
					if (data!=null && data!="") return data;
					else return '<span class="noData">[Sin datos]</span>';
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
