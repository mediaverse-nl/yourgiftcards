<?php
$segment3 = \Fr\CU::segment(3);

if(\yourgiftcards\LS::$loggedIn === true){

	if($segment3 == '' ){
		include $_SERVER['DOCUMENT_ROOT'] .'/libaries/adminPanel/index.php';
	}else{

		if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/libaries/adminPanel/pages/' . $segment3 . '.php')) {
			include $_SERVER['DOCUMENT_ROOT'] . '/libaries/adminPanel/pages/' . $segment3 . '.php';
		}else{
			\Error\ES::GetResponsCode(404);
		}
	}

}else{
	include $_SERVER['DOCUMENT_ROOT'] .'/libaries/adminPanel/pages/inloggen.php';
	exit;
}

?>