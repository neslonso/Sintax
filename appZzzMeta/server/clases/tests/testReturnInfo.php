<?
namespace Sintax\Tests;

/**
 * @coversDefaultClass Sintax\Core\ReturnInfo
 */
class testReturnInfo extends \PHPUnit_Framework_TestCase {
	protected $backupGlobals = FALSE;//PHPUnit hace copia de seguridad de las variables globales y las restaura al acabar cada test, esto es para que no lo haga

	public function setUp() {parent::setUp();}
	public function tearDown() {parent::tearDown();}

	/**
	 * @covers ::clear
	 */
	public function testClearReturnInfo () {
		\Sintax\Core\ReturnInfo::clear();
		$this->assertTrue(!isset($_SESSION['returnInfo']));
	}

	/**
	 * @covers ::add
	 */
	public function testAddReturnInfo () {
		\Sintax\Core\ReturnInfo::add('mensaje de prueba','Titulo de prueba');
		$this->assertArrayHasKey('returnInfo',$_SESSION);
		$this->assertArrayHasKey('title',$_SESSION['returnInfo'][0]);
		$this->assertArrayHasKey('msg',$_SESSION['returnInfo'][0]);
		return $_SESSION['returnInfo'];
	}

	/**
	 * @covers ::msgsToLis
	 * @depends testAddReturnInfo
	 */
	public function testLiMsgsReturnInfo ($returnInfo) {
		$result=\Sintax\Core\ReturnInfo::msgsToLis();
		$this->assertRegExp('/.*mensaje de prueba.*/',$result,'No se encontró la cadena añadida en "testAddReturnInfo"');
	}
}
?>