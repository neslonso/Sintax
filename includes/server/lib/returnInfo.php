<?
namespace Sintax\Core;

class ReturnInfo {
	public static function ensureArray() {
		$sSession=\Sintax\Core\Session::gI();
		if (!isset($sSession['returnInfo'])) {
			$sSession['returnInfo']=$sri=array();
		} else {
			if (!is_array($sSession['returnInfo'])) {
				$sri=array();
				$sri[0]=$sSession['returnInfo'];
				$sSession['returnInfo']=$sri;
			} else {
				$sri=$sSession['returnInfo'];
			}
		}
		return $sri;
	}

	public static function add($msg, $title='') {
		$sSession=\Sintax\Core\Session::gI();
		$sri=self::ensureArray();
		array_push ($sri,array(
				'msg' => $msg,
				'title' => $title,
		));
		$sSession['returnInfo']=$sri;
	}
	public static function existe () {
		$sri=self::ensureArray();
		return (count($sri)>0) ;
	}
	public static function clear () {
		$sSession=\Sintax\Core\Session::gI();
		unset($sSession['returnInfo']);
	}
	public static function msgsToLis ($class='sriMsg') {
		$result='';
		$sri=self::ensureArray();
		foreach ($sri as $arrInfo) {
			$result.='<li class="'.$class.'">'.$arrInfo['msg'].'</li>';
		}
		return $result;
	}
}
?>