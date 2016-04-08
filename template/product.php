<?php

	$getProduct = \yourgiftcards\product::getProduct($segment3, $segment4);
	$getProductRelations = \yourgiftcards\product::getProductRelations($segment3, $segment4);

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if($_POST['submit']){

			$product_id = array(
				'p_id' => htmlentities($_POST['product_id'])
			);

			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}

			if (!isset($_SESSION['cart']) ){
				$_SESSION['cart'] = array();
				$_SESSION['cart'][] = $product_id;
			}else{
				$_SESSION['cart'][] = $product_id;
			}

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

						<h1><?php echo $getProduct['product_title']; ?></h1>
						<div class="col-lg-6" style="display: inline-block; position: relative;">
							<img style="width: 100%; height: 300px;" src="<?php echo $getProduct['product_img']; ?>" >
							<span style="z-index: 100; top: 0px; right: 40px; position: absolute; display: block; font-size: 50px;"><?php echo $getProduct['product_value']; ?></span>
						</div>

						<p><?php echo $getProduct['product_description']; ?></p>

						<div>
							<label>product relaties</label>
							<div>
								<?php
									foreach($getProductRelations as $key ){
										echo '<div style="width: 50px; height: 50px; display: inline-block; position: relative; margin-right: 10px;" >
												<a  href="/'.$segment1.'/giftcard/' . $segment3 . '/' . $key['product_value'] . '/">
													<img style="width: 100%;" src="/img/' . $key['product_img'] . '" >
												</a>
												<span style="z-index: 100; top: 0px; right: 0px; position: absolute; display: block; font-size: 20px; ">' . $key['product_value'] . '</span>
											</div>';
									}
								?>
							</div>
						</div>

						<br>
						<form action="<?php echo \yourgiftcards\LS::curPageURL(); ?>" method="post" enctype="multipart/form-data">

							<input type="hidden" name="qty" value="1">
							<input type="hidden" name="value" value="<?php echo $getProduct['product_value']; ?>">
							<input type="hidden" name="product_id" value="<?php echo $getProduct['product_id']; ?>">
							<input class="btn btn-default" type="submit" name="submit" value="bestellen">

						</form>

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