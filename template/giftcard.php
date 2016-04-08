<?php

	#url segment defined
	$segment1 = \Fr\CU::segment(1);
	$segment2 = \Fr\CU::segment(2);
	$segment3 = \Fr\CU::segment(3);
	$segment4 = \Fr\CU::segment(4);

	#1 segment
	#get all products on specified category
	$getProductFromCate = \yourgiftcards\product::getProductFromCate($segment3);

	#2 segment
	if(empty($segment3)){
		include $_SERVER['DOCUMENT_ROOT'] . '/template/productcategories.php';
		exit;
	}

	#3 segment
	#get all products from database
	if(!empty($segment4)){
		include $_SERVER['DOCUMENT_ROOT'] . '/template/product.php';
		exit;
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

		<title><?php echo \yourgiftcards\LS::$config['info']['company'].' - '.\Fr\CU::segment(1); ?> </title>

		<link href="/css/bootstrap.css" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="/libaries/slickSlider/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="/libaries/slickSlider/slick/slick-theme.css"/>

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

				<div class="col-lg-2">
					asda
					<?php

						$html_output2 = '';

						$getProductCategories = \yourgiftcards\product::getProductCategories();

						foreach($getProductCategories as $key){
							$html_output2 .= '<li><a href="/'.\Fr\CU::segment(1).'/giftcard/'. str_replace(' ', '-', $key['cate_name']) .'/">'.$key['cate_name'].'</a></li>';
						}

						echo $html_output2;

					?>

				</div>
				
				<div class="col-lg-10">

					<?php

					if(!empty($getProductFromCate)){
						foreach($getProductFromCate as $key){

							echo '<div class="col-lg-4 table-bordered">';
							echo '<a href="/'.$segment1.'/giftcard/' . $segment3 . '/' . $key['product_value'] . '/"><img style="width:250px; height:125px;" src="'.$key['product_title'].'" > ';
							echo $key['product_title'].'<br>';
							echo $key['product_price'].'<br>';
							echo '> bestellend';
							echo '</a>';
							echo '</div>';

						}
					}else{
						echo '<span>Er zijn geen resultaten</span>';
					}

					?>

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