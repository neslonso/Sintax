<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('#divJqCesta').jqCesta({'foo': 'bar'});
	$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled").promise().done (function(){
	        if ($("#wrapper").hasClass("toggled")) {
	        	$("#sidebar-wrapper").css("overflow-y","auto");
			} else {
				$("#sidebar-wrapper").css("overflow-y","visible");
			}
		});
    });
});