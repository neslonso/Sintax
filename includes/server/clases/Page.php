<?
interface IPage {
	public function __construct (Usuario $objUsr=NULL);
	public function pageValida();
	public function accionValida($metodo);
	public function title();
	public function metaTags();
	public function favIcon();
	public function head();
	public function js();
	public function css();
	public function markup();
}

abstract class Page implements IPage {
	protected $objUsr;
	public $arrSustitucion;

	public function __construct (Usuario $objUsr=NULL) {
		$this->objUsr=$objUsr;
	}

	public function pageValida() {
		//throw new Exception('El metodo pageValida debe ser implementado en la clase '.get_class($this));
		return true;
	}

	public function accionValida($metodo) {
		throw new Exception('El metodo accionValida debe ser implementado en la clase '.get_class($this));
	}

	public function title() {
		return TITLE_BASE;
	}

	public function metaTags() {
		$metaTags='';
		/*$metaTags.='<meta name="Title" content="Titulo" />'."\n";
		$metaTags.='<meta name="Author" content="Parqueweb S.L." />'."\n";
		$metaTags.='<meta name="Subject" content="Tema" />'."\n";
		$metaTags.='<meta name="Description" content="Descripcion" />'."\n";
		$metaTags.='<meta name="Keywords" content="Keyword1,Keyword2" />'."\n";
		$metaTags.='<meta name="Generator" content="editor" />'."\n";
		$metaTags.='<meta name="Language" content="Spanish" />'."\n";
		$metaTags.='<meta name="Revisit" content="1 day" />'."\n";
		$metaTags.='<meta name="Distribution" content="Global" />'."\n";
		$metaTags.='<meta name="Robots" content="All" />'."\n";
		*/
		/*
		//Las tags og (están a continuacion) las metemos entre
		//comentarios así el validador las ignora, pero FB las lee igual
		//20120703 <- He leido que no, que si las comentas las ignora
		$metaTags.='<!--';
		$metaTags.='-->';
		*/

		/*open graph
		//obligatoria segun http://developers.facebook.com/tools/debug el 02/07/2012
		<meta property="og:url" content="http://www.imdb.com/title/tt0117500/" />
		<meta property="og:title" content="The Rock" />
		<meta property="og:description" content="Sean Connery found fame and fortune as the
												 suave, sophisticated British agent, James
												 Bond." />
		<meta property="og:image" content="http://ia.media-imdb.com/images/rock.jpg" />

		//obligatorias
		<meta property="og:title" content="The Rock" />
		<meta property="og:type" content="movie" />
		<meta property="og:url" content="http://www.imdb.com/title/tt0117500/" />
		<meta property="og:image" content="http://ia.media-imdb.com/images/rock.jpg" />
		//recomendadas
		<meta property="og:description" content="Sean Connery found fame and fortune as the
												 suave, sophisticated British agent, James
												 Bond." />
		<meta property="og:site_name" content="IMDb" />
		//Location
		<meta property="og:latitude" content="37.416343" />
		<meta property="og:longitude" content="-122.153013" />
		<meta property="og:street-address" content="1601 S California Ave" />
		<meta property="og:locality" content="Palo Alto" />
		<meta property="og:region" content="CA" />
		<meta property="og:postal-code" content="94304" />
		<meta property="og:country-name" content="USA" />
		//Contacto
		<meta property="og:email" content="me@example.com" />
		<meta property="og:phone_number" content="650-123-4567" />
		<meta property="og:fax_number" content="+1-415-123-4567" />
		//Video
		<meta property="og:video" content="http://example.com/awesome.flv" />
		<meta property="og:video:height" content="640" />
		<meta property="og:video:width" content="385" />
		<meta property="og:video:type" content="application/x-shockwave-flash" />
		//Audio
		<meta property="og:audio" content="http://example.com/amazing.mp3" />
		<meta property="og:audio:title" content="Amazing Song" />
		<meta property="og:audio:artist" content="Amazing Band" />
		<meta property="og:audio:album" content="Amazing Album" />
		<meta property="og:audio:type" content="application/mp3" />
		*/
		/*og:type, tipos
			Activities
				activity,sport
			Businesses
				bar,company,cafe,hotel,restaurant
			Groups
				cause,sports_league,sports_team
			Organizations
				band,government,non_profit,school,university
			People
				actor,athlete,author,director,musician,politician,profile,public_figure
			Places
				city,country,landmark,state_province
			Products and Entertainment
				album,book,drink,food,game,movie,product,song,tv_show

			For products which have a UPC code or ISBN number, you can specify them using the og:upc and og:isbn properties.
			These properties help to make more concrete connections between graphs.
			Websites
				article,blog,website
		*/
		return $metaTags."\n";
	}

	public function favIcon() {
		$favIcon='';
		$favIcon.='<link rel="shortcut icon" type="image/x-icon" href="./binaries/imgs/lib/favicon.ico" />';
		$favIcon.=PHP_EOL;
		$favIcon.='<link rel="icon" type="image/x-icon" href="./binaries/imgs/lib/favicon.ico" />';
		return $favIcon."\n";
	}

	public function head() {
		throw new Exception('El metodo head debe ser implementado en la clase '.get_class($this));
		//require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/head.php');
	}

	public function js() {}
	public function css() {}

	public function markup() {
		throw new Exception('El metodo markup debe ser implementado en la clase '.get_class($this));

		//Si se llama a esta funcion por herencia (desde una clase que desciendade esta y no la tengo, p.e.) __FILE__
		//no hará lo esperado, ya que resuleve al este fichero y no al fichero que contiene la clase descendientee
		//require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/markup.php');
	}

}
?>