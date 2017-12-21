<?
namespace Sintax\Core;

interface IApiService {
	/**
	 * Constructor
	 * @param Sintax\Core\User | NULL $objUsr: instancia de la clase Sintax\Core\Usuario que representa al usuario que accede a la página o NULL si es un acceso no identificado
	 */
	public function __construct (User $objUsr);
	/**
	 * Comprueba si está permitido el acceso a la Page
	 * @return Boolean Es true si el acceso a la página está permitido o false en caso contrario
	 */
	public function apiServiceValido();
	/**
	 * Determina si está permitido el acceso a un metodo concreto.
	 * @param  String $metodo: nombre del metodo a comprobar
	 * @return Boolean. Es true si la ejecución del metodo está permitida y false un caso contrario
	 */
	public function metodoValido($metodo);
}

abstract class ApiService implements IApiService {
	/**
	 * Usuario que accede a la página
	 * @var Sintax\Core\User | NULL: instancia de la clase Sintax\Core\Usuario que representa al usuario que accede a la página o NULL si es un acceso no identificado
	 */
	protected $objUsr;

	public function __construct (User $objUsr=NULL) {
		$this->objUsr=$objUsr;
	}

	public function apiServiceValido() {
		if ($this->objUsr instanceof IUser) {
			return $this->objUsr->apiServicePermitido($this);
		} else {
			return false;
		}
	}

	public function metodoValido($metodo) {
		if ($this->objUsr instanceof IUser) {
			return $this->objUsr->metodoPermitido($this,$metodo);
		} else {
			return false;
		}
	}
}

class ApiIdentification extends ApiService implements IApiService {

	public function __construct (User $objUsr=NULL) {
		$this->objUsr=$objUsr;
	}

	public function apiServiceValido() {return true;}

	public function metodoValido($metodo) {return true;}

	public function getToken($login=NULL,$pass=NULL) {
		if (!is_null($login) && !is_null($pass)) {
			//$objUsr=AnonymousUser::login($login,$pass);
			//sesion['usuario']=$objUsr;
		}
		return array('token' => session_id());
	}
}
?>