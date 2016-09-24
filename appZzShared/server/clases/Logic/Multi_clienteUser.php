<?
use Sintax\Core\IUser;
use Sintax\Core\User;
use Sintax\Core\Page;
class Multi_clienteUser extends User implements IUser {
	public $objCli;

	public function __construct (\MysqliDB $db=NULL, $keyValue=NULL) {
		$this->objCli=new \Multi_cliente($db,$keyValue);
	}

	public function pagePermitida (Page $objPage) {
		switch (get_class($objPage)) {
			case 'value':
				break;
			default:
				//almacenar get_class($objPage), get_class($this)
				break;
		}
		return true;
	}
	public function accionPermitida (Page $objPage,$metodo) {
		$result=true;
		switch (get_class($objPage)) {
			case 'value':
				switch ($metodo) {
					case 'value':
						# code...
						break;
					default:
						# code...
						break;
				}
				break;
			default:
				# code...
				break;
		}
		return $result;
	}

	/**
	 * [login description]
	 * @param  \MysqliDB $db        Instancia de clase de acceso a base de datos
	 * @param  string    $email
	 * @param  string    $pass
	 * @param  string    $keyTienda
	 * @return Multi_clienteUser
	 */
	public static function login(\MysqliDB $db,$email,$pass,$keyTienda) {
		$result=false;
		$objCliUser=new static($db);
		$objCliUser->objCli=\Multi_cliente::login($db,$email,$pass,$keyTienda);
		if ($objCliUser->objCli) {
			$result=$objCliUser;
		}
		return $result;
	}
}
?>