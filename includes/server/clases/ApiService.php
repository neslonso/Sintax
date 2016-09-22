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
	 * @return Boolean | String. Es true si el acceso a la página está permitido o el nombre de la clase de página a la que se debe redireccionar en caso contrario
	 */
	public function apiServiceValido();
	/**
	 * Determina si está permitido el acceso a un metodo de acción concreto.
	 * @param  String $metodo: nombre del metodo de acción a comprobar
	 * @return Boolean. Es true si la ejecución del metodo está permitida y false un caso contrario
	 */
	public function accionValida($metodo);
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
		//throw new Exception('El metodo pageValida debe ser implementado en la clase '.get_class($this));
		if ($this->objUsr instanceof IUser) {
			return $this->objUsr->apiServicePermitido($this);
		} else {
			return true;
		}
	}

	public function accionValida($metodo) {
		//throw new Exception('El metodo accionValida debe ser implementado en la clase '.get_class($this));
		if ($this->objUsr instanceof IUser) {
			return $this->objUsr->accionPermitida($this,$metodo);
		} else {
			return true;
		}
	}
}
?>