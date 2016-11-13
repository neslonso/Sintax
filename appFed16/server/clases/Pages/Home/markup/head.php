<?="\n<!-- ".get_class()." -->\n"?>
<?if (
	strpos($_SERVER['SERVER_NAME'], "fed16")===false &&
	!in_array($_SERVER['REMOTE_ADDR'],unserialize(IPS_DEV)) &&
	$GLOBALS['config']->tienda->ANALYTICS!=''
) {?>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', '<?=$GLOBALS['config']->tienda->ANALYTICS?>', 'auto');
	ga('require', 'ec');
	ga('send', 'pageview');
	console.log('Home head typeof ga='+typeof ga);

	function createFunctionWithTimeout(callback, opt_timeout) {
		var called = false;
		function fn() {
			if (!called) {
				called = true;
				callback();
			}
		}
		setTimeout(fn, opt_timeout || 1000);
		return fn;
	}
</script>
<?}?>
<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
<script type="text/javascript">
	window.cookieconsent_options = {
		'message':'<p style="text-align:justify;">Solicitamos su permiso para obtener datos estadísticos de su navegación en esta web, en cumplimiento del Real Decreto-ley 13/2012. Si continúa navegando consideramos que acepta el uso de cookies.</p>',
		'dismiss':'Lo entiendo',
		'learnMore':'Más información',
		'link':'<?=BASE_URL?>aviso_legal',
		'theme':'dark-floating'};
</script>
<script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
<!-- End Cookie Consent plugin -->
<?="\n<!-- /".get_class()." -->\n"?>