<!--div id="title-box" class="d-flex flex-column">
	<div class="col-md-8 m-0">
		<h3 class="m-0">Title</h3>
	</div>
	<div class="col-md-4 m-0">
		<p class="small m-0">Link >></p>
	</div>
</div-->
<div class="m-3">
	<?php

		if (isset($_GET['p'])) {
			include $_GET['p'].'.php';
		}else{
			include 'dashboard.php';
		}

	?>	
</div>
