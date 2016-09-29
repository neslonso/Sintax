<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$.typeahead({
		input: '.js-typeahead',
		minLength: 3,
		maxItem: 0,
		//accent:true,
		dynamic:true,
		//cache:'sessionStorage',// localStorage
		filter:false,
		source: {
			ofers: {
				display: ["nombre","descripcion"],
				template: function (query,item) {
					var template=[
						'<li>',
							'<div>{{nombre}}</div>',
							'<div>',
								'<img style="float:left" ',
									'src="http://fed16.farmaciacelorrio.com/index.php?MODULE=images&almacen=DB&fichero=multi_productoAdjunto.id.4793.data&ancho=60&alto=60&modo=256" ',
								'/>',
								'<div style="height:40px; overflow:hidden; font-size:x-small;">{{descripcion}}</div>',
								'<div style="text-align:right;">'+parseFloat(item.precio).toFixed(2)+'€</div>',
							'</div>',
						'</li>',
					].join('');
					return template;
				},
				data: function () {
					var typeahead=this;
					var postedQuery=typeahead.rawQuery.trim();
					var cache=typeahead.node.cache;
					var deferred = $.Deferred();

					if (!Array.isArray(cache[postedQuery])) {
						$.ajax({
							type: 'POST',
							url: '<?=BASE_URL.FILE_APP?>',
							data: {
								'MODULE':'actions',
								'acClase':'Home',
								'acMetodo':'acSearchOfers',
								'acTipo':'ajax',
								'q': postedQuery
							},
							success: function (data, textStatus, jqXHR) {
								/*console.log ('Callback: success');
								console.log ('jqXHR:'); console.log (jqXHR);
								console.log ('data:'); console.log (data);
								console.log ('textStatus: '+textStatus);*/
								if (data.exito) {
									cache[postedQuery] = data.data;
									deferred.resolve(data.data);
								} else {
									deferred.reject("Error en la acción. No se pudo recuperar la busqueda");
								}
							},
							error: function (jqXHR, textStatus, errorThrwon) {
								console.log ('Callback: error');
								console.log ('jqXHR:'); console.log (jqXHR);
								console.log ('textStatus: '+textStatus);
								deferred.reject("Error HTTP. No se pudo recuperar la busqueda.");
							},
							complete: function (jqXHR, textStatus) {
								/*console.log ('Callback: complete');
								console.log ('jqXHR:'); console.log (jqXHR);
								console.log ('textStatus: '+textStatus);*/
							},
							dataType: 'json'
						});
					} else {
						deferred.resolve(cache[postedQuery]);
					}
					return deferred;
				}
			}
		},
		emptyTemplate: function (query) {
			return $('<li>', {
				"text": "no se ha encontrado ningún resultado para \"" + query + "\"",
				"class": "my-custom-class"
			});
		},
		callback: {
			onInit: function (node) {
				console.log(node);
				console.log('onInit function triggered');
				node.cache=[];
			},
			onClick: function (node, a, item, event) {
				console.log(node);console.log(a);console.log(item);console.log(event);
				console.log('onClick function triggered');
			},
			onSubmit: function (node, form, item, event) {
				console.log(node);console.log(form);console.log(item);console.log(event);
				console.log('onSubmit override function triggered');
				return false;
			},
			onSendRequest: function (node, query) {
				console.log('request is sent');
				//return false;
			},
			onSearch: function (node, query) {
				console.log('onSearch triggered');
			},
			onLayoutBuiltBefore: function (node, query, result, resultHtmlList) {
				//console.log(node);console.log(query);console.log(result);console.log(resultHtmlList);
				console.log('onLayoutBuiltBefore override function triggered');
				resultHtmlList.css({
					'margin-left':'-50%',
					'width':'200%',
					'max-height':'300px',
					'overflow':'auto',
				});
				return resultHtmlList;
			},
			onReceiveRequest: function (node, query) {
				console.log('request is received');
			},
		}
	});

	var mySwiper = new Swiper ('.swiper-container', {
		// Optional parameters
		direction: 'horizontal',

		// If we need pagination
		pagination: '.swiper-pagination',

		// Navigation arrows
		//nextButton: '.swiper-button-next',
		//prevButton: '.swiper-button-prev',

		// And if we need scrollbar
		//scrollbar: '.swiper-scrollbar',

		//loop: false,
		slidesPerView: 'auto', //auto debe ir con loopedSlides
		paginationClickable: true,
		spaceBetween: 30,

		/* Coverflow
		effect: 'coverflow',
		grabCursor: true,
		centeredSlides: true,
		slidesPerView: 'auto', //si hay loop, auto debe ir con loopedSlides
		coverflow: {
			rotate: 50,
			stretch: 0,
			depth: 100,
			modifier: 1,
			slideShadows : true
		},
		*/
		speed:1000,
		autoplay: 1000,
		autoplayDisableOnInteraction: false,
	})

	$('#divJqCesta').jqCesta({
		arrItems: $('#divJqCesta').data('arrItems')
	})
	.on('afterAdd.jqCesta', function(event,item) {
		$.ajax({
			url: '<?=BASE_URL.FILE_APP?>',
			type: 'post',
			data: {
				'MODULE':'actions',
				'acClase':'Home',
				'acMetodo':'acAddToCesta',
				'acTipo':'ajax',
				'id': item.id
			},
			success: function (data) {
				console.log(data);
				if (data.exito) {
					$('#divJqNotifications').data('jqNotifications')
						.addNotification('Producto añadido', 'Se ha añadido a cesta el producto <strong>'+item.descripcion+'</strong>', 'add');
				} else {
					$('#divJqNotifications').data('jqNotifications')
						.addNotification('Error añadiendo producto', 'No fue psible añadir el producto <strong>'+item.descripcion+'</strong>.<br /><br />'+data.msg, 'add');
					muestraMsgModal('No fue posible añadir el producto a su pedido',data.msg);
					$('#divJqCesta').data('jqCesta').removeItem(item.id);
				}
			},
			dataType: 'json'
		});
	})
	.on('checkOrder', function(event,arrItems) {

	});

	$('#divJqNotifications').jqNotifications();
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		if ($("#wrapper").hasClass("toggled")) {
			//está cerrado y lo vamos a abrir
			$("#sidebar-wrapper").css("overflow-y","auto");
			$("#sidebar-wrapper").css("overflow-x","hidden");
			$("#wrapper").toggleClass("toggled");
			$(this).delay(600).queue(function() {
				//ajustamos para que quite el overflow cuando ya termine la animacion
				$("#sidebar-wrapper").css("overflow-y","visible");
				$("#sidebar-wrapper").css("overflow-x","visible");
				$("#sidebar-wrapper").addClass('sidebar-wrapper-scroll');
				//$("#sidebar-wrapper").css("position","relative");
				$(this).dequeue();
			});

		} else {
			//está abierto y lo vamos a cerrar
			$("#sidebar-wrapper").css("overflow-y","auto");
			$("#sidebar-wrapper").css("overflow-x","hidden");
			$("#sidebar-wrapper").removeClass('sidebar-wrapper-scroll');
			//$("#sidebar-wrapper").css("position","fixed");
			$("#wrapper").toggleClass("toggled");
		}
	});
	$('#modalItems').on('show.bs.modal', function (e) {
		var idItem=$(e.relatedTarget).data('item');
		$("#popupItemActive").val(idItem);
		$("#itemPopup"+idItem).addClass('active');
	});
	$('#modalItems').on('hide.bs.modal', function (e) {
		var itemActive= $("#popupItemActive").val();
		$("#itemPopup"+itemActive).removeClass('active');
		$("#popupItemActive").val("");
	});
	$('#btnUserNav').click(function(e) {
		if($('#navUserMenu').hasClass('nav-user-menu-outside')){
			$('#navUserMenu').removeClass('nav-user-menu-outside');
			$('#navUserMenu').addClass('nav-user-menu-inside');
		}else{
			if($('#navUserMenu').hasClass('nav-user-menu-inside')){
				$('#navUserMenu').removeClass('nav-user-menu-inside');
				$('#navUserMenu').addClass('nav-user-menu-outside');
			}else{
				$('#navUserMenu').removeClass('nav-user-menu-outside');
				$('#navUserMenu').addClass('nav-user-menu-inside');
			}
		}
	});
	$('#btnLogout').on('click', function () {
		$.post('<?=BASE_DIR.FILE_APP?>',{
			'MODULE':'actions',
			'acClase':'Home',
			'acMetodo':'acLogout',
			'acTipo':'ajax'
		},
		function (response) {
			window.location.reload();
		},
		'json');
	});
	$('#frmLogin').keypress(function(e){
		if(e.which == 13) {
			$('#frmLogin #btnLogin').click();
		}
	});

	$('#frmLogin #btnLogin').on('click', function () {
		if ($('#frmLogin #email').val()!="" && $('#frmLogin #pass').val()!=""){
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'Home',
				'acMetodo':'acLogin',
				'acTipo':'ajax',
				'email':$('#email').val(),
				'pass':$('#pass').val()
			},
			function (response) {
				console.log(response);
				if (!response.data.resultado.valor){
					muestraMsgModal('Error',response.data.resultado.msg);
				} else {
					window.location.reload();
				}
			},
			'json');
		} else {
			muestraMsgModal('Error','Escribe tu email y contraseña');
		}
	});

});

