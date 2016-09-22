<?
namespace Sintax\ApiService;
use Sintax\Core\IApiService;
use Sintax\Core\ApiService;
use Sintax\Core\User;

class Categorias extends ApiService implements IApiService {


	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
	}



}
?>