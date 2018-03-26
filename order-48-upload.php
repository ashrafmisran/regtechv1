<?php

	if ( !isset($_GET['date']) ) { ?>
		
		<h3 class="text-center">Upload order 48</h3>
		<form id="upload-form" class="container" action="order-48-upload-processor.php" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-md-2">Order Id</label>
				<input type="text" name="order-id" class="form-control col-md-10" data-toggle="tooltip" data-placement="bottom" title="The Unique ID for this order" readonly value="FINS-<?php 
					if(isset($_GET['id'])){
						echo $_GET['id'];
					}else{
						$sql = 'SELECT COUNT(*) as row FROM order_48';
						$run = $conn->query($sql);
						
						while($row = $run->fetch_assoc()){
							echo(100001+$row['row']);
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




