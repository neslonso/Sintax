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

	public function registerErrorHandler($throwErrorExceptions = false)	{
		//NOTE: The following errors will not be caught by this error handler:
		//      E_ERROR, E_PARSE, E_CORE_ERROR,
		//      E_CORE_WARNING, E_COMPILE_ERROR,
		//      E_COMPILE_WARNING, E_STRICT

		$this->throwErrorExceptions = $throwErrorExceptions;

		return set_error_handler(array($this, 'errorHandler'));
	}

	public function errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
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
				error_log(var_dump($exception,true));
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
			error_log(var_dump($exception,true));
		} catch (Exception $e) {
			echo 'We had an exception: ' . $e;
		}

		$this->inExceptionHandler = false;
	}

	public static function info() {}

	public static function warning() {}

	public static function error() {}

	public static function group() {}
	public static function groupend() {}
}
?>