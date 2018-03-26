<?php

	if ( !isset($_GET['date']) ) { ?>
		
		<h3 class="text-center">Upload order 48</h3>
		<?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'Success') { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<strong>Order successfully added!</strong> You may edit it before submission.
			</div>
		<?php }elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'Failed') { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<strong>Order failed to be added!</strong> Please try again.
			</div>		
		<?php } ?>
		<form id="upload-form" class="container" action="order-48-upload-processor.php" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-md-2">Order Id</label>
				<input type="text" name="order-id" class="form-control col-md-10" data-toggle="tooltip" data-placement="bottom" title="The Unique ID for this order" readonly value="<?php 
					if(isset($_GET['id'])){
						echo $_GET['id'];
					}else{
						$sql = 'SELECT order_id as row FROM order_48 ORDER BY order_id DESC LIMIT 1';
						$run = $conn->query($sql);
						if($run->num_rows > 0) {
							while($row = $run->fetch_assoc()){
								echo('FINS-'.(1+$row['row']));
							}
						}else{
							echo('FINS-100000');
						}
						
					}
				?>">
				<input type="text" name="new-or-edit" class="form-control col-md-10" data-toggle="tooltip" data-placement="bottom" title="The Unique ID for this order" readonly value="<?php 
					if(isset($_GET['id'])){ 
						echo 'edit';
					}else{
						echo('new');
					}
				?>" hidden>
			</div>
			<div class="form-group row">
				<label class="col-md-2">Order Date</label>
				<input type="text" name="order-date" class="singledatepicker form-control col-md-10" data-toggle="tooltip" data-placement="bottom" title="The date the inquirer sent the order to FINS">
			</div>
			<div class="form-group row">
				<label class="col-md-2">Email Receieved Date</label>
				<input type="text" name="email-received-date" class="singledatepicker form-control col-md-10" data-toggle="tooltip" data-placement="bottom" title="The date FINS sent the order to BIMBSEC">
			</div>
			<div class="form-group row">
				<label class="col-md-2">Email from FINS</label>
				<input type="file" name="fins-email" class="form-control col-md-10">
			</div>
			<div class="form-group row">
				<label class="col-md-2">Attached files</label>
				<input type="file" name="attachment[]" class="form-control col-md-10" multiple data-toggle="tooltip" data-placement="bottom" title="You may upload multiple files">
			</div>
			<hr>
			<div class="form-group row">
				<label class="col-md-2">Processed on</label>
				<input type="text" name="process-date" class="singledatepicker form-control col-md-10" data-toggle="tooltip" data-placement="bottom" title="The date compliance officer process the order">
			</div>
			<div class="form-group row">
				<label class="col-md-2">Matched</label>
				<input type="number" name="matched" class="form-control col-md-10" min="0" value="0">
			</div>
			<div class="form-group row">
				<label class="col-md-2">Replied e-mail to IO</label>
				<input type="file" name="reply" class="form-control col-md-10">
			</div>
			<div class="form-group row">
				<label class="col-md-2">Remark</label>
				<textarea class="form-control col-md-10" rows="5" name="remark"></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>

	<?php }else{
		
		echo "Record";

	}

?>




