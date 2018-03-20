<?php 
	// Check if file has been submitted
	if (isset($_POST['submit'])) {

		$file = fopen( $_FILES['receipt']['tmp_name'] , 'r');
		$content = fread($file, filesize($_FILES['receipt']['tmp_name']));
		
		$table = explode(PHP_EOL, $content);

		?>
		<table class="table table-hover table-striped w-100 dtable">
			<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">Acc Code</th>
					<th scope="col">Acc Desc</th>
					<th scope="col">Acc No</th>
					<th scope="col">Category Code</th>
					<th scope="col">Category Desc</th>
					<th scope="col">Receipt No</th>
					<th scope="col">Client No</th>
					<th scope="col">Client Name</th>
					<th scope="col">Chq Bank</th>
					<th scope="col">Chq No</th>
					<th scope="col">Chq Date</th>
					<th scope="col">Place</th>
					<th scope="col">Bank Charges</th>
					<th scope="col">Amount</th>
				</tr>
			</thead>
		<?php

		//Counter for each row
		$j=1;
		foreach ($table as $row) {

			if (false) {
				
				$data = explode('|', $row);
				$receipt_no  = htmlspecialchars($data[5]);
				$acc  = htmlspecialchars($data[6]);
				$date = date_parse( $data[10] );
				$date = $date['year'].'-'.$date['month'].'-'.$date['day'];
				
				$amount = htmlspecialchars($data[13]);

				$sql = 'UPDATE transactions SET trans_date = "'.$date.'" WHERE trans_id = "'.$receipt_no.'"';

				$run = $conn->query($sql);
				if ($run != FALSE) {
					echo 'Added'.'<br>';
				}else{
					echo "Failed: ".$conn->error.'<br>';
				}

			} elseif (substr_count($row, '|') >	 10) {

				// Start a row
				?><tr>
					<td>
						<?php
							// Counter
							echo $j;$j++; 
						?>
					</td>
					<?php


					$data = explode('|', $row);

					// Insert every cell
					for ($i=0; $i < 14; $i++) { 
						?><td><?php echo $data[$i]; ?></td><?php
					}

				// End a row
				echo "</tr>";	
			}
			
		}
		echo "</table>";
		
	}else{

		?>
			<form action="?p=ml-checklist-add" method="post" enctype="multipart/form-data" class="ml-3">
				<label>Deposit: </label>
				<input type="file" name="receipt">
				<button type="submit" name="submit">Submit</button>
			</form>
		<?php

	}

?>






