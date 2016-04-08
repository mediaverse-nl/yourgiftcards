<?php

if( !isset($_SESSION['cart']) || empty($_SESSION['cart']) ){

}

require_once '/libaries/Mollie/API/Autoloader.php';

$mollie = new Mollie_API_Client;
$mollie->setApiKey('test_bgxg3DKJ2yFB8ahVut8w2HVAR3hBsM');

//put order in database


//create payment
if(!isset($_POST)){

	$order_id = time();
	$method = $_POST['method'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$description = 'asdas';
	$amount = 1;

	#form items in cart
	foreach ($_SESSION['cart'] as $key) {
		//get related items from session
		$getProductsFromSession = \yourgiftcards\SC::getProductsFromSession($key['p_id']);

		

	}

	/*
	* Determine the url parts to these example files.
	 */
	$protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
	$hostname = $_SERVER['HTTP_HOST'];
	$path     = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);


	//ideal creditcard mistercash sofort banktransfer directdebit belfius paypal bitcoin podiumcadeaukaart paysafecard
	try
	{
		$payment = $mollie->payments->create(
			array(
				"amount"       => $amount,
				"description"  => $description,
				"redirectUrl"  => "{$protocol}://{$hostname}{$path}/order/{$order_id}",
				"webhookUrl"   => "{$protocol}://{$hostname}{$path}/webhook/",
				"metadata"     => array(
					"order_id" 	=> $order_id,
				),
			)
		);

		\yourgiftcards\SC::InsertOrder($order_id, $payment->status);

		/*
         * Send the customer off to complete the payment.
         */
		header("Location: " . $payment->getPaymentUrl());
		exit;
	}
	catch (Mollie_API_Exception $e)
	{
		echo "API call failed: " . htmlspecialchars($e->getMessage());
		echo " on field " . htmlspecialchars($e->getField());
	}
}


//




#defined vars
$html_cart = '';
$number = 0;

//check if cart session is started
if(isset($_SESSION['cart'])) {

	#form items in cart
	foreach ($_SESSION['cart'] as $key) {

		//get related items from session
		$getProductsFromSession = \yourgiftcards\SC::getProductsFromSession($key['p_id']);

		#html output
		$html_cart .=
			'<tr>
					<td>' . $getProductsFromSession[0]['product_img'] . '</td>
					<td>' . $getProductsFromSession[0]['product_title'] . '</td>
					<td>' . $getProductsFromSession[0]['product_price'] . '</td>
					<td><a href="/'.\Fr\CU::segment(1).'/winkelwagen/?r=' . $number . '">verwijderen</a></td>
				</tr>';

		#foreach item count + 1
		$number++;
	}
}


?>

<html lang="en" hola_ext_inject="disabled">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="/img/logo/favicon.ico">

		<title><?php echo yourgiftcards\LS::$config['info']['company'].' - '.\Fr\CU::segment(1); ?> </title>

		<link href="/css/bootstrap.css" rel="stylesheet">
		<link href="" rel="stylesheet"/>

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
	
		<!-- Static navbar menu -->
		<?php include $_SERVER['DOCUMENT_ROOT'].'/include/menu.php'; ?>
		<!-- /Static navbar menu -->

    	<div class="container">

			<div class="row">

				<div class="col-lg-12">

					<div class="col-lg-6">

						<?php

						var_dump($getProductsFromSession);

						?>


					</div>

				</div>

			</div>

    	</div> <!-- /container -->
    	
    	<!-- footer -->
		<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>
		<!-- /footer -->
  
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="/js/bootstrap.js"></script>
	    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

	</body>
	
</html>