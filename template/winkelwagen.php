<?php

#defined vars
$html_cart = '';
$number = 0;

//SELECT SUM( ordered_product_price ) + SUM( cate_service_fee ) AS total
//FROM orders
//LEFT JOIN products ON product_id = ordered_id
//LEFT JOIN categories ON cate_id = product_cate_id
//LEFT JOIN ordered_products ON ordered_products.ordered_order_id = orders.ordered_id
//WHERE orders.ordered_id =1

//check if cart session is started
if(isset($_SESSION['cart'])) {

	#form items in cart
	foreach ($_SESSION['cart'] as $key) {

		$query = "SELECT * FROM products WHERE product_id = ?";

		$stmt = $database->query($query);

		$stmt->bindValue(1, $key['p_id'], \PDO::PARAM_INT);

		$stmt->execute();

		$getProductsFromSession = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		$getProductsFromSession[0]['product_price'];

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

	//remove item from cart
	if (isset($_GET['r'])) {

		#check if item exists in cart and delete it from cart
		if(in_array($_SESSION['cart'][$_GET['r']], $_SESSION['cart']))
		{
			//unset row from session array
			unset($_SESSION['cart'][$_GET['r']]);
			//reset array numbers
			$_SESSION['cart'] = array_values($_SESSION['cart']);
		}

		#return to main url
		header('location: /'.\Fr\CU::segment(1).'/winkelwagen/');

	}

}

if(empty($_SESSION['cart'])){
	$html_cart .= '<tr><td colspan="5" class="text-center"><span>u heeft geen producten in uw winkelwagen.</span></td></tr>';
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

		<title></title>

		<link href="/css/bootstrap.css" rel="stylesheet">
		<link href="/css/winkelwagen.css" rel="stylesheet"/>

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
	
		<!-- Static navbar menu -->
		<?php include $_SERVER['DOCUMENT_ROOT'].'/include/menu.php'; ?>

    	<div class="container">

			<div id="products-wrapper" class="row">
				<div class="view-cart">

					<div class="col-lg-12">
						<div class="col-lg-9">
							<h3 class="bag-summary">Uw Item(s) - <span></span></h3>
							<table class="shop_table cart col-lg-12" cellspacing="0" style="border-bottom: 1px solid #D0D0D0; ;">
								<thead>
									<tr>
										<th class="product-thumbnail">Afbeelding</th>
										<th class="product-name">Naam</th>
										<th class="product-subtotal">Subtotaal</th>
										<th class="product-remove">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<?php echo $html_cart; ?>
								</tbody>
							</table>
							<a class="btn btn-primary" href="/kassa/betalen/" class="checkout-button button alt wc-forward">Volgende</a>
							<a class="btn btn-default" href="/shop/">Verder winkelen</a>
						</div>


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