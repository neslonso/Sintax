<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="article">
				<div class="title">
					<a name="structure"></a>
					<strong class="embossed">Structure</strong>
					<span>Organización y ficheros</span>
				</div>
				<div class="meta"><span>Qué</span>, donde y como</div>
				<div class="body">
					<p>

					</p>
					<div class="bs-callout bs-callout-info">
						<h4>Estrcutura de ficheros</h4>
						<p>
<pre>
<?
	$excludingRexEx=array (
		"/",
		"vendor",
		"|",
		"aaReferences",
		"|",
		"(css|jsMin)\.(.+)\.(css|js)",
		"|",
		"zzWorkspace",
		"|",
		"google",
		"/"
	);
	$arr=self::path2array("./",implode('',$excludingRexEx));
	echo self::array2list($arr);
?>
</pre>
						</p>
						<p>
<?
	$objCliente=new Cliente (12);
	print_r($objCliente);
?>
						</p>
					</div>
					<date>Creado: 13 de septiembre, 2014</date>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>