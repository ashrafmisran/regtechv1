<h3 class="text-center">Order 48</h3>
<ul id="tab-amla-report" class="nav nav-tabs mb-2">
  <li class="nav-item">
    <a class="nav-link active" data-tab="#order-tab">Order</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-tab="#report-tab">Report</a>
  </li>
</ul>



<div id="order-tab" class="tab-box animated">
	
	<div id="button-menu-order" class="form-group">
		<button id="add-new-order-btn" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#modal-add-new-order">Add new order</button>
		<button id="process-order-btn" class="btn btn-dark mb-2 mr-2 disabled" data-toggle="modal" data-target="#modal-process-order">Attach selected Order(s) to Report</button>
		<a id="generate-email-btn" href="" class="btn disabled mr-2 mb-2 btn-dark">Generate Individual Reply E-mail</a>
		<button id="remove-order-btn" class="btn btn-danger mb-2 disabled" data-toggle="modal" data-target="#modal-delete-order">Remove selected</button>
	</div>

	<table id="order-table" class="table table-hover">
		<thead>
			<tr>
				<th><!-- <input id="select-all-orders" type="checkbox"> --></th>
				<th>Order ID</th>
				<th>Order Date</th>
				<th>Orderer</th>
				<th>Received Email Subject</th>
				<th>Email Received Date</th>
				<th>Individual</th>
				<th>Company</th>
				<th>Matched</th>
				<th>Remark</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $run = load_data($conn, 'SELECT * FROM order_48 ORDER BY order_id DESC') ; while( $row = $run->fetch_assoc() ) {?>
				<?php
					if ($row['status'] == 'archieve') {
						$status = '<span class="badge badge-success">Archieved</span>';
					}elseif($row['status'] == 'submitted'){
						$status = '<span class="badge badge-warning">Submitted. Waiting for review</span>';
					}elseif($row['status'] == 'verified'){
						$status = '<span class="badge badge-warning">Verified. Waiting for submission</span>';
					}elseif($row['status'] == 'processed'){
						$status = '<span class="badge badge-warning">Processed. Waiting for verification</span>';
					}else{
						$status = '<span class="badge badge-danger">Waiting for processing</span>';
					}

				?>

				<tr>
					<td><input class="checkbox" type="checkbox" value="<?php echo $row['order_id'] ?>"></td>
					<td>FINS-<?php echo $row['order_id'] ?></td>
					<td><?php echo $row['order_date'] ?></td>
					<td><?php echo $row['orderer'] ?></td>
					<td><?php echo $row['received_email'] ?></td>
					<td><?php echo $row['receive_date'] ?></td>
					<td><?php echo $row['no_of_indvdl'] ?></td>
					<td><?php echo $row['no_of_comp'] ?></td>
					<td><?php echo $row['matched'] ?></td>
					<td><?php echo $row['remark'] ?></td>				
					<td><?php echo $status ?></td>
				</tr>

			<?php } ?>
		</tbody>
	</table>
</div>



<div id="report-tab" class="d-none tab-box animated">
	
	<div id="button-menu-report" class="form-group">
		<button class="btn btn-primary mb-2">Submit selected</button>
		<button class="btn btn-danger mb-2" data-toggle="modal" data-target="#modal-delete-report">Remove selected</button>
	</div>

	<table id="report-table" class="table table-hover">
		<thead>
			<tr>
				<th><input id="select-all-reports" type="checkbox"></th>
				<th>Report ID</th>
				<th>Processing Date</th>
				<th>Order List</th>
				<th>Matched</th>
				<th>Remark</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $run = load_data($conn, 'SELECT * FROM order_48 ORDER BY order_id DESC') ; while( $row = $run->fetch_assoc() ) {?>
				
				<tr>
					<td><input class="checkbox" type="checkbox" value="<?php echo $row['order_id'] ?>"></td>
					<td>REP-<?php echo $row['order_id'] ?></td>
					<td>Processing date</td>
					<td>
						<select class="form-control">
							<option>Test</option>
						</select>
					</td>
					<td><?php echo $row['matched'] ?></td>
					<td><?php echo $row['remark'] ?></td>				
					<td><span class="badge badge-warning">Waiting for submission</span></td>
					<td></td>
				</tr>

			<?php } ?>
		</tbody>
	</table>

</div>



