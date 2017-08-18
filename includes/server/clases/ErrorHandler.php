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
				error_log(print_r($exception));
				//$this->logger->error($exception);
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
			//$this->logger->error($exception);
			error_log(print_r($exception));
		} catch (Exception $e) {
			error_log('Ocurrio una excepcion: ' . print_r($e,true));
		}

		$this->inExceptionHandler = false;
	}
}
?>