<?
namespace Sintax\Tests;

/**
 * @coversDefaultClass Sintax\Core\Entity
 */
class testClassEntity extends \PHPUnit_Framework_TestCase {
	protected $backupGlobals = FALSE;//PHPUnit hace copia de seguridad de las variables globales y las restaura al acabar cada test, esto es para que no lo haga

	public function setUp() {parent::setUp();}
	public function tearDown() {parent::tearDown();}

	/**
	 * @coversNothing
	 */
	public function testClassEntityExists () {
		$this->assertTrue(class_exists('\Sintax\Core\Entity'));
	}
	/**
	 * @covers ::cargar
	 * @covers ::toArray
	 * @covers ::grabar
	 * @covers ::borrar
	 */
	public function testClassEntity () {
		$arrDbs=unserialize(DBS);
		$objDb=\cDb::conf($arrDbs['mtr']['_DB_HOST_'],$arrDbs['mtr']['_DB_USER_'],$arrDbs['mtr']['_DB_PASSWD_'],$arrDbs['mtr']['_DB_NAME_']);
		$obj=new \Sintax\Core\EntidadConcreta($objDb);
		$this->assertNull($obj->GETid());
		$obj->SETid(33);
		$this->assertEquals($obj->GETid(), 33);
		$obj->cargar(1);
		$this->assertEquals($obj->GETid(), 1);
		$this->assertArrayHasKey('arrDbData',$obj->toArray());
		$nombre=$obj->GETnombre();
		$obj->SETnombre("Unit Test");
		$this->assertEquals($obj->GETnombre(), "Unit Test");
		$obj->grabar();
		unset ($obj);
		$obj2=new \Sintax\Core\EntidadConcreta($objDb);
		$obj2->cargar(1);
		$this->assertEquals($obj2->GETnombre(), "Unit Test");
		$obj2->SETnombre($nombre);
		$obj2->grabar();
		$obj2->SETid(NULL);
		$this->assertNull($obj2->GETid());
		$obj2->SETnombre(NULL);
		$this->assertNull($obj2->GETnombre());
		$obj2->SETnombre("Unit Test 2");
		$obj2->grabar();
		$idGrabada=$obj2->GETid();
		$obj2->borrar();
	}
}
?>