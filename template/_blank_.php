<html lang="en" hola_ext_inject="disabled">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="/img/logo/favicon.ico">

		<title><?php //echo \Fr\LS::$config['info']['company'].' - '.\Fr\CU::segment(1); ?> </title>

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

					<?php

					class person {

						private $pw;
						private	$username;
						private $email;
						private $person = array();

						public function __construct(){

						}

						public function setData($personDetails){
							$this->person[] = $personDetails;
						}


						public function getData($property){
							return $this->person[0][$property];
						}

					}

					$stmt = $database->query('select * from users ');
					$stmt->execute();

					$return = $stmt->fetch();

					$obj = new person();



					$obj->setData($return);


					echo '<pre>';
					print_r($obj);
					echo '</pre>';

					echo  $obj->getData('username');
					echo  $obj->getData('id');



					//$jan = new test1($return);

					//echo 'asdasd <br>';
					//echo $jan->email;
					//$stmt->bindValue();



					$shoppingcart = new \yourgiftcards\SC;


					$stmt1 = $database->query('select * from products');

					$stmt1->execute();

					$return1 = $stmt1->fetchAll();

					foreach ($return1 as $key){
						echo $key['product_id']. '<br>';
					}


					echo $shoppingcart->getProperty();


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