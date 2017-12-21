<?
namespace Sintax\Core;

interface ILogger {
	/**
	 * [setEnabled description]
	 * @param [type] $enabled [description]
	 */
	public function setEnabled($enabled);
	/**
	 * [getEnabled description]
	 * @return [type] [description]
	 */
	public function getEnabled();
	/**
	 * [info description]
	 * @param  [type] $data  [description]
	 * @param  string $etq   [description]
	 * @param  string $style [description]
	 * @return [type]        [description]
	 */
	public function info($data,$etq='',$style='');
	/**
	 * [warning description]
	 * @param  [type] $data  [description]
	 * @param  string $etq   [description]
	 * @param  string $style [description]
	 * @return [type]        [description]
	 */
	public function warning($data,$etq='',$style='');
	/**
	 * [error description]
	 * @param  [type] $data  [description]
	 * @param  string $etq   [description]
	 * @param  string $style [description]
	 * @return [type]        [description]
	 */
	public function error($data,$etq='',$style='');
	/**
	 * [group description]
	 * @param  string $etq   [description]
	 * @param  string $style [description]
	 * @return [type]        [description]
	 */
	public function group($etq='',$style='');
	/**
	 * [groupend description]
	 * @return [type] [description]
	 */
	public function groupend();
}

abstract class Logger implements ILogger {
	protected $enabled;
	protected $looger;
	public function __construct () {}
	public function setEnabled($enabled) {}
	public function getEnabled() {}
	public function info($data,$etq='',$style='') {}
	public function warning($data,$etq='',$style='') {}
	public function error($data,$etq='',$style='') {}
	public function group($etq='',$style='') {}
	public function groupend() {}
}

class monologLogger extends Logger implements ILogger {

	protected $groupDepth=0;
	protected $groupPad='. ';
	private $options=array (
			'gelf' => array(
				'host' => null,
				'port' => 12201,
			),
			'stream' => null
	);

	public function __construct ($name='monologLogger',array $options=array()) {
		try {
			$wrongOptions=array_diff(array_keys($options), array_keys($this->options));
			if ($wrongOptions) {
				throw new Exception('Opciones desconocidas: ' . implode(', ', $wrongOptions));
			}
			$this->options=array_replace($this->options, $options);

			$this->enabled=true;
			$this->logger = new \Monolog\Logger($name);

			$phpConsoleHandler=new \Monolog\Handler\PHPConsoleHandler (array(
				'enabled' => true, // bool Is PHP Console server enabled
				'debugTagsKeysInContext' => array('PHPConsoleHandlerTag'), // bool Is PHP Console server enabled
				'sourcesBasePath' => SKEL_ROOT_DIR, // string Base path of all project sources to strip in errors source paths
				'password' => null, // string|null Protect PHP Console connection by password
				'ipMasks' => unserialize(IPS_DEV), // array Set IP masks of clients that will be allowed to connect to PHP Console: array('192.168.*.*', '127.0.0.1')
				'enableEvalListener' => false, // bool Enable eval request to be handled by eval dispatcher(if enabled, 'password' option is also required)
				'detectDumpTraceAndSource' => false, // bool Autodetect and append trace data to debug
			));
			$phpConsoleHandler->pushProcessor(function($record) {
				if ($record['context'] && !is_scalar(reset($record['context']))) {
					$message=str_repeat($this->groupPad, $this->groupDepth).$record['message'];
					$record['message']=reset($record['context']);
					$record['context']=array();
					if ($message!='') {
						$record['context']=array('PHPConsoleHandlerTag' => $message);
					}
				} else {
					$record['context']=array('PHPConsoleHandlerTag' => str_repeat($this->groupPad, $this->groupDepth).strtolower($record['level_name']));
				}
				return $record;
			});
			$this->logger->pushHandler($phpConsoleHandler);


			if (!is_null($this->options['gelf']['host'])) {
				$transport=new \Gelf\Transport\TcpTransport($this->options['gelf']['host'],$this->options['gelf']['port']);
				$publisher=new \Gelf\Publisher($transport);
				$gelfHandler=new \Monolog\Handler\GelfHandler ($publisher);
				$gelfHandler->pushProcessor(function($record) {
					if (!$record['message']) {
						$record['message']='[Not Set]';
					}
					return $record;
				});
				$this->logger->pushHandler($gelfHandler);
			}

			if (!is_null($this->options['stream'])) {
				$lineFormatter = new \Monolog\Formatter\LineFormatter(null, null, false, true);
				$streamHandler=new \Monolog\Handler\StreamHandler($this->options->stream, \Monolog\Logger::DEBUG);
				$streamHandler->setFormatter($lineFormatter);
				$this->logger->pushHandler($streamHandler);
			}

			//$introspectionProcessor=new \Monolog\Processor\IntrospectionProcessor();
			//$this->logger->pushProcessor($introspectionProcessor);
			//
		} catch (Exception $e) {
			$this->handleMetaException($e);
		}
	}

	public function setEnabled($enabled) {
		$this->enabled=$enabled;
	}
	public function getEnabled() {
		return $this->enabled;
	}

	public function info($data,$etq='',$style='') {
		$this->__toLogger(\Monolog\Logger::INFO,$data,$etq,$style);
	}
	public function warning($data,$etq='',$style='') {
		$this->__toLogger(\Monolog\Logger::WARNING,$data,$etq,$style);
	}
	public function error($data,$etq='',$style='') {
		$this->__toLogger(\Monolog\Logger::ERROR,$data,$etq,$style);
	}

	public function group($etq='',$style='') {
		//$this->__toLogger(\Monolog\Logger::INFO,null,'/ '.$etq.' -------------------------------/',$style);
		//$this->groupDepth++;
	}
	public function groupend() {
		//$this->groupDepth=max(0,--$this->groupDepth);
		//$this->__toLogger(\Monolog\Logger::INFO,null,'/-----------------------------------------/',null);
	}

	private function __toLogger($level,$data,$etq='',$style='') {
		if ($this->enabled) {
			$message=$etq;
			//$context=(!is_array($data))?[$data]:$data;
			$context=[$data];
			try {
				$this->logger->addRecord($level, $message, $context);
			} catch (\Exception $e) {
				$this->handleMetaException($e);
			}
		}
	}

	private function handleMetaException($e) {
		$infoExc="Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine();
		error_log ("Excepcion en Logger: TRACE: ".$e->getTraceAsString());
		//mail (DEBUG_EMAIL,$_SERVER['SERVER_NAME'].". Excepcion en Logger".__FILE__."::".__LINE__,
		//	$infoExc."\n\n--\n\n".$e->getTraceAsString()."\n\n--\n\n".print_r($GLOBALS,true));
	}
}
?>