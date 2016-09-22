<?
namespace Sintax\Tests;

/**
 * @coversDefaultClass Sintax\Pages\crudPrueba //Sirve para no tener que poner toda la ruta de la clase en los covers de los test
 */
class testStagePlugin extends \PHPUnit_Framework_TestCase {
	protected $backupGlobals = FALSE;//PHPUnit hace copia de seguridad de las variables globales y las restaura al acabar cada test, esto es para que no lo haga

	public function setUp() {parent::setUp();}
	public function tearDown() {parent::tearDown();}

	/**
	 * @covers Nothing
	 */
	public function testEmpty () {
		$this->assertTrue(true);
	}
	/**
	 * @covers Nothing
	 */
	public function testClassEntityExists () {
		$this->assertTrue(class_exists("\Sintax\Core\Entity"));
	}
}
?>
