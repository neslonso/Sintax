<?
namespace Sintax\Core;

class ErrorHandler {
	const VERSION='0.1';

	protected static $instance = null;
	protected $enabled = true;

	protected $throwErrorExceptions = true;
	protected $convertAssertionErrorsToExceptions = true;
	protected $throwAssertionExceptions = false;

	protected $inExceptionHandler = false;

	public static function getInstance($autoCreate = false)	{
		if ($autoCreate === true && !self::$instance) {
			self::init();
		}
		return self::$instance;
	}

	public static function init() {
		return self::setInstance(new self());
	}

	public static function setInstance($instance) {
		return self::$instance = $instance;
	}

	public function setEnabled($enabled) {
		$this->enabled = $enabled;
	}

	public function getEnabled() {
		return $this->enabled;
	}

	public function registerErrorHandler($throwErrorExceptions = false)	{
		//NOTE: The following errors will not be caught by this error handler:
		//      E_ERROR, E_PARSE, E_CORE_ERROR,
		//      E_CORE_WARNING, E_COMPILE_ERROR,
		//      E_COMPILE_WARNING, E_STRICT

		$this->throwErrorExceptions = $throwErrorExceptions;

		return set_error_handler(array($this, 'errorHandler'));
	}

	public function errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
		//echo "errorhandler llamado:<br />";
		//echo "backtrace<pre>".var_export(\debug_backtrace(),true)."</pre>";
		//echo "func_get_args<pre>".var_export(func_get_args(),true)."</pre>";
		// Don't throw exception if error reporting is switched off
		if (error_reporting() == 0) {
			return;
		}
		// Only throw exceptions for errors we are asking for
		if (error_reporting() & $errno) {
			$exception = new \ErrorException($errstr, 0, $errno, $errfile, $errline);
			if ($this->throwErrorExceptions) {
				throw $exception;
			} else {
				self::error($exception);
			}
		}
	}

	public function registerExceptionHandler() {
		return set_exception_handler(array($this, 'exceptionHandler'));
	}

	function exceptionHandler($exception) {
		$this->inExceptionHandler = true;

		header('HTTP/1.1 500 Internal Server Error');

		try {
			self::error($exception);
		} catch (Exception $e) {
			error_log('Ocurrio una excepcion: ' . print_r($e,true));
		}

		$this->inExceptionHandler = false;
	}

	protected static function prepareLoggerParams($type,$data,$titulo) {
		if (is_array($data) || is_object($data)) {
			if ($titulo!='') {self::group($titulo);} else {self::group('ARRAY/OBJECT');}
			self::_toLogger($type,$data);
			self::groupend();
		} else {
			if ($titulo!="") {
				self::_toLogger($type,$titulo.": ".$data);
			} else {
				self::_toLogger($type,$data);
			}
		}
	}

	public static function info($data,$titulo='') {
		self::prepareLoggerParams('info',$data,$titulo);
	}
	public static function warning($data,$titulo='') {
		self::prepareLoggerParams('warn',$data,$titulo);
	}
	public static function error($data,$titulo='') {
		self::prepareLoggerParams('error',$data,$titulo);
	}

	public static function group($titulo='',$xtra='') {
		//$args = func_get_args();
		$groupType='group';
		if (is_array($xtra) || is_object($xtra)) {
			foreach ($xtra as $key => $value) {
				if (stristr($key, 'collapsed') || stristr($value, 'collapsed')) {
					$groupType='groupCollapsed';
					break;
				}
			}
		} elseif (stristr($xtra, 'collapsed')) {
			$groupType='groupCollapsed';
		}
		self::_toLogger($groupType,$titulo);
	}
	public static function groupend() {$args = func_get_args();self::_toLogger('groupEnd');}

	protected static function _toLogger($function,$args='') {
		if (!self::getInstance()->getEnabled()) {
			return false;
		}
		if (class_exists('ChromePhp')) {
			\ChromePhp::$function($args);
		} else {
			error_log(var_dump($args,true));
		}
	}
}
?>