<nav class="navbar navbar-default navbar-fixed-top">
	<div class="navbar" >
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="/" class="navbar-brand">Logo</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">

				<ul class="nav navbar-nav navbar-right">
					<li><a href="/<?php echo $segment1;?>/">home</a></li>
					<li><a href="/<?php echo $segment1;?>/over-ons/">over ons</a></li>
					<li><a href="/<?php echo $segment1;?>/klantenservice/">klantenservice</a></li>
					<li><a href="/<?php echo $segment1;?>/winkelwagen/">winkelwagen</a></li>
					<?php
						if(isset($_SESSION['cart'])){
							echo count($_SESSION['cart']);
						}else{
							echo 0;
						}
					?>
				</ul>

			</div>
		</div>
	</div>
</nav>
