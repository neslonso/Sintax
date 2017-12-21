<?
namespace Sintax\Core;


class Session implements \ArrayAccess {
	protected static $singleton=NULL;
	protected $KEY_APP=NULL;
	protected $session_id=NULL;
	protected $session_name=NULL;
	protected $session=array();

	public function __construct ($KEY_APP,$session_id=NULL,$session_name=NULL) {
		$this->init($KEY_APP,$session_id,$session_name);
	}

	public static function getInstance($KEY_APP=NULL,$session_id=NULL,$session_name=NULL) {
		if (!static::$singleton instanceof static) {
			if (is_null($KEY_APP)) {throw new \InvalidArgumentException("Falta parametro requerido KEY_APP", 1);}
			static::$singleton = new static($KEY_APP,$session_id,$session_name);
		} else {
			if(!is_null($KEY_APP) && (static::$singleton->KEY_APP!=$KEY_APP ||
				static::$singleton->session_id!=$session_id ||
				static::$singleton->session_name!=$session_name
			)) {
				static::$singleton = new static($KEY_APP,$session_id,$session_name);
			}
		}
		return static::$singleton;
	}
	public static function gI($KEY_APP=NULL,$session_id=NULL,$session_name=NULL) {
		return static::getInstance($KEY_APP,$session_id,$session_name);
	}

	public function init($KEY_APP,$session_id=NULL,$session_name=NULL) {
		$this->KEY_APP=$KEY_APP;
		if (!is_null($session_id)) {
			session_id($session_id);
		}
		if (!is_null($session_name)) {
			session_name($session_name);
		}
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$this->session=$_SESSION;
		if(!isset($_SESSION[$KEY_APP])) {$_SESSION[$KEY_APP]=array();}
	}

	public function offsetExists ($offset) {
		return isset($_SESSION[$this->KEY_APP][$offset]);
	}
	public function offsetGet ($offset) {
		return isset($_SESSION[$this->KEY_APP][$offset]) ? $_SESSION[$this->KEY_APP][$offset] : null;
	}
	public function offsetSet ($offset,$value) {
		if (is_null($offset)) {
			$_SESSION[$this->KEY_APP][]=$value;
		} else {
			$_SESSION[$this->KEY_APP][$offset]=$value;
		}
	}
	public function offsetUnset ($offset) {
		if (isset($_SESSION[$this->KEY_APP]) && isset($_SESSION[$this->KEY_APP][$offset])) {
			unset($_SESSION[$this->KEY_APP][$offset]);
		}
	}
}
?>
