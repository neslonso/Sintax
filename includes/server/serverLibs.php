<?
if (file_exists(SKEL_ROOT_DIR."includes/server/vendor/composerVendor/autoload.php")) {
	require SKEL_ROOT_DIR."includes/server/vendor/composerVendor/autoload.php";
}

require_once SKEL_ROOT_DIR."includes/server/lib/misc.php";//biblioteca de funciones varias

require_once SKEL_ROOT_DIR."includes/server/clases/Session.php";

require_once SKEL_ROOT_DIR."includes/server/lib/returnInfo.php";//biblioteca de funciones para tratar la información de retorno contenida en la sesion

require_once SKEL_ROOT_DIR."includes/server/clases/Logger.php";
require_once SKEL_ROOT_DIR."includes/server/clases/ErrorHandler.php";

require_once SKEL_ROOT_DIR."includes/server/clases/MysqliDB.php";
require_once SKEL_ROOT_DIR."includes/server/clases/Fecha.php";
require_once SKEL_ROOT_DIR."includes/server/clases/Cadena.php";
require_once SKEL_ROOT_DIR."includes/server/clases/Imagen.php";
require_once SKEL_ROOT_DIR."includes/server/clases/Filesystem.php";

require_once SKEL_ROOT_DIR."includes/server/clases/User.php";
require_once SKEL_ROOT_DIR."includes/server/clases/Page.php";

require_once SKEL_ROOT_DIR."includes/server/clases/Entity.php";

require_once SKEL_ROOT_DIR."includes/server/clases/ApiService.php";

require_once SKEL_ROOT_DIR."includes/server/vendor/jsmin-1.1.1.php";
?>