<div id="modal-group-order">
	<div class="modal fade" id="modal-add-new-order">
		<div class="modal-dialog modal-lg" role="document">
			<form id="upload-form" class="container" action="add-new-order.php" method="post" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Add new order</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group form-row">
							<label class="col-md-3">Order Id</label>
							<input type="text" name="order-id" class="form-control col-md-9" data-toggle="tooltip" data-placement="bottom" title="The Unique ID for this order" readonly value="<?php 
								if(isset($_GET['id'])){
									echo 'FINS-'. $_GET['id'];
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
							<input type="text" name="new-or-edit" class="form-control col-md-6" data-toggle="tooltip" data-placement="bottom" title="The Unique ID for this order" readonly value="<?php 
								if(isset($_GET['id'])){ 
									echo 'edit';
								}else{
									echo('new');
								}
							?>" hidden>
						</div>
						<!--div class="form-group form-row">
							<label class="col-md-6">Order Date</label>
							<input type="text" name="order-date" class="singledatepicker form-control col-md-6" data-toggle="tooltip" data-placement="bottom" title="The date the inquirer sent the order to FINS">
						</div-->
						<div class="form-group form-row">
							<label class="col-md-3">Email Recieved Date</label>
							<input type="text" name="email-received-date" class="singledatepicker form-control col-md-9" data-toggle="tooltip" data-placement="bottom" title="The date FINS sent the order to BIMBSEC">
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">Email from FINS</label>
							<input type="file" name="fins-email" class="form-control col-md-9" required>
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">Attached files</label>
							<input type="file" name="attachment[]" class="form-control col-md-9" multiple data-toggle="tooltip" data-placement="bottom" title="You may upload multiple files" required>
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">Investigators' Email</label>
							<textarea type="text" name="reply-to" class="form-control col-md-9" data-toggle="tooltip" data-placement="bottom" title="Seperate multiple emails with semicolon (;)" required></textarea>
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">Cc Email</label>
							<textarea type="text" name="cc-to" class="form-control col-md-9" data-toggle="tooltip" data-placement="bottom" title="Seperate multiple emails with semicolon (;)" required></textarea>
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">Remark</label>
							<textarea type="text" name="remark" class="form-control col-md-9" placeholder="Optional..."></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	

	<div class="modal fade " id="modal-reply-order">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Generate reply e-mail</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<div class="modal-body">
						<div class="form-group form-row">
							<label class="col-md-3">From</label>
							<input id="reply-from" type="text" name="from" class="form-control col-md-9">
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">To</label>
							<input id="reply-to" type="text" name="to" class="form-control col-md-9">
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">Cc</label>
							<input id="reply-cc" type="text" name="cc" class="form-control col-md-9">
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">Subject</label>
							<input id="reply-subject" type="text" name="subject" class="form-control col-md-9">
						</div>
						<div class="form-group form-row">
							<label class="col-md-3">Content</label>
							<textarea id="reply-content" type="text" name="body" class="tinymce form-control col-md-9" rows="20" style="height: 500px"></textarea>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<a href="mailto:max@provider.com?subject=Subject adalah&cc=CC <cc@cd.com>; Ahmad <ahmad@bimbsec.com>&body=<h1>Test</h1>" type="button" class="btn btn-primary">Send</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="modal-process-order">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Process Order</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<div class="modal-body">
					<p>One fine body&hellip;</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="modal-delete-order">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Are you sure?</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="exit-btn" aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you are going to delete the selected order(s)?</p>
					<p><code><span class="selectedOrderShow"></span></code></p>
					<div id="notification-box"></div>
				</div>
				<div class="modal-footer">
					<button id="order-cancel-btn" type="button" class="focus btn btn-danger" data-dismiss="modal">Cancel</button>
					<button id="order-confirm-btn" type="button" class="btn btn-secondary" onclick="removeFrom('order_48',selectedOrder)">Confirm deletion</button>
					<button id="order-close-btn" type="button" class="btn btn-primary d-none" data-dismiss="modal">Close</button>
				</div>

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>

<div id="modal-group-report">
	<div class="modal fade" id="modal-delete-report">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Are you sure?</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you are going to delete the selected report(s)?</p>
					<p><code><span class="selectedOrderShow"></span></code></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="focus btn btn-danger" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-secondary" onclick="removeFrom('order_48',selectedReport)">Confirm deletion</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>

