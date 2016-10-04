<?
use Sintax\Core\IUser;
use Sintax\Core\User;
use Sintax\Core\Page;
class Multi_clienteUser extends AnonymousUser implements IUser {
	public $objEntity;

	public function __construct (\MysqliDB $db=NULL, $keyValue=NULL) {
		$this->objEntity=new \Multi_cliente($db,$keyValue);
	}

	public function pagePermitida (Page $objPage) {
			$result=parent::pagePermitida($objPage);
			switch (get_class($objPage)) {
				case 'Sintax\Pages\mi_pedido':
				case 'Sintax\Pages\mis_pedidos':
				case 'Sintax\Pages\comprar_pedido':
				case 'Sintax\Pages\mis_datos':
					$result=true;
					break;
				default:
					//almacenar get_class($objPage), get_class($this)
					break;
			}
		return $result;
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
		$objCliUser->objEntity=\Multi_cliente::login($db,$email,$pass,$keyTienda);
		if ($objCliUser->objEntity) {
			$result=$objCliUser;
		}
		return $result;
	}
}
?>