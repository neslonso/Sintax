<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {

	var mySwiper = new Swiper ('.swiper-container', {
		// Optional parameters
		direction: 'horizontal',
		loop: true,

		// If we need pagination
		pagination: '.swiper-pagination',

		// Navigation arrows
		//nextButton: '.swiper-button-next',
		//prevButton: '.swiper-button-prev',

		// And if we need scrollbar
		//scrollbar: '.swiper-scrollbar',

		//slidesPerView: 'auto', //auto debe ir con loopedSlides
		paginationClickable: true,
		spaceBetween: 0,

		effect: 'coverflow',
		grabCursor: true,
		centeredSlides: true,
		slidesPerView: 'auto',
		coverflow: {
			rotate: 50,
			stretch: 0,
			depth: 100,
			modifier: 1,
			slideShadows : true
		},
		speed:1000,
        autoplay: 1000,
        autoplayDisableOnInteraction: false,
	})

	$('#divJqCesta').jqCesta();
	$('#divJqNotifications').jqNotifications({'foo': 'bar'});
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
});

