<?php

//getCategories()

$html_output = '';

$getProductCategories = \yourgiftcards\product::getProductCategories();

foreach($getProductCategories as $key){
	$html_output .= '<li><a href="/'.\Fr\CU::segment(1).'/giftcard/'. str_replace(' ', '-', $key['cate_name']) .'/">'.$key['cate_name'].'</a></li>';
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

		<title><?php echo \yourgiftcards\LS::$config['info']['company'].' - Shop'; ?></title>

		<link href="/css/bootstrap.css" rel="stylesheet">

		<link href="/libaries/slickSlider/slick/slick.css" rel="stylesheet"/>
		<link href="/libaries/slickSlider/slick/slick-theme.css" rel="stylesheet"/>

		<link href="" rel="stylesheet"/>

		<style>
			.asd{
				border: 1px dashed #000099 ;
				height: 400px;
				width: 30px;
				display:  inline-block;
				margin: 40px;
				z-index: 999;
			}

			#btn:hover{
				transition: background-color 0.5s linear;
				background-color: red;
			}

		</style>

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

				<div class="col-lg-3">

					<ul>
						<h3>kies een giftcards</h3>
						<?php echo $html_output; ?>
					</ul>


				</div>

				<div class="col-lg-9">

					geen gedoe<br>
					geen account nodig<br>
					betalen met paypal creditcard of ideal<br>
					per direct in de mail<br>


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