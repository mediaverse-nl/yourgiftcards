<?php

	//reset charset
	//default charset iso-8859-1
	header('Content-Type: text/html; charset=iso-8859-1');

	//load all classes
	require_once $_SERVER['DOCUMENT_ROOT'] . "/libaries/Singleton/class.database.php";
	require_once $_SERVER['DOCUMENT_ROOT'] . "/libaries/loginSystem/class.logsys.php";
	require_once $_SERVER['DOCUMENT_ROOT'] . "/libaries/cleanUrls/clean.urls.php";
	require_once $_SERVER['DOCUMENT_ROOT'] . "/libaries/breadCrumbs/bread.crumbs.php";
	require_once $_SERVER['DOCUMENT_ROOT'] . "/libaries/errorSystem/error.class.php";
	require_once $_SERVER['DOCUMENT_ROOT'] . "/libaries/productSystem/product.class.php";
	require_once $_SERVER['DOCUMENT_ROOT'] . "/libaries/ShoppingCartSystem/shopping.class.php";
	require_once $_SERVER['DOCUMENT_ROOT'] . "/libaries/Mollie/class.mollie.php";

	// define url path
	$segment1 = \Fr\CU::segment(1);
	$database = \yourgiftcards\Singleton::getInstance();

	//contruct login system
	\yourgiftcards\LS::construct();

	//check if the first segment is set or not
	//if not set create own segment
	if (!\Fr\CU::segment(2)){
		$page = 'shop';
	}else{
		$page = \Fr\CU::segment(2);
	}

	$languages = array('nl', 'fr', 'de', 'es', 'be');


	if(!in_array(\Fr\CU::segment(1), $languages)){

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if(in_array($_SESSION['lang'], $languages)){
			$_SESSION['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		}else{
			$_SESSION['lang'] = 'nl';
		}
		$curUrl = str_replace( '/'.$segment1. '/', '', \yourgiftcards\LS::curPage());

		header('location: /' . $_SESSION['lang'] . '/' . ltrim($curUrl, '/'));

	}

	//check is file exists
	//if not set HTTP Response code
	if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/template/' . $page . '.php') || file_exists($_SERVER['DOCUMENT_ROOT'] . '/template/' . $page . '.xml')) {

		//choosing a template
		switch ($page) {

			//sitemap
			case 'sitemap' :
				include $_SERVER['DOCUMENT_ROOT'] . '/template/sitemap.php';
				break;
			// root first dir
			case $page :
				include $_SERVER['DOCUMENT_ROOT'] . '/template/' . $page . '.php';
				break;
		}

	} else {
		//send an error code to function
		\Error\ES::GetResponsCode(404);
	}

?>
