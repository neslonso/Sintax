<?
use Sintax\Core\IUser;
use Sintax\Core\AnonymousUser;
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
			case 'Sintax\Pages\comprar_pedido2':
			case 'Sintax\Pages\mis_datos':
			case 'Sintax\Pages\landingTPVV':
				$result=true;
				break;
			case 'Sintax\Pages\registro_usuario':
				$result='Sintax\Pages\mis_datos';
				break;
			case 'Sintax\Pages\acceso_usuario':
				$result='Sintax\Pages\Home';
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
	public static function login(\MysqliDB $db,$email,$pass,$keyTienda,$tokenEmail='') {
		$result=false;
		$objCliUser=new static($db);
		if ($tokenEmail!=""){
			$params=explode("PWPWPW",base64_decode($tokenEmail));
			$idCli=$params[0];
			if ($params[1]==md5($idCli."PWPWPW".$idCli."PWPWPW")){
				$objCliUser->objEntity=new \Multi_cliente($db,$idCli);
			} else {
				throw new \ActionException("Intento de acceso incorrecto.", 1);
			}
		} else {
			$objCliUser->objEntity=\Multi_cliente::login($db,$email,$pass,$keyTienda);
		}
		if ($objCliUser->objEntity) {
			$result=$objCliUser;
		}
		return $result;
	}
}
?>