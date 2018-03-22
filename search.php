<?php if (!isset($_POST['s']) || $_POST['s'] == '') {?>
	
	<h3>Please insert the search query</h3>

<?php }else{ ?>

	<h3 class="text-center">Record for 
		<form action="?p=search" method="post" class="d-inline">
			<input type="text" name="s" value="<?php echo $_POST['s'] ?>">
			for
			<input type="" name="" class="rangepicker">
		</form>
	</h3>
	<hr>

	<div class="row no-gutters">
		<div class="col-6">
			<h5>Trust Account</h5>
			<canvas id="myChart" class="w-100"></canvas>
		</div>
		<div class="col-6">
			<h5>Order History</h5>
			<canvas id="myChart2" class="w-100"></canvas>
		</div>
	</div>

<?php } ?>